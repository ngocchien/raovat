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
    }

    public function indexAction() {
        $params = $this->params()->fromRoute();
        $serviceCategory = $this->serviceLocator->get('My\Models\Category');
        $arrCategoryList = unserialize(ARR_CATEGORY);

        $arrCategoryParentList = [];
        $arrCategoryByParent = [];
        $arrCategoryFormat = [];
        if (!empty($arrCategoryList)) {
            foreach ($arrCategoryList as $arrCategory) {
                if ($arrCategory['parent_id'] == 0) {
                    $arrCategoryParentList[$arrCategory['cate_id']] = $arrCategory;
                } else {
                    $arrCategoryByParent[$arrCategory['parent_id']][] = $arrCategory;
                }
                $arrCategoryFormat[$arrCategory['cate_id']] = $arrCategory;
            }
        }
        return array(
            'param' => $params,
            'arrCategoryParentList' => $arrCategoryParentList,
            'arrCategoryByParent' => $arrCategoryByParent,
            'arrCategoryFormat' => $arrCategoryFormat,
        );
    }

}
