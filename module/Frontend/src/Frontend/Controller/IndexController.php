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
//            STATIC_URL . '/b/v1/css/??category.js',
        ];
    }

    public function indexAction() {
        $params = $this->params()->fromRoute();
        $serviceCategory = $this->serviceLocator->get('My\Models\Category');
        $arrCategoryParentList = unserialize(ARR_CATEGORY);

        if (!empty($arrCategoryParentList)) {
            foreach ($arrCategoryParentList as $arrCategoryParent) {
                $arrCategoryParentListID[] = $arrCategoryParent['cate_id'];
            }
        }

        $arrCategoryFormat = array();

        if (!empty($arrCategoryParentListID)) {
            $strCategoryParentListID = implode(',', $arrCategoryParentListID);
            $arrCategoryListChildren = $serviceCategory->getList(array('listCategoryParentID' => $strCategoryParentListID, 'cate_status' => 1));
            if (!empty($arrCategoryListChildren)) {
                foreach ($arrCategoryParentListID as $valueParent) {
                    foreach ($arrCategoryListChildren as $valueChildren) {
                        $arrCategoryFormat[$valueChildren['cate_id']] = $valueChildren;
                        if ($valueChildren['cate_parent'] == $valueParent) {
                            $arrCategoryListChildrenFormat[$valueParent][] = $valueChildren;
                        }
                    }
                }
            }
        }

        //get Product Vip
        /*        $serviceProduct = $this->serviceLocator->get('My\Models\Product');
          $arrProductVipList = $serviceProduct->getList(array('prod_vip'=>2,'prod_time_vip'=>time()));
          $arrUserListFormat = array();
          if(!empty($arrProductVipList)){
          foreach($arrProductVipList as  $value){
          $arrListUserID[]= $value['user_created'];
          }
          $arrListUserID = array_unique($arrListUserID);
          foreach ($arrListUserID as $offset => $row) {
          if ('' == trim($row)) {
          unset($arrListUserID[$offset]);
          }
          }
          $strListUserID = implode(',', $arrListUserID);
          if(!empty($strListUserID)){
          $serviceUser = $this->serviceLocator->get('My\Models\User');
          $arrUserList = $serviceUser->getList(array('listUserID'=>$strListUserID));
          if(!empty($arrUserList)){
          foreach($arrUserList as $value){
          $arrUserListFormat[$value['user_id']]= $value;
          }
          }
          }
          }
         */
        return array(
            'param' => $params,
            'arrCategoryParentList' => $arrCategoryParentList,
            'arrCategoryListChildrenFormat' => $arrCategoryListChildrenFormat,
            'arrProductVipList' => $arrProductVipList,
            'arrUserList' => $arrUserListFormat,
            'arrCategory' => $arrCategoryFormat
//            'arrLocation' => $arrLocation
        );
    }

}
