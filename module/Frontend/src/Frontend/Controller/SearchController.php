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
        if (!empty($params['khu-vuc'])) {
            foreach (unserialize(ARR_DISTRICT) as $dist) {
                if ($dist['dist_slug'] == $params['khu-vuc']) {
                    $arrCondition['dist_id'] = $dist['dist_id'];
                    break;
                }
            }
        }
        if (!empty($params['danh-muc'])) {
            $arrCategoryList = unserialize(ARR_CATEGORY);
            foreach ($arrCategoryList as $cate) {
                if ($cate['cate_slug'] == $params['danh-muc']) {
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
            $arrCondition['key_word'] = trim($params['tu-khoa']);
        }

        $instaceSearchContent = new \My\Search\Content();
        $arrContentList = $instaceSearchContent->getListLimit($arrCondition, $intPage, $intLimit, ['is_vip' => ['order' => 'desc'], 'vip_type' => ['order' => 'desc'], 'created_date' => ['order' => 'desc']]);

        //phân trang
        $intTotal = $instaceSearchContent->getTotal($arrCondition);
        $helper = $this->serviceLocator->get('viewhelpermanager')->get('Paging');
        $paging = $helper($params['module'], $params['__CONTROLLER__'], $params['action'], $intTotal, $intPage, $intLimit, 'search', $params);

        $description = General::SITE_AUTH . ' -- Tìm kiếm';
        if (!empty($params['khu-vuc'])) {
            $description .=' || khu-vuc = ' . $params['khu-vuc'];
        }

        if (!empty($params['danh-muc'])) {
            $description .=' || danh-muc = ' . $params['danh-muc'];
        }

        if (!empty($params['tu-khoa'])) {
            $description .=' || tu-khoa = ' . $params['tu-khoa'];
        }

        $this->renderer = $this->serviceLocator->get('Zend\View\Renderer\PhpRenderer');
        $this->renderer->headMeta()->appendName('dc.description', $description);
        $this->renderer->headTitle($description . General::TITLE_META);
        $this->renderer->headMeta()->appendName('keywords', 'quynhon247.com, rao vat, tim kiem , tim kiem' . $description);
        $this->renderer->headMeta()->appendName('description', $description);
        $this->renderer->headMeta()->setProperty('og:url', $this->url()->fromRoute('search', array('khu-vuc' => $params['khu-vuc'], 'danh-muc' => $params['danh-muc'], 'tu-khoa' => $params['tu-khoa'])));
        $this->renderer->headMeta()->setProperty('og:title', $description);
        $this->renderer->headMeta()->setProperty('og:description', $description);

        $arrUserList = [];
        if (!empty($arrContentList)) {
            $arrIdList = [];
            foreach ($arrContentList as $arrContent) {
                if (!empty($arrContent['user_created'])) {
                    $arrIdList[] = $arrContent['user_created'];
                }
            }
            if (!empty($arrIdList)) {
                $arrIdList = array_unique($arrIdList);
                $serviceUser = $this->serviceLocator->get('My\Models\User');
                $arrUserTemp = $serviceUser->getList(['in_user_id' => implode(',', $arrIdList)]);
                if (!empty($arrUserTemp)) {
                    foreach ($arrUserTemp as $arrUser) {
                        $arrUserList[$arrUser['user_id']] = $arrUser;
                    }
                }
            }
        }
        return [
            'paging' => $paging,
            'params' => $params,
            'arrContentList' => $arrContentList,
            'arrUserList' => $arrUserList,
            'intTotal'=>$intTotal
        ];
    }

}
