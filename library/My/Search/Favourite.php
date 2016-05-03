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

class Favourite extends SearchAbstract {

    public function __construct() {
        $this->setSearchIndex(SEARCH_PREFIX . 'favourite');
        $this->setSearchType('favouriteList');
    }

    public function createIndex() {
        $strIndexName = SEARCH_PREFIX . 'favourite';

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
        $searchType = $searchIndex->getType('favouriteList');
        $mapping = new Mapping();
        $mapping->setType($searchType);
        $mapping->setProperties([
            'favo_id' => ['type' => 'integer', 'index' => 'not_analyzed'],
            'cont_id' => ['type' => 'integer', 'index' => 'not_analyzed'],
            'user_id' => ['type' => 'integer', 'index' => 'not_analyzed'],
            'created_date' => ['type' => 'long', 'index' => 'not_analyzed'],
            'updated_date' => ['type' => 'long', 'index' => 'not_analyzed'],
            'status' => ['type' => 'integer', 'index' => 'not_analyzed'],
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
    public function getListLimit($params = array(), $intPage = 1, $intLimit = 15, $sort = ['updated_date' => ['order' => 'desc']]) {
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
        return ['updated_date' => ['order' => 'desc']];
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

        if (!empty($params['cont_id'])) {
            $addQuery = new ESQuery\Term();
            $addQuery->setTerm('cont_id', $params['cont_id']);
            $boolQuery->addMust($addQuery);
        }

        if (!empty($params['user_id'])) {
            $addQuery = new ESQuery\Term();
            $addQuery->setTerm('user_id', $params['user_id']);
            $boolQuery->addMust($addQuery);
        }

        if (!empty($params['status'])) {
            $addQuery = new ESQuery\Term();
            $addQuery->setTerm('status', $params['status']);
            $boolQuery->addMust($addQuery);
        }

        if (!empty($params['not_status'])) {
            $addQuery = new ESQuery\Term();
            $addQuery->setTerm('status', $params['not_status']);
            $boolQuery->addMustNot($addQuery);
        }

        if (!empty($params['in_favo_id'])) {
            $addQuery = new ESQuery\Terms();
            $addQuery->setTerms('favo_id', $params['in_favo_id']);
            $boolQuery->addMust($addQuery);
        }
//        echo '<pre>';
//        print_r($boolQuery);
//        echo '</pre>';
//        die();
        return $boolQuery;
    }

}
