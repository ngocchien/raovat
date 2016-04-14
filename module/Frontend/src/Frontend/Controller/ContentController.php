<?php

namespace Frontend\Controller;

use My\Controller\MyController,
    My\General,
    My\Validator\Validate,
    Zend\Validator\File\Size,
    Zend\View\Model\ViewModel,
    Zend\Session\Container;

class ContentController extends MyController {
    /* @var $serviceCategory \My\Models\Category */
    /* @var $serviceProduct \My\Models\Product */
    /* @var $serviceProperties \My\Models\Properties */
    /* @var $serviceDistrict \My\Models\District */
    /* @var $serviceComment \My\Models\Comment */

    public function __construct() {

        $this->externalJS = [
            STATIC_URL . '/f/v1/js/my/??content.js',
            STATIC_URL . '/f/v1/js/library/tinymce/tinymce.min.js'
        ];
    }

    public function detailAction() {
        $params = $this->params()->fromRoute();
        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = $_SERVER['REMOTE_ADDR'];

        $intPage = is_numeric($this->params()->fromQuery('page', 1)) ? $this->params()->fromQuery('page', 1) : 1;
        $intLimit = 20;
        if (empty($params['productId']) || empty($params['productslug'])) {
            return $this->redirect()->toRoute('404', array());
        }

        $serviceProduct = $this->serviceLocator->get('My\Models\Product');
        $arrCondition = array(
            'prod_id' => (int) $params['productId'],
            'not_prod_status' => -1
        );
        $arrProductDetail = $serviceProduct->getDetail($arrCondition);

        if ($arrProductDetail['prod_slug'] != $params['productslug']) {
            return $this->redirect()->toRoute('404', array());
        }
        $serviceProduct->editviewer($arrProductDetail['prod_id']);
        $serviceCategory = $this->serviceLocator->get('My\Models\Category');
        $arrCategoryDetail = $serviceCategory->getDetail(array('cate_id' => $arrProductDetail['cate_id']));
        $arrCategoryParent = array();
        if ($arrCategoryDetail['cate_parent'] != 0) {
            $arrCategoryParent = $serviceCategory->getDetail(array('cate_id' => $arrCategoryDetail['cate_parent']));
        }
        $arrConditionProduct = array(
            'small_prod_id' => $arrProductDetail['prod_id'],
            'cate_id' => $arrProductDetail['cate_id'],
            'not_prod_status' => -1
        );
        $arrProductInCate = array();
        $arrProductInCate = $serviceProduct->getListLimit($arrConditionProduct, $intPage, $intLimit, 'prod_id DESC');

        //get list Parent Comment in Product
        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ipaddress = $client;
        }

        if (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ipaddress = $forward;
        }

        if (filter_var($remote, FILTER_VALIDATE_IP)) {
            $ipaddress = $remote;
        }

        $arrDataComment = array(
            'prod_id' => $arrProductDetail['prod_id'],
            'ipaddress' => $ipaddress,
        );
//        p('chưa loi');
        $intPage = $this->params()->fromRoute('page', 1);
        $intLimit = 10;
        $arrCondition = array('prod_id' => $arrProductDetail['prod_id'], 'comm_status' => 1, 'comm_parent' => 0, 'comm_ip' => $ipaddress);
        $serviceComment = $this->serviceLocator->get('My\Models\Comment');
        $intTotalComment = $serviceComment->getTotalInProduct($arrCondition);
//        p($intTotalComment);die;
        $arrParentCommentList = $serviceComment->getListLimitInProduct($arrCondition, $intPage, $intLimit, 'comm_id ASC');
        $helper = $this->serviceLocator->get('viewhelpermanager')->get('Pagingajax');   //phân trang ajax
        $pagingComment = $helper($params['module'], $params['__CONTROLLER__'], $params['action'], $intTotalComment, $intPage, $intLimit, 'product', array('controller' => 'product', 'action' => 'detail', 'page' => $intPage));

