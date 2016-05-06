<?php

namespace Frontend\Controller;

use My\Controller\MyController;

class IndexController extends MyController {
    /* @var $serviceCategory \My\Models\Category */
    /* @var $serviceProduct \My\Models\Product */

    public function __construct() {
        $this->externalCSS = [
            STATIC_URL . '/f/v1/css/??owl.carousel.css',
            STATIC_URL . '/f/v1/css/??owl.theme.default.css',
            STATIC_URL . '/f/v1/css/??layerslider.css',
        ];
        $this->externalJS = [
            STATIC_URL . '/f/v1/js/library/??owl.carousel.js',
            STATIC_URL . '/f/v1/js/library/??default.js',
            STATIC_URL . '/f/v1/js/library/??greensock.js',
            STATIC_URL . '/f/v1/js/library/??layerslider.kreaturamedia.jquery.js'
        ];
    }

    public function indexAction() {

        $username = 'nguyenngocchien0104';
        $password = 'chien123';
        $loginUrl = 'http://vlbinhdinh.vieclamvietnam.gov.vn/Login/tabid/10176/Default.aspx?returnurl=%2fTrangChu.aspx';

//init curl
        $ch = curl_init();
//Set the URL to work with
        curl_setopt($ch, CURLOPT_URL, $loginUrl);
// ENABLE HTTP POST
        curl_setopt($ch, CURLOPT_POST, 1);
//Set the post parameters
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'dnn$ctr13373$Main$Login$Login_DNN$txtUsername=' . $username . '&dnn$ctr13373$Main$Login$Login_DNN$txtPassword=' . $password);

//Handle cookies for the login
        curl_setopt($ch, CURLOPT_COOKIEJAR, PUBLIC_PATH . 'cookie.txt');

//Setting CURLOPT_RETURNTRANSFER variable to 1 will force cURL
//not to print out the results of its query.
//Instead, it will return the results as a string return value
//from curl_exec() instead of the usual true/false.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//execute the request (the login)
        $store = curl_exec($ch);

//the login is now done and you can continue to get the
//protected content.
//set the URL to the protected file
        curl_setopt($ch, CURLOPT_URL, 'http://vlbinhdinh.vieclamvietnam.gov.vn/thongtintuyendung.aspx?tuyendungId=ec10b8bf-5766-4ead-9a01-b3f5872bfd17');

//execute the request
        $content = curl_exec($ch);
        echo '<pre>';
        print_r($content);
        echo '</pre>';
        die();
//save the data to disk
        file_put_contents('~/download.zip', $content);


        //
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
