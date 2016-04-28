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
        $cont_id = (int) $params['contentId'];
        $cont_slug = $params['contentSlug'];

        if (empty($cont_id) || empty($cont_slug)) {
            return $this->redirect()->toRoute('404', array());
        }
        $arrConditionContent = [
            'cont_id' => $cont_id,
            'cont_status' => 1
        ];
        $instanceSearchContent = new \My\Search\Content();
        $arrContent = $instanceSearchContent->getDetail($arrConditionContent);

        if (empty($arrContent)) {
            return $this->redirect()->toRoute('404');
        }

        if ($cont_slug != $arrContent['cont_slug']) {
            return $this->redirect()->toRoute('view-content', array('controller' => 'content', 'action' => 'detail', 'contentSlug' => $arrContent['cont_slug'], 'contentId' => $cont_id));
        }

        //update số lần view
        $arrUpdate = [
            'cont_views' => $arrContent['cont_views'] + 1,
            'modified_date' => time()
        ];

        $serviceContent = $this->serviceLocator->get('My\Models\Content');
        $serviceContent->edit($arrUpdate, $cont_id);

        //Lay thong tin người đăng
        $arrUser = [];
        if (!empty($arrContent['user_created'])) {
            $serviceUser = $this->serviceLocator->get('My\Models\User');
            $arrUser = $serviceUser->getDetail(array('user_id' => $arrContent['user_created']));
        } else {
            $arrUser = json_decode($arrContent['user_info'], true);
        }


        $arrContent['meta_title'] ? $metaTitle = $arrContent['meta_title'] : $metaTitle = $arrContent['cont_title'];
        $metaKeyword = $arrContent['meta_keyword'] ? $arrContent['meta_keyword'] : $arrContent['cont_title'];
        $metaDescription = $arrContent['meta_description'] ? $arrContent['meta_description'] : $arrContent['cont_title'];
        $arrContent['meta_social'] ? $metaSocial = $arrContent['meta_social'] : NULL;

        $this->renderer = $this->serviceLocator->get('Zend\View\Renderer\PhpRenderer');

        $arrCategoryDetail = unserialize(ARR_CATEGORY)[$arrContent['cate_id']];

        $this->renderer->headMeta()->appendName('dc.description', html_entity_decode($arrCategoryDetail['cate_meta_description']) . General::TITLE_META);
        $this->renderer->headMeta()->appendName('dc.subject', html_entity_decode($arrCategoryDetail['cate_name']) . General::TITLE_META);
        $this->renderer->headTitle(html_entity_decode($metaTitle) . General::TITLE_META);
        $this->renderer->headMeta()->appendName('keywords', html_entity_decode($metaKeyword));
        $this->renderer->headMeta()->appendName('description', html_entity_decode($metaDescription));
        $this->renderer->headMeta()->appendName('social', $metaSocial);
        $this->renderer->headMeta()->setProperty('og:url', $this->url()->fromRoute('view-content', array('controller' => 'content', 'action' => 'detail', 'contentSlug' => $arrContent['cont_slug'], 'contentId' => $cont_id)));
        $this->renderer->headMeta()->setProperty('og:title', html_entity_decode($arrContent['cont_title']));
        $this->renderer->headMeta()->setProperty('og:description', html_entity_decode($arrContent['cont_title']));

        $metaImage = '';
        if (!empty($arrContent['cont_image'])) {
            $metaImage = json_decode(current(json_decode($arrContent['cont_image'])), true);
            $metaImage = $metaImage['thumbImage']['490x294'];
        }
        $this->renderer->headMeta()->setProperty('og:image', $metaImage);
        $instanceSearchComment = new \My\Search\Comment();
        $arrCommentList = $instanceSearchComment->getListLimit(['cont_id' => $cont_id], 1, 10);

        return array(
            'params' => $params,
            'arrContent' => $arrContent,
            'arrCommentList' => $arrCommentList,
            'arrUser' => $arrUser
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
                        $errors['total'] = 'Bạn đã đăng tin này trong danh mục này! Vui lòng kiểm tra lại danh sách tin đã đăng!';
                    }
                }

                if (empty($errors)) {
                    $arrData = array(
                        'cont_title' => htmlentities($params['content_title']),
                        'cont_slug' => General::getSlug(trim($params['content_title'])),
                        'cont_detail' => \My\Minifier\HtmlMin::minify($params['content_content']),
                        'cate_id' => $intCategoryId,
                        'user_created' => CUSTOMER_ID,
                        'cont_image' => json_encode($params['image_prod']),
                        'prop_id' => $intProperties,
                        'created_date' => time(),
                        'ip_address' => $this->getRequest()->getServer('REMOTE_ADDR')
                    );
                    if (empty(CUSTOMER_ID)) {
                        $arrData['user_info'] = json_encode([
                            'user_fullname' => $params['name'],
                            'user_email' => $params['email'],
                            'user_phone' => $params['phone'],
                            'password' => $params['password']
                        ]);
                    }
                    $intResult = $serviceContent->add($arrData);

                    if ($intResult > 0) {
                        //update tổng số rao vặt trong danhmục
//                        $serviceCategory->edit(array('cate_total_product' => $arrCategoryDetail['cate_total_product'] + 1), $arrCategoryDetail['cate_id']);
                        //update tổng số rao vặt danh mục cha
//                        $serviceCategory->edit(array('cate_total_product' => $arrCategory[$arrCategoryDetail['cate_parent']]['cate_total_product'] + 1), $arrCategoryDetail['cate_parent']);

                        $completeSession = new Container('contentComplete');
                        $completeSession->complete = true;
                        $completeSession->id = $intResult;
                        $completeSession->title = $params['content_title'];
                        $completeSession->title_slug = General::getSlug(trim($params['content_title']));

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

//        $completeSession->getManager()->getStorage()->clear('contentComplete');
        return [
            'completeSession' => $completeSession
        ];
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

    public function addCommentAction() {
        if ($this->request->isPost()) {
            $params = $this->params()->fromPost();
            $errors = [];

            if ((int) CUSTOMER_ID < 1) {
                if (empty($params['full_name'])) {
                    $errors['full_name'] = 'Họ và tên không được bỏ trống!';
                } else {
                    if (strlen($params['full_name']) < 5) {
                        $errors['full_name'] = 'Nhập Họ và tên không hợp lệ!';
                    }
                }

                $validator = new Validate();
                if (!$validator->emailAddress($params['email'])) {
                    $errors['email'] = 'Địa chỉ email không hợp lệ!';
                }
            }

            if (empty($params['comment_content'])) {
                $errors['comment_content'] = 'Nội dung phản hồi không được bỏ trống!';
            } else {
                if (strlen($params['comment_content']) < 10) {
                    $errors['comment_content'] = 'Nội dung phản hồi phải từ 10 ký tự trở lên!';
                }
            }

            if (empty($params['cont_id'])) {
                $errors['cont_id'] = 'Không tìm thấy tin rao vặt!';
            } else {
                $instanceSearchContent = new \My\Search\Content();
                $content_detail = $instanceSearchContent->getDetail(['cont_id' => (int) $params['cont_id'], 'status' => 1]);
                if (empty($content_detail)) {
                    $errors['cont_id'] = 'Không tìm thấy tin rao vặt này trong hệ thống!';
                }
            }

            if (empty($params['captcha']) || strlen($params['captcha'] != 6 || $params['captcha'] != $_SESSION['captcha'])) {
                $errors['captcha'] = 'Nhập mã xác nhận chưa chính xác!';
            }

            if (!empty($errors)) {
                return $this->getResponse()->setContent(json_encode(array('st' => -1, 'errors' => $errors)));
            }

            $arrData = [
                'status' => 0,
                'created_date' => time(),
                'cont_id' => (int) $params['cont_id'],
                'full_name' => (int) CUSTOMER_ID > 0 ? CUSTOMER_FULLNAME : trim($params['full_name']),
                'email' => (int) CUSTOMER_ID > 0 ? CUSTOMER_EMAIL : trim($params['email']),
                'user_id' => (int) CUSTOMER_ID > 0 ? CUSTOMER_ID : null,
                'user_avatar' => (int) CUSTOMER_ID > 0 ? CUSTOMER_AVATAR : null,
                'comm_content' => $params['comment_content']
            ];

            $serviceComment = $this->serviceLocator->get('My\Models\Comment');
            $intResult = $serviceComment->add($arrData);
            if ($intResult > 0) {
                unset($_SESSION['captcha']);
                $viewModel = new ViewModel();
                $viewModel->setTerminal(true);
                $viewModel->setTemplate('frontend/content/add-comment');
                $viewModel->setVariables(
                        ['arrData' => $arrData]
                );
                $html = $this->serviceLocator->get('viewrenderer')->render($viewModel);

                return $this->getResponse()->setContent(json_encode(array('st' => 1, 'ms' => 'Gửi phản hồi thành công!', 'html' => $html)));
            } else {
                $errors['errors'] = 'Xảy ra lỗi trong quá trình xử lý! Vui lòng thử lại sau giây lát!';
                return $this->getResponse()->setContent(json_encode(array('st' => -1, 'errors' => $errors)));
            }
        }
    }

    public function saveContentAction() {
        if ($this->request->isPost()) {
            if (!CUSTOMER_ID) {
                return $this->getResponse()->setContent(json_encode(array('st' => -1, 'ms' => '<p style="color:red">Vui lòng đăng nhập trước khi lưu tin!</b></p>')));
            }

            $params = $this->params()->fromPost();
            if (empty($params['cont_id'])) {
                return $this->getResponse()->setContent(json_encode(array('st' => -1, 'ms' => '<p style="color:red">Xảy ra lỗi trong quá trình xử lý!</b></p>')));
            }

            $instanceSearchContent = new \My\Search\Content();
            $arrContent = $instanceSearchContent->getDetail(['cont_id' => (int) $params['cont_id'], 'status' => 1]);

            if (empty($arrContent)) {
                return $this->getResponse()->setContent(json_encode(array('st' => -1, 'ms' => '<p style="color:red">Không tìm thấy tin rao vặt này trong hệ thống của chúng tôi!</b></p>')));
            }

            $instanceSearchFavourite = new \My\Search\Favourite();
            $arrFavourite = $instanceSearchFavourite->getDetail(['user_id' => CUSTOMER_ID, 'cont_id' => $arrContent['cont_id']]);
            $serviceFavourite = $this->serviceLocator->get('My\Models\Favourite');
            if (empty($arrFavourite)) {
                $arrData = [
                    'user_id' => CUSTOMER_ID,
                    'cont_id' => $arrContent['cont_id'],
                    'status' => 1,
                    'created_date' => time(),
                    'updated_date' => time()
                ];
                if ($serviceFavourite->add($arrData)) {
                    return $this->getResponse()->setContent(json_encode(array('st' => 1, 'ms' => '<p style="color:green">Lưu tin rao vặt thành công!</b></p>')));
                } else {
                    return $this->getResponse()->setContent(json_encode(array('st' => -1, 'ms' => '<p style="color:red">Xảy ra lỗi trong quá trình xử lý!</b></p>')));
                }
            } else {
                if ($arrData['status'] == -1) {
                    $arrData['status'] = 1;
                    $arrData['updated_date'] = time();
                    $serviceFavourite->edit($arrData, $arrData['favo_id']);
                }
                return $this->getResponse()->setContent(json_encode(array('st' => 1, 'ms' => '<p style="color:green">Lưu tin rao vặt thành công!</b></p>')));
            }
        }
    }

    public function sendMessagesAction() {
        if ($this->request->isPost()) {
            if (!CUSTOMER_ID) {
                return $this->getResponse()->setContent(json_encode(array('st' => -1, 'ms' => '<p style="color:red">Vui lòng đăng nhập trước khi lưu tin!</b></p>')));
            }
            $params = $this->params()->fromPost();

            if (empty($params['cont_id']) || empty($params['messages_content'])) {
                return $this->getResponse()->setContent(json_encode(array('st' => -1, 'ms' => '<p style="color:red">Vui lòng nhập đầy đủ thông tin!</b></p>')));
            }

            $instanceSearchContent = new \My\Search\Content();
            $arrContent = $instanceSearchContent->getDetail(['cont_id' => (int) $params['cont_id'], 'cont_status' => 1]);

            if (empty($arrContent)) {
                return $this->getResponse()->setContent(json_encode(array('st' => -1, 'ms' => '<p style="color:red">Tin rao vặt này không tồn tại trong hệ thống của chúng tôi!</b></p>')));
            }

            $arrData = [
                'cont_id' => (int) $params['cont_id'],
                'mess_content' => trim($params['messages_content']),
                'user_created' => CUSTOMER_ID,
                'created_date' => time(),
            ];

            if (!empty($arrContent['user_created'])) {
                $arrData['to_user_id'] = $arrContent['user_created'];
            } else {
                $arrData['user_info'] = $arrContent['user_info'];
            }

            $serviceMessages = $this->serviceLocator->get('My\Models\Messages');
            $intResult = $serviceMessages->add($arrData);
            if ($intResult) {
                $arrData['mess_id'] = $intResult;
                $arrUserInfo = [];
                if (!empty($arrContent['user_created'])) {
                    $serviceUser = $this->serviceLocator->get('My\Models\User');
                    $arrUserInfo = $serviceUser->getDetail(['user_id' => $arrContent['user_created']]);
                }
                //send mail
                $template = 'frontend/email-messages';
                $viewModel = new ViewModel();
                $viewModel->setTerminal(true);
                $viewModel->setTemplate($template);
                $viewModel->setVariables(
                        [
                            'arrContent' => $arrContent,
                            'arrMessages' => $arrData,
                            'arrUser' => $arrUserInfo
                        ]
                );
                $html = $this->serviceLocator->get('viewrenderer')->render($viewModel);

                $arrEmail = [
                    'user_email' => empty($arrContent['user_created']) ? $arrContent['user_info']['user_email'] : $arrUserInfo['user_email'],
                    'html' => $html,
                    'title' => 'Tin nhắn mới từ rao vặt "' . html_entity_decode($arrContent['cont_title']) . '"',
                ];

                $instanceJob = new \My\Job\JobMail();
                $instanceJob->addJob(SEARCH_PREFIX . 'sendMail', $arrEmail);

                return $this->getResponse()->setContent(json_encode(array('st' => 1, 'ms' => '<p style="color:red">Gửi tin nhắn cho người đăng tin thành công!</b></p>')));
            }
        }

        return $this->getResponse()->setContent(json_encode(array('st' => -1, 'ms' => '<p style="color:red">Xảy ra lỗi trong quá trình xử lý!Vui lòng thử lại sau giây lát</b></p>')));
    }

}
