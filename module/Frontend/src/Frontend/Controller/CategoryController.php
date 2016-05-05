<?php

namespace Frontend\Controller;

use My\Controller\MyController,
    My\General;

class CategoryController extends MyController {
    /* @var $serviceCategory \My\Models\Category */
    /* @var $serviceProduct \My\Models\Product */
    /* @var $serviceProperties \My\Models\Properties */

    public function __construct() {
        $this->externalJS = [
            STATIC_URL . '/f/v1/js/my/??category.js'
        ];
    }

    public function indexAction() {
        $params = $this->params()->fromRoute();
        $intPage = (int) $params['page'] > 0 ? (int) $params['page'] : 1;
        $intLimit = 20;

        if (empty($params['cateId']) || empty($params['cateSlug'])) {
            return $this->redirect()->toRoute('404', array());
        }

        $arrCategoryList = unserialize(ARR_CATEGORY);

        if (empty($arrCategoryList[(int) $params['cateId']])) {
            return $this->redirect()->toRoute('404', array());
        }

        $arrCategoryDetail = $arrCategoryList[(int) $params['cateId']];

        if ($arrCategoryDetail['cate_slug'] != $params['cateSlug']) {
            $this->redirect()->toRoute('category', ['cateSlug' => $arrCategoryDetail['cate_slug'], 'cateId' => $arrCategoryDetail['cate_id']]);
        }

        $arrConditionContent = [
            'not_cont_status' => -1
        ];

        $arrConditionProperties = [
            'prop_status' => 1
        ];

        $arrCategoryChildren = [];
        $arrCategoryParent = [];
        if ($arrCategoryDetail['parent_id'] == 0) {
            $arrCategoryParent = $arrCategoryDetail;
            $arrConditionProperties['parent_id'] = $arrCategoryDetail['prop_id'];
            $arrCategoryChildren = unserialize(ARR_CATEGORY_BY_PARENT)[$arrCategoryDetail['cate_id']];
            $arrIdList = [];
            foreach ($arrCategoryChildren as $arr) {
                $arrIdList[] = $arr['cate_id'];
            }
            $arrConditionContent['in_cate_id'] = $arrIdList;
        } else {
            $arrCategoryParent = unserialize(ARR_CATEGORY)[$arrCategoryDetail['parent_id']];
            $arrCategoryChildren = unserialize(ARR_CATEGORY_BY_PARENT)[$arrCategoryDetail['parent_id']];
            $arrConditionContent['cate_id'] = $arrCategoryDetail['cate_id'];
            $arrConditionProperties['parent_id'] = unserialize(ARR_CATEGORY)[$arrCategoryDetail['parent_id']]['prop_id'];
        }

        //list properties
        $instanceSearhProperties = new \My\Search\Properties();
        $arrPropertiesList = $instanceSearhProperties->getList($arrConditionProperties);

        $arrPropertiesFormat = [];
        $propIdList = [];
        foreach ($arrPropertiesList as $prop) {
            $propIdList[] = $prop['prop_id'];
            $arrPropertiesFormat[$prop['prop_id']] = $prop;
        }

        if (!empty($params['propId'])) {
            //kiểm tra properties có nằm trong danh mục
            if (in_array($params['propId'], $propIdList)) {
                $arrConditionContent['prop_id'] = (int) $params['propId'];
            } else {
                $params['propId'] = 0;
            }
        }

        if (!empty($params['distId'])) {
            $arrDistIdList = array_keys(unserialize(ARR_DISTRICT));
            if (in_array($params['distId'], $arrDistIdList)) {
                $arrConditionContent['dist_id'] = (int) $params['distId'];
            } else {
                $params['distId'] = 0;
            }
        }

        //list content 15
        $instanceSearchContent = new \My\Search\Content();
        $arrContentList = $instanceSearchContent->getListLimit($arrConditionContent, $intPage, $intLimit, ['vip_type' => ['order' => 'desc'], 'updated_date' => ['order' => 'desc'], 'created_date' => ['order' => 'desc']]);
        $intTotal = $instanceSearchContent->getTotal($arrConditionContent);
        $helper = $this->serviceLocator->get('viewhelpermanager')->get('Paging');
        $paging = $helper($params['module'], $params['__CONTROLLER__'], $params['action'], $intTotal, $intPage, $intLimit, 'category', $params);

        //info user post
        $arrUserListFormat = [];
        if (!empty($arrContentList)) {
            $arrUserId = [];
            foreach ($arrContentList as $arrContent) {
                $arrUserId[] = $arrContent['user_created'];
            }
            $arrUserId = array_unique($arrUserId);
            $instanceSearchUser = new \My\Search\User();
            $arrUserList = $instanceSearchUser->getList(['in_user_id' => $arrUserId]);
            if (!empty($arrUserList)) {
                foreach ($arrUserList as $value) {
                    $arrUserListFormat[$value['user_id']] = $value;
                }
            }
        }

        $arrLocation = unserialize(ARR_DISTRICT);

        $metaTitle = $arrCategoryDetail['cate_meta_title'] ? $arrCategoryDetail['cate_meta_title'] : $arrCategoryDetail['cate_name'];
        $metaKeyword = $arrCategoryDetail['cate_meta_keyword'] ? $arrCategoryDetail['cate_meta_keyword'] : NULL;
        $metaDescription = $arrCategoryDetail['cate_meta_description'] ? $arrCategoryDetail['cate_meta_description'] : NULL;
        $metaSocial = $arrCategoryDetail['cate_meta_social'] ? $arrCategoryDetail['cate_meta_social'] : NULL;

        $this->renderer = $this->serviceLocator->get('Zend\View\Renderer\PhpRenderer');

        $this->renderer->headMeta()->appendName('dc.description', html_entity_decode($metaDescription) . General::TITLE_META);
        $this->renderer->headMeta()->appendName('dc.subject', html_entity_decode($arrCategoryDetail['cate_name']) . General::TITLE_META);
        $this->renderer->headTitle(html_entity_decode($metaTitle) . General::TITLE_META);
        $this->renderer->headMeta()->appendName('keywords', html_entity_decode($metaKeyword));
        $this->renderer->headMeta()->appendName('description', html_entity_decode('Danh sách rao vặt trong danh mục : ' . $arrCategoryDetail['cate_name']));
        $this->renderer->headMeta()->appendName('social', $metaSocial);
        $this->renderer->headMeta()->setProperty('og:url', $this->url()->fromRoute('category', array('cateSlug' => $params['cateSlug'], 'cateId' => $params['cateId'], 'dist' => $params['dist'], 'distId' => $params['distId'], 'propSlug' => $params['propSlug'], 'propId' => $params['propId'], 'page' => $intPage)));
        $this->renderer->headMeta()->setProperty('og:title', html_entity_decode('Danh sách rao vặt trong danh mục : ' . $arrCategoryDetail['cate_name']));
        $this->renderer->headMeta()->setProperty('og:description', html_entity_decode('Danh sách rao vặt trong danh mục : ' . $arrCategoryDetail['cate_name']));

        return array(
            'params' => $params,
            'paging' => $paging,
            'arrCategoryDetail' => $arrCategoryDetail,
            'arrContentList' => $arrContentList,
            'arrCategoryChildren' => $arrCategoryChildren,
            'arrPropertiesList' => $arrPropertiesFormat,
            'intTotal' => $intTotal,
            'arrLocation' => $arrLocation,
            'arrUserList' => $arrUserListFormat,
            'arrCategoryParent' => $arrCategoryParent
        );
    }

}