        //get list userComment
        $totalComment = 0;
        $arrListCommentChildren = array();
        if (count($arrParentCommentList) > 0) {
            $totalComment = $totalComment + count($arrParentCommentList);
            foreach ($arrParentCommentList as $key => $value) {
                $listIdParent[] = $value['comm_id'];
                $listIdUser[] = $value['user_id'];
            }
            $arrListCommentChildren = array();
            if (count($listIdParent) > 0) {
                $strlistIdParent = implode(',', $listIdParent);
                $listCommentChildren = $serviceComment->getListChildren(array('listIdParen' => $strlistIdParent, 'comm_status' => 1, 'comm_ip' => $ipaddress));
                if (count($listCommentChildren) > 0) {
                    foreach ($listCommentChildren as $value) {
                        $totalComment = $totalComment + 1;
                        $arrListCommentChildren[$value['comm_parent']][] = $value;
                        $listIdUser[] = $value['user_id'];
                    }
                }
            }
//            p($arrListCommentChildren);die;
            //get info user Comment
            $listIdUser = array_unique($listIdUser);
//            p($listIdUser);die;
            $arrListUserComment = array();
            if (count($listIdUser) > 0) {
                $serviceUser = $this->serviceLocator->get('My\Models\User');
                $strListId = implode(',', $listIdUser);
                $listUserComment = $serviceUser->getList(array('listUserID' => $strListId));
                if (count($listUserComment) > 0) {
                    foreach ($listUserComment as $valueUser) {
                        $arrListUserComment[$valueUser['user_id']] = $valueUser;
                    }
                }
            }
        }
//        p($arrListUserComment);die;
        //get User
        $serviceUser = $this->serviceLocator->get('My\Models\User');
        $arrUserDetail = $serviceUser->getDetail(array('user_id' => $arrProductDetail['user_created']));

        $arrProductDetail['cate_meta_title'] ? $metaTitle = $arrProductDetail['cate_meta_title'] : $metaTitle = $arrProductDetail['prod_name'];
        $arrProductDetail['cate_meta_keyword'] ? $metaKeyword = $arrProductDetail['cate_meta_keyword'] : NULL;
        $arrProductDetail['cate_meta_description'] ? $metaDescription = $arrProductDetail['cate_meta_description'] : NULL;
        $arrProductDetail['cate_meta_social'] ? $metaSocial = $arrProductDetail['cate_meta_social'] : NULL;

        $this->renderer = $this->serviceLocator->get('Zend\View\Renderer\PhpRenderer');
        $this->renderer->headTitle(html_entity_decode($metaTitle) . General::TITLE_META);
        $this->renderer->headMeta()->appendName('keywords', html_entity_decode($metaKeyword));
        $this->renderer->headMeta()->appendName('description', html_entity_decode($metaDescription));
        $this->renderer->headMeta()->appendName('social', $metaSocial);
//        $intTotalView = $serviceProduct->getviewer($arrProductDetail['prod_id']);
//        p($intTotalView);die;


