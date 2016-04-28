<?php

namespace My\Search;

use Elastica\Query\QueryString,
    Elastica\Type\Mapping,
    Elastica\Query\Bool,
    Elastica\Search,
    Elastica\Status,
    Elastica\Query as ESQuery,
    My\Search\SearchAbstract,
    My\General;

class Messages extends SearchAbstract {

    public function __construct() {
        $this->setSearchIndex(SEARCH_PREFIX . 'messages');
        $this->setSearchType('messagesList');
    }

    public function createIndex() {
        $strIndexName = SEARCH_PREFIX . 'messages';

        $searchClient = General::getSearchConfig();
        $searchIndex = $searchClient->getIndex($strIndexName);

        $objStatus = new Status($searchIndex->getClient());
        $arrIndex = $objStatus->getIndexNames();

        //delete index
        if (in_array($strIndexName, $arrIndex)) {
            $searchIndex->delete();
        }

        //create new index
        $searchIndex->create([
            'name' => 'translations',
            'number_of_shards' => 5,
            'number_of_replicas' => 0,
            'analysis' => [
                'analyzer' => [
                    'translation_index_analyzer' => [
                        'type' => 'custom',
                        'tokenizer' => 'standard',
                        'filter' => ['standard', 'lowercase', 'asciifolding', 'trim']
                    ],
                    'translation_search_analyzer' => [
                        'type' => 'custom',
                        'tokenizer' => 'standard',
                        'filter' => ['standard', 'lowercase', 'asciifolding', 'trim']
                    ]
                ]
            ],
            'filter' => [
                'translation' => [
                    'type' => 'edgeNGram',
                    'token_chars' => ["letter", "digit", " whitespace"],
                    'min_gram' => 1,
                    'max_gram' => 30,
                ]
            ],
                ], true);

        //set search type
        $searchType = $searchIndex->getType('messagesList');
        $mapping = new Mapping();
        $mapping->setType($searchType);
        $mapping->setProperties([
            'mess_id' => ['type' => 'integer', 'index' => 'not_analyzed'],
            'cont_id' => ['type' => 'integer', 'index' => 'not_analyzed'],
            'mess_content' => ['type' => 'string', 'store' => 'yes', 'index_analyzer' => 'translation_index_analyzer', 'search_analyzer' => 'translation_search_analyzer', 'term_vector' => 'with_positions_offsets'],
            'user_created' => ['type' => 'integer', 'index' => 'not_analyzed'],
            'created_date' => ['type' => 'long', 'index' => 'not_analyzed'],
            'to_user_id' => ['type' => 'integer', 'index' => 'not_analyzed'],
            'user_info' => ['type' => 'string', 'store' => 'yes', 'index_analyzer' => 'translation_index_analyzer', 'search_analyzer' => 'translation_search_analyzer', 'term_vector' => 'with_positions_offsets'],
            'is_send_mail' => ['type' => 'integer', 'index' => 'not_analyzed'],
            'is_view' => ['type' => 'integer', 'index' => 'not_analyzed'],
        ]);
        $mapping->send();
    }

    public function add($arrDocument) {
        try {
            if (empty($arrDocument) && !$arrDocument instanceof \Elastica\Document) {
                throw new \Exception('Document cannot be blank or must be instance of \Elastica\Document class');
            }
            $arrDocument = is_array($arrDocument) ? $arrDocument : [$arrDocument];
            $this->getSearchType()->addDocuments($arrDocument);
            $this->getSearchType()->getIndex()->refresh();
            return true;
        } catch (\Zend\Http\Exception $exc) {
            if (APPLICATION_ENV !== 'production') {
                throw new \Zend\Http\Exception($exc->getMessage());
            }
            return false;
        }
    }

    public function edit($document) {
        $respond = $this->getSearchType()->updateDocument($document);
        $this->getSearchType()->getIndex()->refresh();
        if ($respond->isOk()) {
            return true;
        }
        return false;
    }

