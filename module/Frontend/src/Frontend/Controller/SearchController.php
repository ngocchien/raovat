<?php

namespace Frontend\Controller;

use My\Controller\MyController,
    My\General,
    My\Validator\Validate,
    Zend\Validator\File\Size,
    Zend\View\Model\ViewModel,
    Zend\Session\Container;

class SearchController extends MyController {
    /* @var $serviceCategory \My\Models\Category */
    /* @var $serviceProduct \My\Models\Product */
    /* @var $serviceProperties \My\Models\Properties */
    /* @var $serviceDistrict \My\Models\District */
    /* @var $serviceComment \My\Models\Comment */

    public function __construct() {
//        $this->externalJS = [
//            STATIC_URL . '/f/v1/js/my/??search.js'
//        ];
    }

    public function indexAction() {
        $params = array_merge($this->params()->fromRoute(), $this->params()->fromQuery());

        if (empty($params['khu-vuc']) && empty($params['danh-muc']) && empty($params['tu-khoa'])) {
            return $this->redirect()->toRoute('home');
        }

        $intPage = (int) $params['trang'] > 0 ? (int) $params['trang'] : 1;
        $intLimit = 15;
        $arrCondition = [
            'not_cont_status' => -1
        ];

        $distName = 'Toàn tỉnh';
        if (!empty($params['khu-vuc'])) {
            foreach (unserialize(ARR_DISTRICT) as $dist) {
                if ($dist['dist_slug'] == $params['khu-vuc']) {
                    $distName = $dist['dist_name'];
                    $arrCondition['dist_id'] = $dist['dist_id'];
                    break;
                }
            }
        }
        $cateName = 'Tất cả danh mục';
        if (!empty($params['danh-muc'])) {
            $arrCategoryList = unserialize(ARR_CATEGORY);
            foreach ($arrCategoryList as $cate) {
                if ($cate['cate_slug'] == $params['danh-muc']) {
                    $cateName = $cate['cate_name'];
                    if ($cate['parent_id'] == 0) {
                        $arrChild = unserialize(ARR_CATEGORY_BY_PARENT)[$cate['cate_id']];
                        $arrIdList = [];
                        foreach ($arrChild as $child) {
                            $arrIdList[] = $child['cate_id'];
                        }
                        $arrCondition['in_cate_id'] = $arrIdList;
                    } else {
                        $arrCondition['cate_id'] = $cate['cate_id'];
                    }
                }
            }
        }
        if (!empty($params['tu-khoa'])) {
            $arrCondition['key_word'] = trim(strip_tags($params['tu-khoa']));
        }

        $instaceSearchContent = new \My\Search\Content();
        $arrContentList = $instaceSearchContent->getListLimit($arrCondition, $intPage, $intLimit, ['created_date' => ['order' => 'desc']]);

        //phân trang
        $intTotal = $instaceSearchContent->getTotal($arrCondition);
        $helper = $this->serviceLocator->get('viewhelpermanager')->get('Paging');
        $paging = $helper($params['module'], $params['__CONTROLLER__'], $params['action'], $intTotal, $intPage, $intLimit, 'search', $params);

        $description = General::SITE_AUTH . ' -- Tìm kiếm';
        if (!empty($params['khu-vuc'])) {
            $description .=' || khu-vuc = ' . $distName;
        }

        if (!empty($params['danh-muc'])) {
            $description .=' || danh-muc = ' . $cateName;
        }

        if (!empty($params['tu-khoa'])) {
            $description .=' || tu-khoa = ' . $params['tu-khoa'];
        }

        $this->renderer = $this->serviceLocator->get('Zend\View\Renderer\PhpRenderer');
        $this->renderer->headMeta()->appendName('dc.description', $description);
        $this->renderer->headTitle($description . General::TITLE_META);
        $this->renderer->headMeta()->appendName('keywords', 'bestquynhon.com, dien dan rao vat binh dinh, rao vat, tim kiem , tim kiem' . $description);
        $this->renderer->headMeta()->appendName('description', $description);
        $this->renderer->headMeta()->setProperty('og:url', $this->url()->fromRoute('search', array('khu-vuc' => $params['khu-vuc'], 'danh-muc' => $params['danh-muc'], 'tu-khoa' => $params['tu-khoa'])));
        $this->renderer->headMeta()->setProperty('og:title', $description);
        $this->renderer->headMeta()->setProperty('og:description', $description);

        $arrUserList = [];
        $arrPropertiesList = [];
        if (!empty($arrContentList)) {
            $arrIdList = [];
            $arrPropertiesId = [];
            foreach ($arrContentList as $arrContent) {
                if (!empty($arrContent['prop_id'])) {
                    $arrPropertiesId[] = $arrContent['prop_id'];
                }

                if (!empty($arrContent['user_created'])) {
                    $arrIdList[] = $arrContent['user_created'];
                }
            }

            if (!empty($arrIdList)) {
                $arrIdList = array_unique($arrIdList);
                $instaceSearchUser = new \My\Search\User();
                $arrUserTemp = $instaceSearchUser->getList(['in_user_id' => $arrIdList]);
                if (!empty($arrUserTemp)) {
                    foreach ($arrUserTemp as $arrUser) {
                        $arrUserList[$arrUser['user_id']] = $arrUser;
                    }
                }
            }
            if (!empty($arrPropertiesId)) {
                $arrPropertiesId = array_unique($arrPropertiesId);
                $instaceSearchProperties = new \My\Search\Properties();
                $arrPropertiesListTemp = $instaceSearchProperties->getList(['in_prop_id' => $arrPropertiesId]);
                if (!empty($arrPropertiesListTemp)) {
                    foreach ($arrPropertiesListTemp as $value) {
                        $arrPropertiesList[$value['prop_id']] = $value;
                    }
                }
            }
        }
        return [
            'paging' => $paging,
            'params' => $params,
            'arrContentList' => $arrContentList,
            'arrUserList' => $arrUserList,
            'intTotal' => $intTotal,
            'arrPropertiesList' => $arrPropertiesList,
            'distName' => $distName,
            'cateName' => $cateName
        ];
    }

}
