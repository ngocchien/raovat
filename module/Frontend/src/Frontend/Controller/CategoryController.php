<?php

namespace Frontend\Controller;

use My\Controller\MyController,
    My\General;

class CategoryController extends MyController {
    /* @var $serviceCategory \My\Models\Category */
    /* @var $serviceProduct \My\Models\Product */
    /* @var $serviceProperties \My\Models\Properties */

    public function __construct() {
        $this->defaultJS = [
            'frontend:category:index' => 'star-rating.js',
        ];
        $this->defaultCSS = [
            'frontend:category:index' => 'star-rating.css',
        ];
    }

    public function indexAction() {
        $params = $this->params()->fromRoute();
        $intPage = is_numeric($this->params()->fromQuery('page', 1)) ? $this->params()->fromQuery('page', 1) : 1;
        $intLimit = 20;
        if (empty($params['categoryID']) || empty($params['categorySlug'])) {
            return $this->redirect()->toRoute('404', array());
        }

        $serviceCategory = $this->serviceLocator->get('My\Models\Category');
        $arrCondition = array(
            'cate_id' => (int) $params['categoryID'],
            'cate_status' => 1
        );

        $arrCategoryDetail = $serviceCategory->getDetail($arrCondition);

        if ($arrCategoryDetail['cate_slug'] != $params['categorySlug']) {
            return $this->redirect()->toRoute('404', array());
        }

        $serviceProduct = $this->serviceLocator->get('My\Models\Product');
        $serviceProperties = $this->serviceLocator->get('My\Models\Properties');
        $arrProductList = array();
        $arrProperties = array();
        $arrProductVipList = array();
        if ($arrCategoryDetail['cate_parent'] != 0) {
            $arrProperties = $serviceProperties->getList(array('cate_id' => $arrCategoryDetail['cate_parent'], 'not_prop_status' => -1));
            $arrConditionProduct = array(
                'cate_id' => $arrCategoryDetail['cate_id'],
                'not_prod_status' => -1,
                'less_prod_time_vip'=>time(),
            );
            if ($params['properties']) {
                $arrConditionProduct['prop_id'] = $params['properties'];
            }
            if ($params['location']) {
                $arrConditionProduct['dist_id'] = $params['location'];
            }
            $arrProductList = $serviceProduct->getListLimit($arrConditionProduct, $intPage, $intLimit, 'prod_id DESC');
            $arrProductVipList = $serviceProduct->getList(array('prod_vip'=>1,'cate_id'=>$arrCategoryDetail['cate_id'],'prod_time_vip'=>time()));
        }
        $arrCategoryChildrenList = array();
        if ($arrCategoryDetail['cate_parent'] == 0) {
            $arrProperties = $serviceProperties->getList(array('cate_id' => $arrCategoryDetail['cate_id'], 'not_prop_status' => -1));
            $arrCategoryChildrenList = $serviceCategory->getList(array('cate_parent' => $arrCategoryDetail['cate_id'], 'cate_status' => 1));
            if (!empty($arrCategoryChildrenList)) {
                foreach ($arrCategoryChildrenList as $value) {
                    $arrCategoryListID[] = $value['cate_id'];
                    $strCategoryListID = implode(',', $arrCategoryListID);
                }
                if (!empty($strCategoryListID)) {
                    $arrConditionProduct = array(
                        'strCategoryListID' => $strCategoryListID,
                        'not_prod_status' => -1,
                        'less_prod_time_vip'=>time(),
                    );
                    if ($params['properties']) {
                        $arrConditionProduct['prop_id'] = $params['properties'];
                    }
                    if ($params['location']) {
                        $arrConditionProduct['dist_id'] = $params['location'];
                    }
                    $arrProductList = $serviceProduct->getListLimit($arrConditionProduct, $intPage, $intLimit, 'prod_id DESC');
                    $arrProductVipList = $serviceProduct->getList(array('prod_vip'=>1,'strCategoryListID'=>$strCategoryListID,'prod_time_vip'=>time()));
                }
            }
        }
        
        //get List User
//        if ($arrCategoryDetail['cate_parent'] != 0) {
//            
//        }

        $arrCategoryDetail['cate_meta_title'] ? $metaTitle = $arrCategoryDetail['cate_meta_title'] : $metaTitle = $arrCategoryDetail['cate_name'];
        $arrCategoryDetail['cate_meta_keyword'] ? $metaKeyword = $arrCategoryDetail['cate_meta_keyword'] : NULL;
        $arrCategoryDetail['cate_meta_description'] ? $metaDescription = $arrCategoryDetail['cate_meta_description'] : NULL;
        $arrCategoryDetail['cate_meta_social'] ? $metaSocial = $arrCategoryDetail['cate_meta_social'] : NULL;

        $this->renderer = $this->serviceLocator->get('Zend\View\Renderer\PhpRenderer');
        $this->renderer->headTitle(html_entity_decode($metaTitle) . General::TITLE_META);
        $this->renderer->headMeta()->appendName('keywords', html_entity_decode($metaKeyword));
        $this->renderer->headMeta()->appendName('description', html_entity_decode($metaDescription));
        $this->renderer->headMeta()->appendName('social', $metaSocial);
//        p($params);die;
        $intTotal = $serviceProduct->getTotal($arrConditionProduct);
        $helper = $this->serviceLocator->get('viewhelpermanager')->get('Paging');
        $arrParams = array('controller' => 'category', 'action' => 'index', 'categoryID' => $params['categoryID'], 'categorySlug' => $params['categorySlug']);
        $paging = $helper($params['module'], $params['__CONTROLLER__'], $params['action'], $intTotal, $intPage, $intLimit, $params['__CONTROLLER__'], $arrParams);
        foreach($arrProperties as $value){
            $arrPropertiesFormat[$value['prop_id']] =$value;
        }
        return array(
            'params' => $params,
            'paging' => $paging,
            'arrCategoryDetail' => $arrCategoryDetail,
            'arrProductList' => $arrProductList,
            'arrCategoryChildrenList' => $arrCategoryChildrenList,
            'arrProperties' => $arrPropertiesFormat,
            'arrProductVipList'=>$arrProductVipList
        );
    }

}