    public function getDetail($params, $arrFields = []) {
        try {
            $boolQuery = new Bool();
            $boolQuery = $this->__buildWhere($params, $boolQuery);
            $query = new ESQuery();
            $query->setQuery($boolQuery);
            if ($arrFields && is_array($arrFields)) {
                $query->setSource($arrFields);
            }
            $instanceSearch = new Search(General::getSearchConfig());
            $resultSet = $instanceSearch->addIndex($this->getSearchIndex())
                    ->addType($this->getSearchType())
                    ->search($query);
            $this->setResultSet($resultSet);
            $detail = current($this->toArray());
            return $detail;
        } catch (\Exception $exc) {
            echo '<pre>';
            print_r($exc->getMessage());
            echo '</pre>';
            die();
        }
    }

    /**
     * Get List Limit
     */
    public function getListLimit($params = array(), $intPage = 1, $intLimit = 15, $sort = ['update_date' => ['order' => 'desc']]) {
        try {
            $intFrom = $intLimit * ($intPage - 1);
            $boolQuery = new Bool();
            $boolQuery = $this->__buildWhere($params, $boolQuery);
            $query = new ESQuery();
            $query->setFrom($intFrom)
                    ->setSize($intLimit)
                    ->setSort($sort);
            $query->setQuery($boolQuery);
            $instanceSearch = new Search(General::getSearchConfig());
            $resultSet = $instanceSearch->addIndex($this->getSearchIndex())
                    ->addType($this->getSearchType())
                    ->search($query);
            $this->setResultSet($resultSet);
            $arrUserList = $this->toArray();
            return $arrUserList;
        } catch (\Exception $exc) {
            echo $exc->getMessage();
            die;
        }
    }

    /**
     * Get List
     */
    public function getList($params, $arrFields = []) {
        $boolQuery = new Bool();
        $boolQuery = $this->__buildWhere($params, $boolQuery);
        $query = new ESQuery();

        $total = $this->getTotal($params);

        $query->setSize($total)
                ->setSort($this->setSort($params));
        $query->setQuery($boolQuery);
        if ($arrFields && is_array($arrFields)) {
            $query->setSource($arrFields);
        }

        $instanceSearch = new Search(General::getSearchConfig());
        $resultSet = $instanceSearch->addIndex($this->getSearchIndex())
                ->addType($this->getSearchType())
                ->search($query);
        $this->setResultSet($resultSet);
        $arrUserList = $this->toArray();
        return $arrUserList;
    }

    /**
     * get Total
     * @param array $arrConditions
     * @return integer
     */
    public function getTotal($arrConditions = array()) {
        $boolQuery = new Bool();
        $boolQuery = $this->__buildWhere($arrConditions, $boolQuery);

        $query = new ESQuery();
        $query->setQuery($boolQuery);
        $instanceSearch = new Search(General::getSearchConfig());
        $resultSet = $instanceSearch->addIndex($this->getSearchIndex())
                ->addType($this->getSearchType())
                ->count($query);
        return $resultSet;
    }

    private function setSort($params) {
        //copy
        return ['customer_id' => ['order' => 'desc']];
    }

    public function removeAllDoc() {
        $respond = $this->getSearchType()->deleteByQuery('_type:customerList');
        $this->getSearchType()->getIndex()->refresh();
        if ($respond->isOk()) {
            return true;
        }
        return false;
    }

    public function __buildWhere($params, $boolQuery) {

        if (empty($params)) {
            return $boolQuery;
        }

        if (!empty($params['mess_id'])) {
            $addQuery = new ESQuery\Term();
            $addQuery->setTerm('mess_id', $params['mess_id']);
            $boolQuery->addMust($addQuery);
        }

        if (!empty($params['user_created'])) {
            $addQuery = new ESQuery\Term();
            $addQuery->setTerm('user_created', $params['user_created']);
            $boolQuery->addMust($addQuery);
        }

        if (!empty($params['is_send_mail'])) {
            $addQuery = new ESQuery\Term();
            $addQuery->setTerm('is_send_mail', $params['is_send_mail']);
            $boolQuery->addMust($addQuery);
        }

        if (!empty($params['is_view'])) {
            $addQuery = new ESQuery\Term();
            $addQuery->setTerm('is_view', $params['is_view']);
            $boolQuery->addMust($addQuery);
        }

        return $boolQuery;
    }

}