        return array(
            'params' => $params,
            'arrProductDetail' => $arrProductDetail,
            'arrCategoryDetail' => $arrCategoryDetail,
            'arrProductInCate' => $arrProductInCate,
            'arrCategoryParent' => $arrCategoryParent,
            'arrUserDetail' => $arrUserDetail,
            'intTotalComment' => $intTotalComment,
            'arrParentCommentList' => $arrParentCommentList,
            'pagingComment' => $pagingComment,
            'arrListCommentChildren' => $arrListCommentChildren,
            'arrListUserComment' => $arrListUserComment
        );
    }

    public function addAction() {

        $params = $this->params()->fromRoute();
        $errors = array();

        if ($this->request->isPost()) {
            $params = $this->params()->fromPost();
            if (empty($params['category'])) {
                $errors['category'] = 'Chưa chọn danh mục cho tin rao vặt !';
            } else {
                $intCategoryId = (int) ($params['category']);
                $arrCategoryList = unserialize(ARR_CATEGORY);
                if (empty($arrCategoryList[$intCategoryId]) || empty($arrCategoryList[$arrCategoryList[$intCategoryId]['parent_id']])) {
                    $errors['category'] = 'Danh mục không tồn tại trong hệ thống !';
                }
            }

            $intProperties = (int) $params['properties'];
            if ($intProperties) {
                $serviceProperties = $this->serviceLocator->get('My\Models\Properties');
                $arrProperties = $serviceProperties->getDetail(['prop_id' => $intProperties, 'prop_status' => 1]);

                if (empty($arrProperties)) {
                    $errors['properties'] = 'Nhu cầu rao vặt bạn chọn không tồn tại trong hệ thống !';
                } else {
                    if ($arrCategoryList[$arrCategoryList[$intCategoryId]['parent_id']]['prop_id'] != $arrProperties['parent_id']) {
                        $errors['properties'] = 'Nhu cầu rao vặt bạn chọn không tồn tại trong hệ thống !';
                    }
                }
            }

            if (empty($params['content_title'])) {
                $errors['content_title'] = 'Chưa nhập tiêu đề cho tin rao vặt !';
            }

            if (empty($params['content_content'])) {
                $errors['content_content'] = 'Chưa nhập nội dung cho tin rao vặt !';
            }

            if (empty($params['content_tags'])) {
                $errors['content_tags'] = 'Chưa chọn tags cho tin rao vặt !';
            }

            if (empty(CUSTOMER_ID)) {

                if (empty($params['name'])) {
                    $errors['userInfo']['name'] = 'Vui lòng nhập họ và tên để liên lạc !';
                }

                if (empty($params['email'])) {
                    $errors['userInfo']['email'] = 'Vui lòng nhập email liên lạc';
                } else {
                    $validatorEmail = new Zend\Validator\EmailAddress();
                    if (!$validatorEmail->isValid($params['email'])) {
                        $errors['userInfo']['email'] = 'Địa chỉ email không hợp lệ!';
                    }
                }

                if (empty($params['phone'])) {
                    $errors['userInfo']['phone'] = 'Vui lòng nhập số điện thoại liên lạc';
                } else {
                    $validationPhone = new Zend\I18n\Validator\IsInt;
                    if (!$validationPhone->isValid($params['phone'])) {
                        $errors['userInfo']['phone'] = 'Số điện thoại không hợp lệ';
                    } else {
                        $validBetween = new Zend\Validator\Between(array('min' => 8, 'max' => 12));
                        if (!$validBetween->isValid($params['phone'])) {
                            $errors['userInfo']['phone'] = 'Số điện thoại phải từ 8 đến 12 số';
                        }
                    }
                }

                if (empty($params['password'])) {
                    $errors['userInfo']['password'] = 'Vui lòng nhập mật khẩu để sửa tin';
                } else {
                    if (strlen($params['password']) < 6) {
                        $errors['userInfo']['password'] = 'Mật khẩu phải từ 6 ký tự trở lên!';
                    }
                }
            }
            if (empty($errors)) {

                /*
                 * Kiểm tra spam và trùng lặp tin
                 */
                $serviceContent = $this->serviceLocator->get('My\Models\Content');
                if (empty(CUSTOMER_ID)) {
                    $arrCondition = [
                        'ip_address' => $this->getRequest()->getServer('REMOTE_ADDR'),
                        'created_date_today' => 1
                    ];
                    $intTotal = $serviceContent->getTotal($arrCondition);
                    if ($intTotal >= 3) {
                        $errors['total'] = 'Bạn chưa đăng ký thành viên nên chỉ được đăng tối đa 3 tin 1 ngày! Mời bạn đăng ký để sử dụng đầu đủ tính năng!';
                    }
                } else {
                    $arrCondition = [
                        'cont_slug' => General::getSlug(trim($params['content_title'])),
                        'user_created' => CUSTOMER_ID,
                        'cate_id' => $intCategoryId
                    ];

                    $arrContent = $serviceContent->getDetail($arrCondition);
                    if ($arrContent) {
                        $errors['total'] = 'Bạn đã đăng tin này trong, danh mục này! Vui lòng kiểm tra lại danh sách tin đã đăng!';
                    }
                }

                if (empty($errors)) {
                    $arrData = array(
                        'cont_title' => htmlentities($params['content_title']),
                        'cont_slug' => General::getSlug(trim($params['content_title'])),
                        'cont_detail' => \My\Minifier\HtmlMin::minify($params['content_content']),
                        'cate_id' => $intCategoryId,
                        'user_created' => UID,
                        'cont_image' => trim($params['image_prod']),
                        'prop_id' => $intProperties,
                        'created_date' => time(),
                        'ip_address' => $this->getRequest()->getServer('REMOTE_ADDR')
                    );
                    if (empty(CUSTOMER_ID)) {
                        $arrData['user_info'] = [
                            'name' => $params['name'],
                            'email' => $params['email'],
                            'phone' => $params['phone'],
                            'password' => $params['password']
                        ];
                    }
                    $intResult = $serviceContent->add($arrData);

                    if ($intResult > 0) {
                        //update tổng số rao vặt trong danhmục
//                        $serviceCategory->edit(array('cate_total_product' => $arrCategoryDetail['cate_total_product'] + 1), $arrCategoryDetail['cate_id']);
                        //update tổng số rao vặt danh mục cha
//                        $serviceCategory->edit(array('cate_total_product' => $arrCategory[$arrCategoryDetail['cate_parent']]['cate_total_product'] + 1), $arrCategoryDetail['cate_parent']);

                        $completeSession = new Container('contentComplete');
                        $completeSession->complete = true;

                        return $this->redirect()->toRoute('add-content-complete');
                    }
                    $errors['total'] = 'Xảy ra lỗi trong quá trình xử lý !';
                }
            }
        }

        $this->renderer = $this->serviceLocator->get('Zend\View\Renderer\PhpRenderer');
        $this->renderer->headTitle(html_entity_decode('Rao vặt - Đăng tin rao vặt') . General::TITLE_META);
        $this->renderer->headMeta()->appendName('keywords', html_entity_decode('chototquynhon.com, rao vặt, đăng tin rao vặt, rao vat, dang tin mua bán, dang tin rao vat quy nhon, tuyen dung - viec lam quy nhon, dang tin rao vat mien phi, dang rao vat chototquynhon.com'));
        $this->renderer->headMeta()->appendName('description', html_entity_decode('chototquynhon.com  - sRao vặt - Đăng tin rao vặt, đăng tin rao vặt , mua bán, tuyển dụng , tìm việc tại miễn phí quy nhơn - bình định , rao vặt quy nhơn bình định nhanh chóng , chototquynhon.com - đăng tin rao vặt nhanh chóng, miễn phí !' . General::TITLE_META));

        $arrPropertiesList = [];
        if ($params['category']) {
            $arrCategoryList = unserialize(ARR_CATEGORY);
            $propertiesId = $arrCategoryList[$arrCategoryList[$params['category']]['parent_id']]['prop_id'];
            if ($propertiesId) {
                $serviceProperties = $this->serviceLocator->get('My\Models\Properties');
                $arrPropertiesList = $serviceProperties->getList(['parent_id' => $propertiesId, 'prop_status' => 1]);
            }
        }

        return array(
            'params' => $params,
            'errors' => $errors,
            'arrPropertiesList' => $arrPropertiesList
        );
    }

    public function completeAction() {
        $completeSession = new Container('contentComplete');

        if ($completeSession->complete != true) {
            return $this->redirect()->toRoute('home');
        }

        $completeSession->getManager()->getStorage()->clear('contentComplete');
    }

    public function getPropertiesAction() {
        $arrResult = [
            'st' => -1,
            'ms' => 'Xảy ra lỗi trong quá trình xử lý! Vui lòng thử lại sau giây lát'
        ];
        if ($this->request->isPost()) {
            $params = $this->params()->fromPost();
            if (empty($params['cateID'])) {
                return $this->getResponse()->setContent(json_encode($arrResult));
            }

            $validator = new Validate();
            if (!$validator->Digits($params['cateID'])) {
                return $this->getResponse()->setContent(json_encode($arrResult));
            }
            $categoryId = $params['cateID'];

            $arrCategoryList = unserialize(ARR_CATEGORY);
            if (empty($arrCategoryList[$categoryId])) {
                return $this->getResponse()->setContent(json_encode($arrResult));
            }

            $arrCategory = $arrCategoryList[$categoryId];

            if (empty($arrCategoryList[$arrCategory['parent_id']])) {
                return $this->getResponse()->setContent(json_encode($arrResult));
            }

            $propertiesId = $arrCategoryList[$arrCategory['parent_id']]['prop_id'];

            if (!$propertiesId) {
                $arrResult = [
                    'st' => 0,
                    'data' => []
                ];
                return $this->getResponse()->setContent(json_encode($arrResult));
            }

            $arrConditionProperties = [
                'parent_id' => $propertiesId,
                'prop_status' => 1
            ];

            $serviceProperties = $this->serviceLocator->get('My\Models\Properties');
            $arrPropertiesList = $serviceProperties->getList($arrConditionProperties);

            if (empty($propertiesId)) {
                $arrResult = [
                    'st' => 0,
                    'data' => []
                ];
                return $this->getResponse()->setContent(json_encode($arrResult));
            }

            $arrResult = [
                'st' => 1,
                'data' => $arrPropertiesList
            ];
            return $this->getResponse()->setContent(json_encode($arrResult));
        }
        return $this->getResponse()->setContent(json_encode($arrResult));
    }

    public function uploadAction() {
        $params = $this->params()->fromPost();
        $files = $this->params()->fromFiles();

        if (empty($files)) {
            return $this->getResponse()->setContent(json_encode(['st' => -1, 'ms' => 'Bạn vui lòng chọn hình!']));
        }
        $return = General::ImageUpload($files['file-0'], 'content');   //xem phần profile.js - phần upload dưới cùng

        if (empty($return)) {
            return $this->getResponse()->setContent(json_encode(array('st' => -1, 'ms' => '<br>Hình up lên phải là định dạng hình ảnh (.jpg, .png , ...) ! Và dung lượng không được quá 2MB !</br>')));
        }

        $template = 'frontend/content/upload';

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setTemplate($template);
        $viewModel->setVariables(
                ['arrImage' => $return]
        );
        $html = $this->serviceLocator->get('viewrenderer')->render($viewModel);
        return $this->getResponse()->setContent(json_encode(array('st' => 1, 'html' => $html)));
    }

    public function editAction() {
        if (UID <= 0) {
            return $this->redirect()->toRoute('frontend', array('controller' => 'index', 'action' => 'index'));
        }
        $params = $this->params()->fromRoute();
        if (empty($params['productId'])) {
            return $this->redirect()->toRoute('frontend', array('controller' => 'index', 'action' => 'index'));
        }
        $intProdID = (int) $params['productId'];
        $serviceProduct = $this->serviceLocator->get('My\Models\Product');
        $arrProductDetail = $serviceProduct->getDetail(array('prod_id' => $intProdID, 'not_prod_status' => -1, 'user_created' => UID));
        if (empty($arrProductDetail)) {
            return $this->redirect()->toRoute('frontend', array('controller' => 'index', 'action' => 'index'));
        }

        //get listCategory
        $serviceCategory = $this->serviceLocator->get('My\Models\Category');
        $arrCategoryList = $serviceCategory->getList(array('not_cate_parent' => 0, 'cate_status' => 1));
        $arrCategory = unserialize(ARR_CATEGORY);
        foreach ($arrCategory as $key => $value) {
            foreach ($arrCategoryList as $val) {
                if ($val['cate_parent'] == $value['cate_id']) {
                    $arrCategory[$key]['cate_children'][] = $val;
                }
            }
        }

        //get ListDist
        $serviceDistrict = $this->serviceLocator->get('My\Models\District');
        $errors = array();
        $arrDistrictList = $serviceDistrict->getList(array('city_id' => 9, 'dist_status' => 0));


        $this->renderer = $this->serviceLocator->get('Zend\View\Renderer\PhpRenderer');
        $this->renderer->headTitle(html_entity_decode('Rao vặt - Chỉnh sửa rao vặt') . General::TITLE_META);
        $this->renderer->headMeta()->appendName('keywords', html_entity_decode('chototquynhon.com, rao vặt, đăng tin rao vặt, rao vat, dang tin mua bán, dang tin rao vat quy nhon, tuyen dung - viec lam quy nhon, dang tin rao vat mien phi, dang rao vat chototquynhon.com'));
        $this->renderer->headMeta()->appendName('description', html_entity_decode('chototquynhon.com  - sRao vặt - Đăng tin rao vặt, đăng tin rao vặt , mua bán, tuyển dụng , tìm việc tại miễn phí quy nhơn - bình định , rao vặt quy nhơn bình định nhanh chóng , chototquynhon.com - đăng tin rao vặt nhanh chóng, miễn phí !' . General::TITLE_META));
//        p(json_decode($arrProductDetail['prod_image'],true)['thumbImage']['120x120']);die;
        return array(
            'params' => $params,
            'errors' => $errors,
            'arrProductDetail' => $arrProductDetail,
            'arrCategory' => $arrCategory,
            'arrDistrictList' => $arrDistrictList
        );
    }

}
