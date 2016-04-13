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
        $params = $this->params()->fromRoute();

        $arrCategoryParentList = unserialize(ARR_CATEGORY_PARENT);
        $arrCategoryByParent = unserialize(ARR_CATEGORY_BY_PARENT);
        $arrCategoryFormat = unserialize(ARR_CATEGORY);

        return array(
            'param' => $params,
            'arrCategoryParentList' => $arrCategoryParentList,
            'arrCategoryByParent' => $arrCategoryByParent,
            'arrCategoryFormat' => $arrCategoryFormat,
        );
    }

}
