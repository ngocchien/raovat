<?php

namespace Frontend\Controller;

use My\Controller\MyController;

class IndexController extends MyController {
    /* @var $serviceCategory \My\Models\Category */
    /* @var $serviceProduct \My\Models\Product */

    public function __construct() {
//        $this->externalCSS = [
//            STATIC_URL . '/f/v1/css/??owl.carousel.css',
//            STATIC_URL . '/f/v1/css/??owl.theme.default.css',
//            STATIC_URL . '/f/v1/css/??layerslider.css',
//        ];
//        $this->externalJS = [
//            STATIC_URL . '/f/v1/js/library/??owl.carousel.js',
//            STATIC_URL . '/f/v1/js/library/??default.js',
//            STATIC_URL . '/f/v1/js/library/??greensock.js',
//            STATIC_URL . '/f/v1/js/library/??layerslider.kreaturamedia.jquery.js'
//        ];
    }

    public function indexAction() {
        $params = $this->params()->fromRoute();

        $arrCategoryParentList = unserialize(ARR_CATEGORY_PARENT);
        $arrCategoryByParent = unserialize(ARR_CATEGORY_BY_PARENT);
        $arrCategoryFormat = unserialize(ARR_CATEGORY);

        //Danh sách  rao vặt víp
        $instaceSearchContent = new \My\Search\Content();
        $arrConditionContent = [
            'cont_status' => 1,
            'is_vip' => 1,
            'vip_type' => \My\General::VIP_ALL_PAGE,
            'more_expired_time' => time()
        ];
        $arrContentList = $instaceSearchContent->getList($arrConditionContent, ['updated_date' => ['order' => 'desc'], 'created_date' => ['order' => 'desc']]);

        $intPage = (int) $params['page'] > 0 ? (int) $params['page'] : 1;
        $intLimit = 30;
        $arrConditionNewContent = [
            'cont_status' => 1,
            'not_type_vip' => \My\General::VIP_ALL_PAGE
        ];
        $arrNewContent = $instaceSearchContent->getListLimit($arrConditionNewContent, $intPage, $intLimit, ['vip_type' => ['order' => 'desc'], 'updated_date' => ['order' => 'desc'], 'created_date' => ['order' => 'desc']]);

        $intTotal = $instaceSearchContent->getTotal($arrConditionContent);
        $helper = $this->serviceLocator->get('viewhelpermanager')->get('Paging');
        $paging = $helper($params['module'], $params['__CONTROLLER__'], $params['action'], $intTotal, $intPage, $intLimit, 'category', $params);

        $arrPropIdList = [];
        $arrUserIdList = [];

        if (!empty($arrNewContent)) {
            foreach ($arrNewContent as $arrContent) {
                $arrPropIdList[] = $arrContent['prop_id'];
                $arrUserIdList[] = $arrContent['user_created'];
            }
        }

        if (!empty($arrContentList)) {
            foreach ($arrContentList as $arrContent) {
                $arrPropIdList[] = $arrContent['prop_id'];
                $arrUserIdList[] = $arrContent['user_created'];
            }

            $arrPropIdList = array_unique($arrPropIdList);
            $arrUserIdList = array_unique($arrUserIdList);
        }

        $arrUserList = [];
        $arrPropertiesList = [];

        if (!empty($arrUserIdList)) {
            $instanceSearchUser = new \My\Search\User();
            $arrUserListTemp = $instanceSearchUser->getList(['in_user_id' => $arrUserIdList]);

            if (!empty($arrUserListTemp)) {
                foreach ($arrUserListTemp as $value) {
                    $arrUserList[$value['user_id']] = $value;
                }
            }
            unset($instanceSearchUser);
            unset($arrUserListTemp);
        }

        if (!empty($arrPropIdList)) {
            $instaceSearchProperties = new \My\Search\Properties();
            $arrPropertiesListTemp = $instaceSearchProperties->getList(['in_prop_id' => $arrPropIdList]);

            foreach ($arrPropertiesListTemp as $value) {
                $arrPropertiesList[$value['prop_id']] = $value;
            }
            unset($instaceSearchProperties);
            unset($arrPropertiesListTemp);
        }

        return [
            'param' => $params,
            'arrCategoryParentList' => $arrCategoryParentList,
            'arrCategoryByParent' => $arrCategoryByParent,
            'arrCategoryFormat' => $arrCategoryFormat,
            'arrContentList' => $arrContentList,
            'arrUserList' => $arrUserList,
            'arrPropertiesList' => $arrPropertiesList,
            'arrNewContentList' => $arrNewContent,
            'paging' => $paging
        ];
    }

}
