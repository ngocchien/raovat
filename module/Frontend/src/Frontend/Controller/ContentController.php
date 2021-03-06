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
            'not_cont_status' => -1
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
        try {
            $serviceContent = $this->serviceLocator->get('My\Models\Content');
        } catch (\Exception $exc) {
            echo $exc->getMessage();
            die;
        }


        $serviceContent->edit($arrUpdate, $cont_id);

        //Lay thong tin người đăng
        $arrUser = [];
        if (!empty($arrContent['user_created'])) {
            $instanceSearchUser = new \My\Search\User();
            $arrUser = $instanceSearchUser->getDetail(['user_id' => $arrContent['user_created']]);
        } else {
            $arrUser = json_decode($arrContent['user_info'], true);
        }

        //lấy thuộc tính
        $arrProperties = [];
        if (!empty($arrContent['prop_id'])) {
            $instanceSearchProperties = new \My\Search\Properties();
            $arrProperties = $instanceSearchProperties->getDetail(['prop_id' => $arrContent['prop_id']]);
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
        $metaImage = STATIC_URL . '/f/v1/images/logoct.png';
        if (!empty($arrContent['cont_image']) && $arrContent['cont_image'] != 'null') {
            $metaImage = json_decode(current(json_decode($arrContent['cont_image'])), true);
            $metaImage = $metaImage['thumbImage']['490x294'];
        }

        $this->renderer->headMeta()->setProperty('og:image', $metaImage);

        $this->renderer->headMeta()->setProperty('itemprop:datePublished', date('Y-m-d H:i', $arrContent['created_date']) . ' + 07:00');
        $this->renderer->headMeta()->setProperty('itemprop:dateModified', date('Y-m-d H:i', $arrContent['updated_date']) . ' + 07:00');
        $this->renderer->headMeta()->setProperty('itemprop:dateCreated', date('Y-m-d H:i', $arrContent['created_date']) . ' + 07:00');

        $this->renderer->headMeta()->setProperty('og:type', 'article');
        $arrCategoryDetail = unserialize(ARR_CATEGORY)[$arrContent['cont_id']];
        $this->renderer->headMeta()->setProperty('article:section', $arrCategoryDetail['cate_name']);
        $this->renderer->headMeta()->setProperty('article:published_time', date('Y-m-d H:i', $arrContent['created_date']) . ' + 07:00');
        $this->renderer->headMeta()->setProperty('article:modified_time', date('Y-m-d H:i', $arrContent['updated_date']) . ' + 07:00');

//        $this->renderer->headMeta()->setProperty('fb:pages', '272925143041233');

        $this->renderer->headMeta()->setProperty('itemprop:name', html_entity_decode($arrContent['cont_title']));
        $this->renderer->headMeta()->setProperty('itemprop:description', html_entity_decode($arrContent['cont_title']));
        $this->renderer->headMeta()->setProperty('itemprop:image', $metaImage);

        $this->renderer->headMeta()->setProperty('twitter:card', 'summary');
        $this->renderer->headMeta()->setProperty('twitter:site', General::SITE_AUTH);
        $this->renderer->headMeta()->setProperty('twitter:title', html_entity_decode($arrContent['cont_title']));
        $this->renderer->headMeta()->setProperty('twitter:description', html_entity_decode($arrContent['cont_title']));
        $this->renderer->headMeta()->setProperty('twitter:creator', General::SITE_AUTH);
        $this->renderer->headMeta()->setProperty('twitter:image:src', $metaImage);

        $this->renderer->headMeta()->appendName('social', General::SOCIAL_FACEBOOK_URL);

        //<meta property="article:tag" content="Tên tag của bài viết, nếu có nhiều tag thì tạo nhiều thẻ" />
        
        //danh sách comment
        $instanceSearchComment = new \My\Search\Comment();
        $arrCommentList = $instanceSearchComment->getListLimit(['cont_id' => $cont_id], 1, 10);

        //lấy tin cũ hơn cùng chuyên mục
        $arrConditionLasted = [
            'cate_id' => $arrContent['cate_id'],
            'not_cont_status' => -1,
            'less_cont_id' => $arrContent['cont_id']
        ];

        $arrContentLastedList = $instanceSearchContent->getListLimit($arrConditionLasted, 1, 5, ['cont_id' => ['order' => 'desc']]);

        return array(
            'params' => $params,
            'arrContent' => $arrContent,
            'arrCommentList' => $arrCommentList,
            'arrUser' => $arrUser,
            'arrProperties' => $arrProperties,
            'arrContentLastedList' => $arrContentLastedList
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
                } else {
                    $arrCategory = $arrCategoryList[$intCategoryId];
                    $arrCategoryParent = $arrCategoryList[$arrCategoryList[$intCategoryId]['parent_id']];
                }
            }

            $intProperties = (int) $params['properties'];
            if ($intProperties) {
                $instanceSearchProperties = new \My\Search\Properties();
                $arrProperties = $instanceSearchProperties->getDetail(['prop_id' => $intProperties, 'prop_status' => 1]);
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

//            if (empty($params['content_tags'])) {
//                $errors['content_tags'] = 'Chưa chọn tags cho tin rao vặt !';
//            }

            if (empty(CUSTOMER_ID)) {

                if (empty($params['name'])) {
                    $errors['userInfo']['name'] = 'Vui lòng nhập họ và tên để liên lạc !';
                }

                if (empty($params['email'])) {
                    $errors['userInfo']['email'] = 'Vui lòng nhập email liên lạc';
                } else {
                    $validatorEmail = new \Zend\Validator\EmailAddress();
                    if (!$validatorEmail->isValid($params['email'])) {
                        $errors['userInfo']['email'] = 'Địa chỉ email không hợp lệ!';
                    }
                }

                if (empty($params['phone'])) {
                    $errors['userInfo']['phone'] = 'Vui lòng nhập số điện thoại liên lạc';
                } else {
                    $validationPhone = new \Zend\Validator\Digits();
                    if (!$validationPhone->isValid($params['phone'])) {
                        $errors['userInfo']['phone'] = 'Số điện thoại không hợp lệ';
                    } else {
                        $validBetween = new \Zend\Validator\StringLength(array('min' => 8, 'max' => 12));
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
                $instanceSearchContent = new \My\Search\Content();
                if (empty(CUSTOMER_ID)) {
                    $arrCondition = [
                        'ip_address' => $this->getRequest()->getServer('REMOTE_ADDR'),
                        'created_date_today' => 1
                    ];
                    $intTotal = $instanceSearchContent->getTotal($arrCondition);
                    if ($intTotal >= 3) {
                        $errors['total'] = 'Bạn chưa đăng ký thành viên nên chỉ được đăng tối đa 3 tin 1 ngày! Mời bạn đăng ký để sử dụng đầu đủ tính năng!';
                    }
                } else {
                    $arrCondition = [
                        'cont_slug' => General::getSlug(trim($params['content_title'])),
                        'user_created' => CUSTOMER_ID,
                        'cate_id' => $intCategoryId,
                        'not_cont_status' => -1,
                    ];

                    $arrContent = $instanceSearchContent->getDetail($arrCondition);

                    if ($arrContent) {
                        $errors['total'] = 'Bạn đã đăng tin này trong danh mục này! Vui lòng kiểm tra lại danh sách tin đã đăng!';
                    }
                }

                if (empty($errors)) {
                    $arrData = array(
                        'cont_title' => trim(strip_tags($params['content_title'])),
                        'cont_slug' => General::getSlug(trim($params['content_title'])),
                        'cont_detail' => $params['content_content'],
                        'cont_detail_text' => strip_tags(html_entity_decode(trim($params['content_content']))),
                        'cate_id' => $intCategoryId,
                        'user_created' => CUSTOMER_ID,
                        'cont_image' => json_encode($params['image_prod']),
                        'prop_id' => $intProperties,
                        'created_date' => time(),
                        'ip_address' => $this->getRequest()->getServer('REMOTE_ADDR'),
                        'dist_id' => (int) $params['location'],
                        'cont_status' => 1,
                        'cont_views' => 1,
                        'updated_date' => time()
                    );
                    if (empty(CUSTOMER_ID)) {
                        $arrData['user_info'] = json_encode([
                            'user_fullname' => $params['name'],
                            'user_email' => $params['email'],
                            'user_phone' => $params['phone'],
                            'password' => $params['password']
                        ]);
                    }

                    $serviceContent = $this->serviceLocator->get('My\Models\Content');
                    $intResult = $serviceContent->add($arrData);

                    if ($intResult > 0) {
                        //update tổng số rao vặt trong danhmục
                        $serviceCategory = $this->serviceLocator->get('My\Models\Category');
                        $serviceCategory->edit(array('total_content' => $arrCategory['total_content'] + 1), $arrCategory['cate_id']);
                        //update tổng số rao vặt danh mục cha
                        $serviceCategory->edit(array('total_content' => $arrCategoryParent['total_content'] + 1), $arrCategoryParent['cate_id']);

                        $arrSession = [
                            'type' => 'add',
                            'title' => $params['content_title'],
                            'id' => $intResult,
                            'title_slug' => General::getSlug(trim($params['content_title']))
                        ];

                        $_SESSION['complete'] = $arrSession;

                        return $this->redirect()->toRoute('add-content-complete');
                    }
                    $errors['total'] = 'Xảy ra lỗi trong quá trình xử lý !';
                }
            }
        }

        $this->renderer = $this->serviceLocator->get('Zend\View\Renderer\PhpRenderer');
        $this->renderer->headTitle(html_entity_decode('Rao vặt - Đăng tin rao vặt') . General::TITLE_META);
        $this->renderer->headMeta()->appendName('keywords', html_entity_decode('quynhon247.com, rao vặt, đăng tin rao vặt, rao vat, dang tin mua bán, dang tin rao vat quy nhon, tuyen dung - viec lam quy nhon, dang tin rao vat mien phi, dang rao vat quynhon247.com'));
        $this->renderer->headMeta()->appendName('description', html_entity_decode('quynhon247.com  - Rao vặt - Đăng tin rao vặt, đăng tin rao vặt , mua bán, tuyển dụng , tìm việc tại miễn phí quy nhơn - bình định , rao vặt quy nhơn bình định nhanh chóng , quynhon247.com - đăng tin rao vặt nhanh chóng, miễn phí !' . General::TITLE_META));

        $arrPropertiesList = [];
        if ($params['category']) {
            $arrCategoryList = unserialize(ARR_CATEGORY);
            $propertiesId = $arrCategoryList[$arrCategoryList[$params['category']]['parent_id']]['prop_id'];
            if ($propertiesId) {
                $instanceSearchProperties = new \My\Search\Properties();
                $arrPropertiesList = $instanceSearchProperties->getList(['parent_id' => $propertiesId, 'prop_status' => 1]);
            }
        }

        return array(
            'params' => $params,
            'errors' => $errors,
            'arrPropertiesList' => $arrPropertiesList
        );
    }

    public function confirmPasswordAction() {
        if ($this->request->isPost()) {
            $params = $this->params()->fromPost();

            if (empty($params['cont_id']) || empty($params['cont_pass'])) {
                return $this->getResponse()->setContent(json_encode(array('st' => -1, 'ms' => '<center><b style="color:red">Xảy ra lỗi trong quá trình xử lý! Vui lòng thử lại sau giây lát!</b></center>')));
            }

            $instaceSearchContent = new \My\Search\Content();
            $arrContent = $instaceSearchContent->getDetail(['cont_id' => (int) $params['cont_id'], 'not_cont_status' => -1]);

            if (empty($arrContent)) {
                return $this->getResponse()->setContent(json_encode(['st' => -1, 'ms' => '<center><b style="color:red">Không tìm thấy tin rao vặt này trong hệ thống của chúng tôi!</b></center>']));
            }

            if (json_decode($arrContent['user_info'], true)['password'] != trim($params['cont_pass'])) {
                return $this->getResponse()->setContent(json_encode(['st' => -1, 'ms' => '<center><b style="color:red">Nhập mật khẩu sửa tin không chính xác!</b></center>']));
            }

            $arrPass = empty($_SESSION['cont_pass']) ? [] : $_SESSION['cont_pass'];

            if (!in_array($arrContent['cont_id'], $arrPass)) {
                array_push($arrPass, $arrContent['cont_id']);
            }
            $_SESSION['arrContentPass'] = $arrPass;
            return $this->getResponse()->setContent(json_encode(['st' => 1, 'url' => $this->url()->fromRoute('edit-content', ['contentSlug' => $arrContent['cont_slug'], 'contentId' => $arrContent['cont_id']])]));
        }
    }

    public function editAction() {
        $params = $this->params()->fromRoute();

        if (empty($params['contentId']) || empty($params['contentSlug'])) {
            return $this->redirect()->toRoute('home');
        }

        $contentId = (int) $params['contentId'];
        $contentSlug = trim($params['contentSlug']);
        $instanceSearchContent = new \My\Search\Content();
        $arrContent = $instanceSearchContent->getDetail(['cont_id' => $contentId, 'not_cont_status' => -1]);

        if (empty($arrContent) || $arrContent['cont_slug'] != $contentSlug) {
            return $this->redirect()->toRoute('home');
        }

        if (empty($arrContent['user_created'])) {
            $arrContentPass = $_SESSION['arrContentPass'];
            if (!in_array($arrContent['cont_id'], $arrContentPass)) {
                return $this->redirect()->toRoute('home');
            }
        } else {
            if (CUSTOMER_ID != $arrContent['user_created']) {
                return $this->redirect()->toRoute('home');
            }
        }
        $instanceSearchProperties = new \My\Search\Properties();
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
                $arrProperties = $instanceSearchProperties->getDetail(['prop_id' => $intProperties, 'prop_status' => 1]);

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

//            if (empty($params['content_tags'])) {
//                $errors['content_tags'] = 'Chưa chọn tags cho tin rao vặt !';
//            }

            if (empty(CUSTOMER_ID)) {

                if (empty($params['name'])) {
                    $errors['userInfo']['name'] = 'Vui lòng nhập họ và tên để liên lạc !';
                }

                if (empty($params['email'])) {
                    $errors['userInfo']['email'] = 'Vui lòng nhập email liên lạc';
                } else {
                    $validatorEmail = new \Zend\Validator\EmailAddress();
                    if (!$validatorEmail->isValid($params['email'])) {
                        $errors['userInfo']['email'] = 'Địa chỉ email không hợp lệ!';
                    }
                }

                if (empty($params['phone'])) {
                    $errors['userInfo']['phone'] = 'Vui lòng nhập số điện thoại liên lạc';
                } else {
                    $validationPhone = new \Zend\Validator\Digits();
                    if (!$validationPhone->isValid($params['phone'])) {
                        $errors['userInfo']['phone'] = 'Số điện thoại không hợp lệ';
                    } else {
                        $validBetween = new \Zend\Validator\StringLength(array('min' => 8, 'max' => 12));
                        if (!$validBetween->isValid($params['phone'])) {
                            $errors['userInfo']['phone'] = 'Số điện thoại phải từ 8 đến 12 số';
                        }
                    }
                }
            }

            if (empty($errors)) {

                /*
                 * Kiểm tra spam và trùng lặp tin
                 */
                $instanceSearchContent = new \My\Search\Content();
                if (!empty(CUSTOMER_ID)) {
                    $arrCondition = [
                        'cont_slug' => General::getSlug(trim($params['content_title'])),
                        'user_created' => CUSTOMER_ID,
                        'cate_id' => $intCategoryId,
                        'not_cont_status' => -1,
                        'not_cont_id' => $arrContent['cont_id']
                    ];

                    $arrContentExit = $instanceSearchContent->getDetail($arrCondition);

                    if ($arrContentExit) {
                        $errors['total'] = 'Bạn đã đăng tin này trong danh mục này! Vui lòng kiểm tra lại danh sách tin đã đăng!';
                    }
                }
                if (empty($errors)) {
                    $arrData = array(
                        'cont_title' => trim(strip_tags($params['content_title'])),
                        'cont_slug' => General::getSlug(trim($params['content_title'])),
                        'cont_detail' => $params['content_content'],
                        'cont_detail_text' => strip_tags(html_entity_decode(trim($params['content_content']))),
                        'cate_id' => $intCategoryId,
                        'cont_image' => json_encode($params['image_prod']),
                        'prop_id' => $intProperties,
                        'updated_date' => time(),
                        'dist_id' => (int) $params['location'],
                        'user_updated' => empty(CUSTOMER_ID) ? null : CUSTOMER_ID
                    );
                    if (empty(CUSTOMER_ID)) {
                        $arrData['user_info'] = json_encode([
                            'user_fullname' => $params['name'],
                            'user_email' => $params['email'],
                            'user_phone' => $params['phone'],
                            'password' => json_decode($arrContent['user_info'], true)['password']
                        ]);
                    }

                    $serviceContent = $this->serviceLocator->get('My\Models\Content');
                    $intResult = $serviceContent->edit($arrData, $arrContent['cont_id']);

                    if ($intResult > 0) {
                        if (!empty($arrContentPass)) {
                            if (($key = array_search($arrContent['cont_id'], $arrContentPass)) !== false) {
                                unset($arrContentPass[$key]);
                                if (empty($arrContentPass)) {
                                    unset($_SESSION['arrContentPass']);
                                } else {
                                    $_SESSION['arrContentPass'] = $arrContentPass;
                                }
                            }
                        }

                        $arrSession = [
                            'type' => 'edit',
                            'title' => $params['content_title'],
                            'id' => $intResult,
                            'title_slug' => General::getSlug(trim($params['content_title']))
                        ];

                        $_SESSION['complete'] = $arrSession;

                        return $this->redirect()->toRoute('add-content-complete');
                    }
                    $errors['total'] = 'Xảy ra lỗi trong quá trình xử lý !';
                }
            }
        }

        $arrPropertiesList = [];
        $arrCategoryList = unserialize(ARR_CATEGORY);
        if (!empty($params['category'])) {
            $propertiesId = $arrCategoryList[$arrCategoryList[$params['category']]['parent_id']]['prop_id'];
            if ($propertiesId) {
                $arrPropertiesList = $instanceSearchProperties->getList(['parent_id' => $propertiesId, 'prop_status' => 1]);
            }
        } else {
            $propertiesId = $arrCategoryList[$arrCategoryList[$arrContent['cate_id']]['parent_id']]['prop_id'];
            if ($propertiesId) {
                $arrPropertiesList = $instanceSearchProperties->getList(['parent_id' => $propertiesId, 'prop_status' => 1]);
            }
        }

        $this->renderer = $this->serviceLocator->get('Zend\View\Renderer\PhpRenderer');
        $this->renderer->headTitle(html_entity_decode('Rao vặt - Chỉnh sửa rao vặt') . General::TITLE_META);
        $this->renderer->headMeta()->appendName('keywords', html_entity_decode('quynhon247.com, rao vặt, đăng tin rao vặt, rao vat, dang tin mua bán, dang tin rao vat quy nhon, tuyen dung - viec lam quy nhon, dang tin rao vat mien phi, dang rao vat quynhon247.com'));
        $this->renderer->headMeta()->appendName('description', html_entity_decode('quynhon247.com  - sRao vặt - Đăng tin rao vặt, đăng tin rao vặt , mua bán, tuyển dụng , tìm việc tại miễn phí quy nhơn - bình định , rao vặt quy nhơn bình định nhanh chóng , quynhon247.com - đăng tin rao vặt nhanh chóng, miễn phí !' . General::TITLE_META));

        return array(
            'params' => $params,
            'errors' => $errors,
            'arrContent' => $arrContent,
            'arrPropertiesList' => $arrPropertiesList
        );
    }

    public function deleteAction() {
        if (!CUSTOMER_ID) {
            return $this->getResponse()->setContent(json_encode(['st' => -1, 'ms' => 'Please sigin before deleted post!']));
        }

        $params = array_merge($this->params()->fromRoute(), $this->params()->fromQuery(), $this->params()->fromPost());

        $instanceSearchContent = new \My\Search\Content();
        if (!empty($params['type']) && $params['type'] == 'delete-all' && is_array($params['arrItem'])) {
            $arrContentList = $instanceSearchContent->getList(['user_created' => CUSTOMER_ID, 'in_cont_id' => $params['arrItem'], 'not_cont_status' => -1]);
            if (!empty($arrContentList)) {
                $arrIdList = [];
                foreach ($arrContentList as $arrContent) {
                    $arrIdList[] = $arrContent['cont_id'];
                }
                $serviceContent = $this->serviceLocator->get('My\Models\Content');
                $intResult = $serviceContent->multiEdit(['updated_date' => time(), 'user_updated' => CUSTOMER_ID, 'cont_status' => -1], ['in_cont_id' => implode(',', $arrIdList)]);
                if ($intResult) {
                    return $this->getResponse()->setContent(json_encode(['st' => 1, 'ms' => '<center><b>Xóa danh sách tin rao vặt thành công!</b></center>', 'data' => $arrIdList]));
                }
            }
        } else {
            if (empty($params['cont_id'])) {
                return $this->getResponse()->setContent(json_encode(['st' => -1, 'ms' => '<center><b>Xảy ra lỗi trong quá trình xử lý! Vui lòng thử lại sau  giây lát!</b></center>']));
            }
            $arrContent = $instanceSearchContent->getDetail(['cont_id' => (int) $params['cont_id'], 'user_created' => CUSTOMER_ID, 'not_cont_status' => -1]);

            if (empty($arrContent)) {
                return $this->getResponse()->setContent(json_encode(['st' => -1, 'ms' => '<center><b>Không tìm thấy rao vặt này trong hệ thống của chúng tôi!</b></center>']));
            }

            $serviceContent = $this->serviceLocator->get('My\Models\Content');

            if ($serviceContent->edit(['cont_status' => -1, 'updated_date' => time()], (int) $params['cont_id'])) {
                return $this->getResponse()->setContent(json_encode(['st' => 1, 'ms' => '<center><b>Xóa rao vặt thành công!</b></center>']));
            }
        }

        return $this->getResponse()->setContent(json_encode(['st' => -1, 'ms' => '<center><b>Xảy ra lỗi trong quá trình xử lý! Vui lòng thử lại trong giây lát!</b></center>']));
    }

    public function deleteContentAction() {
        if ($this->request->isPost()) {
            $params = $this->params()->fromPost();
            if (empty($params['cont_id']) || empty($params['cont_pass'])) {
                return $this->getResponse()->setContent(json_encode(['st' => -1, 'ms' => '<center><b>Xảy ra lỗi trong quá trình xử lý! Vui lòng thử lại sau giây lát!</b></center>']));
            }

            $instaceSearchContent = new \My\Search\Content();
            $content_detail = $instaceSearchContent->getDetail(['cont_id' => (int) $params['cont_id'], 'not_cont_status' => -1]);

            if (empty($content_detail)) {
                return $this->getResponse()->setContent(json_encode(['st' => -1, 'ms' => '<center><b>Không tìm thấy tin rao vặt này trong hệ thống của chúng tôi!</b></center>']));
            }

            if (!empty($content_detail['user_created'])) {
                return $this->getResponse()->setContent(json_encode(['st' => -1, 'ms' => '<center><b>Không tìm thấy tin rao vặt này trong hệ thống của chúng tôi!</b></center>']));
            }

            if (json_decode($content_detail['user_info'], true)['password'] != $params['cont_pass']) {
                return $this->getResponse()->setContent(json_encode(['st' => -1, 'ms' => '<center><b>Nhập mật khẩu tin này chưa chính xác!</b></center>']));
            }

            $serviceContent = $this->serviceLocator->get('My\Models\Content');
            if ($serviceContent->edit(['updated_date' => time(), 'cont_status' => -1], (int) $params['cont_id'])) {
                return $this->getResponse()->setContent(json_encode(['st' => 1, 'url' => $this->url()->fromRoute('home')]));
            }
            return $this->getResponse()->setContent(json_encode(['st' => -1, 'ms' => '<center><b>Xảy ra lỗi trong quá trình xử lý! Vui lòng thử lại sau giây lát!</b></center>']));
        }
    }

    public function completeAction() {
        $completeSession = $_SESSION['complete'];

        if (empty($completeSession)) {
            return $this->redirect()->toRoute('home');
        }
        unset($_SESSION['complete']);

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

            $instanceSearchProperties = new \My\Search\Properties();
            $arrPropertiesList = $instanceSearchProperties->getList($arrConditionProperties);

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

            if (empty($params['captcha']) || strlen($params['captcha']) != 6 || $params['captcha'] != $_SESSION['captcha']) {
                $errors['captcha'] = 'Nhập mã xác nhận chưa chính xác!';
            }

            if (!empty($errors)) {
                return $this->getResponse()->setContent(json_encode(array('st' => -1, 'errors' => $errors)));
            }

            $arrData = [
                'status' => 0,
                'created_date' => time(),
                'cont_id' => (int) $params['cont_id'],
                'full_name' => (int) CUSTOMER_ID > 0 ? CUSTOMER_FULLNAME : trim(strip_tags($params['full_name'])),
                'email' => (int) CUSTOMER_ID > 0 ? CUSTOMER_EMAIL : trim(strip_tags($params['email'])),
                'user_id' => (int) CUSTOMER_ID > 0 ? CUSTOMER_ID : null,
                'user_avatar' => (int) CUSTOMER_ID > 0 ? CUSTOMER_AVATAR : null,
                'comm_content' => trim($params['comment_content'])
            ];

            $serviceComment = $this->serviceLocator->get('My\Models\Comment');
            $intResult = $serviceComment->add($arrData);
            if ($intResult > 0) {
                $serviceContent = $this->serviceLocator->get('My\Models\Content');
                $serviceContent->edit(['total_comment' => (int) $content_detail['total_comment'] + 1], (int) $params['cont_id']);

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
                if ($arrFavourite['status'] == -1) {
                    $arrData['status'] = 1;
                    $arrData['updated_date'] = time();
                    $serviceFavourite->edit($arrData, $arrFavourite['favo_id']);
                }
                return $this->getResponse()->setContent(json_encode(array('st' => 1, 'ms' => '<p style="color:green">Lưu tin rao vặt thành công!</b></p>')));
            }
        }
    }

    public function sendMessagesAction() {
        if ($this->request->isPost()) {
            if (!CUSTOMER_ID) {
                return $this->getResponse()->setContent(json_encode(array('st' => -1, 'ms' => '<p style="color:red">Vui lòng đăng nhập trước khi gửi tin nhắn đến người này!</b></p>')));
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

            if ($arrContent['user_created' == CUSTOMER_ID]) {
                return $this->getResponse()->setContent(json_encode(array('st' => -1, 'ms' => '<p style="color:red">Bạn chính là người tạo rao vặt này. Nên không thể gửi tin nhắn cho chính bạn!</b></p>')));
            }

            $arrData = [
                'cont_id' => (int) $params['cont_id'],
                'mess_content' => trim($params['messages_content']),
                'user_created' => CUSTOMER_ID,
                'created_date' => time(),
                'is_view' => 0
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
                    $instanceSearchUser = new \My\Search\User();
                    $arrUserInfo = $instanceSearchUser->getDetail(['user_id' => $arrContent['user_created']]);
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

    public function dealVipAction() {
        if (!CUSTOMER_ID) {
            return $this->getResponse()->setContent(json_encode(array('st' => -1, 'ms' => '<p style="color:red"><b>Chưa đăng nhập, không thể mua víp!</b></p>')));
        }
        if ($this->request->isPost()) {
            $params = $this->params()->fromPost();
            if (empty($params['num_date']) || empty($params['type_vip']) || (int) $params['num_date'] < 1 || (int) $params['cont_id'] < 0) {
                return $this->getResponse()->setContent(json_encode(array('st' => -1, 'ms' => '<p style="color:red"><b>Tham số truyền lên không chính xác! Vui lòng kiểm tra lại</b></p>')));
            }

            $arr_type = [General::VIP_ALL_PAGE, General::VIP_CATE_PAGE];
            if (!in_array((int) $params['type_vip'], $arr_type)) {
                return $this->getResponse()->setContent(json_encode(array('st' => -1, 'ms' => '<p style="color:red"><b>Tham số truyền lên không chính xác! Vui lòng kiểm tra lại</b></p>')));
            }

            $instanceContent = new \My\Search\Content();
            $arrContent = $instanceContent->getDetail(['cont_id' => (int) $params['cont_id'], 'not_status' => -1]);
            if (empty($arrContent)) {
                return $this->getResponse()->setContent(json_encode(array('st' => -1, 'ms' => '<p style="color:red"><b>Tin này không tồn tại trong hệ thống hoặc đã bị xóa! Bạn vui lòng kiểm tra lại!</b></p>')));
            }
            $image_svip = STATIC_URL . '/f/v1/images/s-vip.gif';
            $image_vip = STATIC_URL . '/f/v1/images/vip2.gif';

            if ($arrContent['vip_type'] == General::VIP_ALL_PAGE && $params['type_vip'] != General::VIP_ALL_PAGE) {
                return $this->getResponse()->setContent(json_encode(array('st' => -1, 'ms' => '<p style="color:red"><b>Rao vặt này đang ở chế độ <img src="' . $image_svip . '"> bạn không thể chuyển thành <img src="' . $image_vip . '">!</b></p>')));
            }

            $total_fee = 0;

            switch ($params['type_vip']) {
                case General::VIP_ALL_PAGE:
                    $total_fee = (int) $params['num_date'] * General::FEE_SVIP;

                    break;
                case General::VIP_CATE_PAGE:
                    $total_fee = (int) $params['num_date'] * General::FEE_VIP;

                    break;
                default:
                    break;
            }

            if ($total_fee > CUSTOMER_BALANCE) {
                return $this->getResponse()->setContent(json_encode(array('st' => -1, 'ms' => '<p style="color:red"><b>Số dư tài khoản không đủ! Vui lòng nạp thêm tiền!</b></p>')));
            }

            //user_blance
            $balance = CUSTOMER_BALANCE - $total_fee;

            $serviceUser = $this->serviceLocator->get('My\Models\User');
            $intResult = $serviceUser->edit(['user_balance' => $balance, 'modified_date' => time()], CUSTOMER_ID);
            if ($intResult) {
                if ($arrContent['vip_type'] == General::VIP_ALL_PAGE) {
                    $time_expiried = empty($arrContent['expired_time']) ? time() + ($params['num_date'] * 60 * 60 * 24) : $arrContent['expired_time'] + ($params['num_date'] * 60 * 60 * 24);
                }

                if ($arrContent['vip_type'] == General::VIP_CATE_PAGE) {
                    if ($params['type_vip'] == General::VIP_ALL_PAGE) {
                        $time_expiried = time() + ($params['num_date'] * 60 * 60 * 24);
                    } else {
                        $time_expiried = empty($arrContent['expired_time']) ? time() + ($params['num_date'] * 60 * 60 * 24) : $arrContent['expired_time'] + ($params['num_date'] * 60 * 60 * 24);
                    }
                }

                $arrData = [
                    'is_vip' => 1,
                    'expired_time' => $time_expiried,
                    'vip_type' => (int) $params['type_vip'],
                    'updated_date' => time()
                ];
                $serviceContent = $this->serviceLocator->get('My\Models\Content');
                $intResult = $serviceContent->edit($arrData, $arrContent['cont_id']);
                if ($intResult) {
                    //lưu lại lịch sử giao dich
                    $arrData = [
                        'user_id' => CUSTOMER_ID,
                        'created_date' => time(),
                        'tran_type' => General::TRANS_OUTPUT,
                        'user_balance' => $balance,
                        'tran_deal' => $total_fee,
                        'cont_id' => $arrContent['cont_id'],
                        'vip_type' => (int) $params['type_vip'],
                        'num_date' => (int) $params['num_date']
                    ];
                    $serviceTrans = $this->serviceLocator->get('My\Models\TransactionHistory');
                    $serviceTrans->add($arrData);

                    //set lại session
                    $arrUser = [
                        'user_id' => CUSTOMER_ID,
                        'user_fullname' => CUSTOMER_FULLNAME,
                        'user_email' => CUSTOMER_EMAIL,
                        'user_phone' => CUSTOMER_PHONE,
                        'user_balance' => $balance
                    ];

                    $this->getAuthService()->clearIdentity();
                    $this->getAuthService()->getStorage()->write($arrUser);

                    $image = $params['type_vip'] == General::VIP_ALL_PAGE ? $image_svip : $image_vip;

                    $arrReturn = [
                        'st' => 1,
                        'ms' => '<p class="success">Bạn đã thanh toán thành công <b class="color-red">' . $total_fee . ' đ </b><br/>Để mua ' . $params['num_date'] . ' ngày <img src="' . $image . '"> Cho mã tin <b class="color-red">RV' . sprintf("%04d", $arrContent['cont_id']) . '</p>'
                    ];
                    return $this->getResponse()->setContent(json_encode($arrReturn));
                }
            }
        }
        return $this->getResponse()->setContent(json_encode(array('st' => -1, 'ms' => '<p style="color:red"><b>Xảy ra lỗi trong quá trình xử lý! Vui lòng thử lại sau giây lát</b></p>')));
    }

}
