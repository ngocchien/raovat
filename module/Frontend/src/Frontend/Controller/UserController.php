<?php

namespace Frontend\Controller;

use My\Controller\MyController,
    My\General,
    Zend\View\Model\ViewModel,
    Zend\Session\Container,
    My\Validator\Validate;

class UserController extends MyController {
    /* @var $serviceUser \My\Models\User */
    /* @var $serviceProduct \My\Models\Product */

    public function __construct() {
        $this->externalJS = [
            STATIC_URL . '/f/v1/js/my/??user.js',
        ];
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
                        $this->flashMessenger()->setNamespace('edit-info-success')->addMessage('Cập nhật thông tin cá nhân thành công !');
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
        if ($this->request->isPost()) {
            $params = $this->params()->fromPost();

            if (empty($params['type'])) {
                $errors['type'] = 'Bạn chưa chọn loại thẻ nạp !';
            } else {
                $type = (int) $params['type'];
                $arrCharge = General::getMethodRechargeId();
                if (!in_array($type, $arrCharge)) {
                    $errors['type'] = 'Loại thẻ nạp không hợp lệ !';
                }
            }


            if (empty($params['seri'])) {
                $errors['seri'] = 'Bạn chưa nhập số seri của thẻ nạp !';
            }

            if (empty($params['code'])) {
                $errors['code'] = 'Bạn chưa nhập mã thẻ nạp !';
            }

            if (empty($params['code_security'])) {
                $errors['code_security'] = 'Bạn chưa nhập mã bảo mật !';
            } else {
                if ($params['code_security'] != $_SESSION['captcha']) {
                    $errors['code_security'] = 'Nhập mã xác nhận chưa chính xác!';
                }
            }

            if (empty($errors)) {
                $gamebankConfig = General::infoRechargeGameBank();
                $gb_api = new \My\Recharge\GameBank\GameBank();
                $gb_api->setMerchantId($gamebankConfig['merchant_id']);
                $gb_api->setApiUser($gamebankConfig['api_user']);
                $gb_api->setApiPassword($gamebankConfig['api_password']);
                $gb_api->setPin(trim($params['code']));
                $gb_api->setSeri(trim($params['seri']));
                $gb_api->setCardType($type);
                $gb_api->setNote("user_id" . CUSTOMER_ID); // ghi chu giao dich ben ban tu sinh
                $gb_api->cardCharging();
                $code = intval($gb_api->getCode());
                $info_card = intval($gb_api->getInfoCard());
                if ($code === 0 && $info_card >= 10000) {
                    echo json_encode(array('code' => 0, 'msg' => "Nạp thẻ thành công mệnh giá " . $info_card));
                } else {
                    // get thong bao loi
                    echo '<pre>';
                    print_r($gb_api->getMsg());
                    echo '</pre>';
                    die();
                    echo json_encode(array('code' => 1, 'msg' => $gb_api->getMsg()));
                }
            }
        }
        $this->renderer = $this->serviceLocator->get('Zend\View\Renderer\PhpRenderer');
        $this->renderer->headTitle(html_entity_decode('Tài khoản - Nạp tiền tài khoản') . General::TITLE_META);
        $this->renderer->headMeta()->appendName('keywords', html_entity_decode('chototquynhon.com, tài khoản, Thông tin, Thông tin tài khoản, Thông tin tài khoản chototquynhon.com'));
        $this->renderer->headMeta()->appendName('description', html_entity_decode('Tài khoản - Thông tin tài khoản tại' . General::TITLE_META));
        
        return [
            'params' => $params,
            'errors' => $errors
        ];
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

                if (md5($params['old_password']) != $arrDetailUser['user_password']) {
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

    public function socialAction() {
        if (CUSTOMER_ID) {
            return $this->redirect()->toRoute('user-profile');
        }
        $paramsRoute = $this->params()->fromRoute();
        $type = $paramsRoute['type'];

        if (empty($type)) {
            return $this->redirect()->toRoute('home');
        }
        $paramsQuery = $this->params()->fromQuery();

        $serviceUser = $this->serviceLocator->get('My\Models\User');

        if ($this->request->isGet()) {
            $code = $paramsQuery['code'];
            if (empty($code)) {
                return $this->redirect()->toRoute('home');
            }
            $completeSession = new Container('authTemp');
            if ($type == 'google') {
                if ($completeSession->ref == 'facebook.com') {
                    return [
                        'completeSession' => $completeSession
                    ];
                }
                try {
                    /*
                     * Service Google
                     */
                    $googleClient = new \Google_Client();
                    $gpInfo = General::$ggConfig;
                    $googleClient->setClientId($gpInfo['client_id']);
                    $googleClient->setClientSecret($gpInfo['client_secret']);
                    $googleClient->addScope('email');
                    $googleClient->addScope('profile');
                    $googleClient->setRedirectUri($gpInfo['redirect_uri']);
                    $googleClient->authenticate($code);

                    $accessToken = json_decode($googleClient->getAccessToken(), true);
                    $urlGoogleGet = 'https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . $accessToken['access_token'];
                    $fileContent = json_decode(file_get_contents($urlGoogleGet), true);
                    $email = $fileContent['email'];

                    if ($fileContent['id'] && $fileContent['email'] && $fileContent['name']) {
                        /*
                         * Kiểm tra người dùng đã tồn tại trong hệ thống hay chưa, nếu đã tồn tại thì cho login thành công
                         */
                        $userInfo = $serviceUser->getDetail(['user_email' => $fileContent['email'], 'not_user_status' => -1]);
                        if ($userInfo) {
                            if ($userInfo['user_status'] == 0) {
                                return $this->redirect()->toRoute('member-block');
                            }

                            $arrUpdate = [
                                'user_last_login' => time(),
                                'user_login_ip' => $this->getRequest()->getServer('REMOTE_ADDR'),
                            ];
                            if (empty($userInfo['social_profile_url'])) {
                                $arrUpdate = $userInfoFacebook['link'];
                            }
                            $login = $serviceUser->edit($arrUpdate, $userInfo["user_id"]);
                            if ($login) {
                                /*
                                 * set session
                                 */
                                $this->getAuthService()->clearIdentity();
                                $this->getAuthService()->getStorage()->write($arrUser);
                                return $this->redirect()->toRoute('user-profile');
                            }
                            /*
                             * redirect to My/index
                             */
//                            if (!empty($urlRedirect)) {
//                                $this->session->remove('historyUrl');
//                                return $this->response->redirect($urlRedirect);
//                            }
//                            return $this->response->redirect("my/index");
                        }

                        /*
                         * Nếu chưa có thông tin trong hệ thống thì set session để Nhập tên cá nhân(Doanh Nghiệp) và mật khẩu
                         */

                        /*
                         * Nếu chưa có thông tin trong hệ thống thì set session để Nhập tên cá nhân(Doanh Nghiệp) và mật khẩu
                         */
                        $completeSession = new Container('authTemp');

                        $completeSession->name = $fileContent['name'];
                        $completeSession->linkProfile = $fileContent['link'];
                        $completeSession->avatar = $fileContent['picture'];
                        $completeSession->ref = 'google.com';
                        $completeSession->email = $fileContent['email'];
                    }
                } catch (\Exception $exc) {
                    /*
                     * return to page register
                     */
                    return $this->response->redirect("account/register");
                }
            }

            if ($type == 'facebook') {
                if ($completeSession->ref == 'facebook.com') {
                    return [
                        'completeSession' => $completeSession
                    ];
                }
                $state = $paramsQuery['state'];

                /*
                 * load config
                 */
                $fbInfo = General::$fbConfig;
                $facebookClient = new \Facebook\Facebook([
                    'app_id' => $fbInfo['appId'],
                    'app_secret' => $fbInfo['secret'],
                    'default_graph_version' => 'v2.5'
                ]);
                $helper = $facebookClient->getRedirectLoginHelper();
                try {
                    $accessToken = $helper->getAccessToken();
                } catch (\Facebook\Exceptions\FacebookResponseException $e) {
                    // When Graph returns an error
//                        echo 'Graph returned an error: ' . $e->getMessage();
//                        exit;
                    /*
                     * catch return to login
                     */
                    return $this->response->redirect("user/login");
                } catch (\Facebook\Exceptions\FacebookSDKException $e) {
                    // When validation fails or other local issues
                    echo 'Facebook SDK returned an error: ' . $e->getMessage();
                    exit;
                    /*
                     * catch return to register
                     */
                    return $this->response->redirect("user/register");
                }

                if (!isset($accessToken)) {
                    /*
                     * không tồn tại acess token thì redirect về trang register
                     */
                    return $this->response->redirect("account/register");
                }

                try {
                    $response = $facebookClient->get('/me?' . $fbInfo['field_profile'], $accessToken);
                    $userInfoFacebook = $response->getGraphUser();
                } catch (\Exception $exc) {
//                        echo $exc->getMessage();
                    /*
                     * catch return to register
                     */
                    return $this->response->redirect("account/register");
                }

                if (!isset($userInfoFacebook)) {
                    /*
                     * không tồn tại thông tin user thì redirect về trang Đăng ký
                     */
                    return $this->response->redirect("account/register");
                }

                $userEmail = $userInfoFacebook['email'];

                if (empty($userEmail)) {
                    /*
                     * không tồn tại Email thì redirect về trang Đăng kys
                     */
                    return $this->response->redirect("user/register");
                }

                /*
                 * Kiểm tra người dùng đã tồn tại trong hệ thống hay chưa, nếu đã tồn tại thì cho login thành công
                 */
                $userInfo = $serviceUser->getDetail(['user_email' => $userEmail, 'not_user_status' => -1]);

                if ($userInfo) {
                    $arrUpdate = [
                        'user_last_login' => time(),
                        'user_login_ip' => $this->getRequest()->getServer('REMOTE_ADDR'),
                    ];
                    if (empty($userInfo['social_profile_url'])) {
                        $arrUpdate['social_profile_url'] = $userInfoFacebook['link'];
                    }
                    $login = $serviceUser->edit($arrUpdate, $userInfo["user_id"]);
                    if ($login) {
                        /*
                         * set session
                         */
                        $this->getAuthService()->clearIdentity();
                        $this->getAuthService()->getStorage()->write($userInfo);
                        return $this->redirect()->toRoute('user-profile');
                    }
                }
                /*
                 * Nếu chưa có thông tin trong hệ thống thì set session để Nhập tên cá nhân(Doanh Nghiệp) và mật khẩu
                 */
                $completeSession = new Container('authTemp');
                $completeSession->name = $userInfoFacebook['name'];
                $completeSession->linkProfile = $userInfoFacebook['link'];
                $completeSession->avatar = $userInfoFacebook['picture']['url'];
                $completeSession->ref = 'facebook.com';
                $completeSession->email = $userInfoFacebook['email'];
            }
        }
        if ($this->request->isPost()) {

            $arrParams = $this->params()->fromPost();

            if (empty($arrParams['fullname'])) {
                $errors['fullname'] = 'Họ và tên không được bỏ trống!';
            } else {
                if (strlen($arrParams['fullname']) < 5) {
                    $errors['fullname'] = 'Nhập họ và tên chưa chính xác!';
                }
            }

            if (empty($arrParams['phone'])) {
                $errors['phone'] = 'Số điện thoại không được bỏ trống!';
            } else {
                $validator = new \Zend\Validator\Digits();
                if (!$validator->isValid($arrParams['phone'])) {
                    $errors['phone'] = 'Số di động không không hợp lệ!';
                } else {
                    $validator = new \Zend\Validator\StringLength(array('min' => 8, 'max' => 12));
                    if (!$validator->isValid($arrParams['phone'])) {
                        $errors['phone'] = 'Số di động không không hợp lệ!';
                    }
                }
            }

            if (empty($arrParams['password'])) {
                $errors['password'] = 'Vui lòng nhập mật khẩu!';
            } else {
                if (strlen($arrParams['password']) < 6) {
                    $errors['password'] = 'Mật khẩu phải từ 6 ký tự trở lên !';
                }
            }

            if (empty($errors)) {
                //Check Phone
                $arrPhone = $serviceUser->getDetail(['user_phone' => $arrParams['phone'], 'not_user_status' => -1]);
                if (!empty($arrPhone)) {
                    $errors['phone'] = 'Số di động này đã tồn tại trong hệ thống của chúng tôi! Vui lòng  chọn số điện thoại khác';
                }

                if (empty($errors)) {
                    $completeSession = new Container('authTemp');
                    $arrData = [
                        'user_email' => $completeSession->email,
                        'user_phone' => $arrParams['phone'],
                        'user_status' => 1,
                        'user_fullname' => $arrParams['fullname'],
                        'user_password' => md5($arrParams['password']),
                        'created_date' => time(),
                        'user_login_ip' => $this->getRequest()->getServer('REMOTE_ADDR'),
                        'user_last_login' => time(),
                        'social_profile_url' => $completeSession->ref,
                        'user_avatar_social' => $completeSession->avatar
                    ];
                    $intResult = $serviceUser->add($arrData);
                    if ($intResult) {
                        $completeSession->getManager()->getStorage()->clear('authTemp');
                        $arrData['user_id'] = $intResult;
                        //return to reg success 
                        $this->getAuthService()->clearIdentity();
                        $this->getAuthService()->getStorage()->write($arrData);
                        return $this->redirect()->toRoute('user-profile');
                    }
                    $errors[] = 'Xảy ra lỗi trong quá trình xử lý! Vui lòng thử lại sau giây lát!';
                }
            }
        }

        return [
            'errors' => $errors,
            'completeSession' => $completeSession,
            'params' => $arrParams
        ];
    }

}