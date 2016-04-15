<?php

namespace Frontend\Controller;

use My\Controller\MyController,
    My\General,
    Zend\View\Model\ViewModel,
    My\Validator\Validate;

class UserController extends MyController {
    /* @var $serviceUser \My\Models\User */
    /* @var $serviceProduct \My\Models\Product */

    public function __construct() {
//        $this->externalJS = [
//            STATIC_URL . '/f/v1/js/my/??auth.js',
//        ];
    }

    /*
     * @auth : ChienNguyen => ngocchien01@gmail.com
     * Thông tin cá nhân
     */

    public function indexAction() {
        if (CUSTOMER_ID == 0) {
            return $this->redirect()->toRoute('user-login');
        }

        $params = $this->params()->fromRoute();

        $serviceUser = $this->serviceLocator->get('My\Models\User');
        $arrDetailUser = $serviceUser->getDetail(array('user_id' => CUSTOMER_ID));

        if ($this->request->isPost()) {
            $params = $this->params()->fromPost();
            if (empty($params['user_fullname'])) {
                $errors['user_fullname'] = 'Họ tên không được bỏ trống!';
            } else {
                $validator = new \Zend\Validator\StringLength(array('min' => 5));
                if (!$validator->isValid($params['user_fullname'])) {
                    $errors['user_fullname'] = 'Nhập họ và tên không hợp lệ!';
                }
            }
            if (empty($params['user_email'])) {
                $errors['user_email'] = 'Email không được bỏ trống!';
            } else {
                $validator = new \Zend\Validator\EmailAddress();
                if (!$validator->isValid($params['user_email'])) {
                    $errors['user_email'] = 'Địa chỉ email không hợp lệ!';
                }
            }

            if (empty($params['user_phone'])) {
                $errors['user_phone'] = 'Số di động không được bỏ trống!';
            } else {
                $validator = new \Zend\Validator\Digits();
                if (!$validator->isValid($params['user_phone'])) {
                    $errors['user_phone'] = 'Số di động không không hợp lệ!';
                } else {
                    $validator = new \Zend\Validator\StringLength(array('min' => 5, 'max' => 12));
                    if (!$validator->isValid($params['user_phone'])) {
                        $errors['user_phone'] = 'Số di động không không hợp lệ!';
                    }
                }
            }
            if (empty($errors)) {
                //Check Phone
                $arrPhone = $serviceUser->getDetail(['user_phone' => $params['user_phone'], 'not_status' => -1, 'not_user_id' => CUSTOMER_ID]);
                if (!empty($arrPhone)) {
                    $errors['user_phone'] = 'Số di động này đã tồn tại trong hệ thống của chúng tôi!';
                } else {
                    //check email
                    $arrEmail = $serviceUser->getDetail(['user_email' => $params['user_email'], 'not_status' => -1, 'not_user_id' => CUSTOMER_ID]);
                    if (!empty($arrEmail)) {
                        $errors['user_email'] = 'Địa chỉ email này đã tồn tại trong hệ thống của chúng tôi!';
                    }
                }
                if (empty($errors)) {
                    $arrData = [
                        'user_phone' => $params['user_phone'],
                        'user_email' => $params['user_email'],
                        'user_updated' => CUSTOMER_ID,
                        'updated_date' => time(),
                        'user_fullname' => $params['user_fullname']
                    ];

                    $intResult = $serviceUser->edit($arrData, CUSTOMER_ID);
                    if ($intResult) {
                        //get lại thông tin User 
                        $arrUser = $serviceUser->getDetail(['user_id' => CUSTOMER_ID]);
                        $this->getAuthService()->clearIdentity();
                        $this->getAuthService()->getStorage()->write($arrUser);
                        //redirect
                        return $this->redirect()->toRoute('user-profile');
                    }
                    $errors[] = 'Xảy ra lỗi trong quá trình xử lý! Vui lòng thử lại sau giây lát!';
                }
            }
        }

        $this->renderer = $this->serviceLocator->get('Zend\View\Renderer\PhpRenderer');
        $this->renderer->headTitle(html_entity_decode('Tài khoản - Thông tin tài khoản') . General::TITLE_META);
        $this->renderer->headMeta()->appendName('keywords', html_entity_decode('chototquynhon.com, tài khoản, Thông tin, Thông tin tài khoản, Thông tin tài khoản chototquynhon.com'));
        $this->renderer->headMeta()->appendName('description', html_entity_decode('Tài khoản - Thông tin tài khoản tại' . General::TITLE_META));

        return array(
            'errors' => $errors,
            'params' => $params,
            'arrDetailUser' => $arrDetailUser,
        );
    }

    public function listPostAction() {
        if (!CUSTOMER_ID) {
            return $this->redirect()->toRoute('home');
        }
        $params = $this->params()->fromQuery();
        $intLimit = 15;
        $intPage = $params['page'];
        $arrCondition = [
            'user_created' => CUSTOMER_ID,
            'cont_status' => -1
        ];

        //content sẽ get từ elasticsearch
        $instanceSearchContent = new \My\Search\Content();
        $arrContentList = $instanceSearchContent->getListLimit($arrCondition, $intPage, $intLimit, ['created_date' => ['sort' => 'desc']]);

        return array(
            'arrContentList' => $arrContentList,
            'params' => $params
        );
    }

    public function rechargeAction() {
        
    }

    public function dealHistoryAction() {
        
    }

    public function blockAction() {
        
    }

    public function changePasswordAction() {
        if (!CUSTOMER_ID) {
            return $this->redirect()->toRoute('home');
        }
        $params = $this->params()->fromRoute();

        $errors = array();
        if ($this->request->isPost()) {
            $params = $this->params()->fromPost();

            if (empty($params['old_password'])) {
                $errors['old_password'] = 'Vui lòng nhập mật khẩu hiện tại !';
            }

            if (empty($params['new_password'])) {
                $errors['new_password'] = 'Vui lòng nhập mật khẩu mới !';
            } else {
                if (strlen($params['new_password']) < 6) {
                    $errors['new_password'] = 'Mật khẩu mới phải từ 6 ký tự trở lên !';
                } else {
                    if ($params['new_password'] != $params['re_new_password']) {
                        $errors['new_password'] = 'Nhập lại mật khẩu mới chưa chính xác!';
                    }
                }
            }
            if (empty($errors)) {
                //check old pass
                $serviceUser = $this->serviceLocator->get('My\Models\User');
                $arrDetailUser = $serviceUser->getDetail(array('user_id' => CUSTOMER_ID));

                if (md5($params['old_password'] != $arrDetailUser['user_password'])) {
                    $errors['old_password'] = 'Nhập mật khẩu cũ chưa chính xác!';
                }

                if (empty($errors)) {
                    $arrData = array(
                        'user_password' => md5($params['new_password']),
                        'updated_date' => time(),
                        'user_updated' => CUSTOMER_ID
                    );

                    $inResult = $serviceUser->edit($arrData, CUSTOMER_ID);
                    if ($inResult) {
                        $this->flashMessenger()->setNamespace('change-pass-success')->addMessage('Cập nhật mật khẩu thành công !');
                        return $this->redirect()->toRoute('user-change-password');
                    }
                    $errors[] = 'Xảy ra lỗi trong quá trình xử lý ! Vui lòng thử lại !';
                }
            }
        }
        $this->renderer = $this->serviceLocator->get('Zend\View\Renderer\PhpRenderer');
        $this->renderer->headTitle(html_entity_decode('Thành viên - Đổi mật khẩu tài khoản ') . General::TITLE_META);
        $this->renderer->headMeta()->appendName('description', html_entity_decode('Chototquynhon.Com - Đổi mật khẩu tài khoản !'));
        return array(
            'params' => $params,
            'errors' => $errors
        );
    }

    public function changeAvatarAction() {
        if (UID <= 0) {
            return $this->redirect()->toRoute('frontend', array('controller' => 'index', 'action' => 'index'));
        }
        $params = $this->params()->fromPost();
        $files = $this->params()->fromFiles();
        $serviceUser = $this->serviceLocator->get('My\Models\User');
        $user_avatar = General::ImageUpload($files['file-0'], 'auth', $resize = 1);   //xem phần profile.js - phần upload dưới cùng
        $arrData = array(
            'user_avatar' => json_encode($user_avatar),
            'user_updated' => time(),
        );
        $intResult = $serviceUser->edit($arrData, UID);
        if ($intResult) {
            return $this->getResponse()->setContent(json_encode(array('st' => 1, 'images' => $user_avatar[0]['thumbImage']['120x120'])));
        }
    }

}
