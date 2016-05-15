<?php

namespace Frontend\Controller;

use My\Controller\MyController,
    My\General;

class GeneralController extends MyController {

    public function __construct() {
        $this->externalJS = [
            STATIC_URL . '/f/v1/js/my/??general.js'
        ];
        $this->externalCSS = [
            STATIC_URL . '/b/css/??bootstrap-wysihtml5.css'
        ];
    }

    public function indexAction() {
        $params = $this->params()->fromRoute();

        if (empty($params['geneId']) || empty($params['geneSlug'])) {
            return $this->redirect()->toRoute('404');
        }

        $instanceSeachGeneral = new \My\Search\GeneralBqn();
        $arr_general = $instanceSeachGeneral->getDetail(['gene_id' => $params['geneId'], 'gene_status' => 1]);

        if (empty($arr_general)) {
            return $this->redirect()->toRoute('404');
        }

        if ($arr_general['gene_slug'] != $params['geneSlug']) {
            return $this->redirect()->toRoute('general', array('geneSlug' => $arr_general['gene_slug'], 'geneId' => $params['geneId']));
        }

        return [
            'arr_general' => $arr_general
        ];
    }

    public function contactAction() {
        $params = $this->params()->fromRoute();
        if ($this->request->isPost()) {
            $params = $this->params()->fromPost();

            $validate = new \My\Validator\Validate();

            if (!CUSTOMER_ID) {
                if (empty($params['name'])) {
                    $errors['name'] = 'Họ và tên không được bỏ trống!';
                } elseif (strlen($params ['name'] < 5)) {
                    $errors['name'] = 'Nhập họ tên chưa hợp lệ!';
                }

                if (!$validate->emailAddress($params['email'])) {
                    $errors['email'] = 'Địa chỉ email không hợp lệ!';
                }

                if (!$validate->Digits($params['phone'])) {
                    $errors['phone'] = 'Nhập số điện thoại chưa chính xác!';
                } elseif (strlen($params['phone']) < 8 || strlen($params['phone']) > 12) {
                    $errors['phone'] = 'Nhập số điện thoại chưa chính xác!';
                }
            }

            if (!$validate->notEmpty($params['subject'])) {
                $errors['subject'] = 'Tiêu đề không được bỏ trống!';
            } elseif (strlen($params['subject']) < 5) {
                $errors['subject'] = 'Tiêu đề phải từ 5 ký tự trở lên!';
            }

            if (!$validate->notEmpty($params['contact_content'])) {
                $errors['contact_content'] = 'Nội dung liên hệ không được bỏ trống!';
            } elseif (strlen($params ['contact_content']) < 20) {
                $errors['contact_content'] = 'Nội dung phải từ 20 ký tự trở lên!';
            }

            if (!$validate->notEmpty($params['captcha'])) {
                $errors['captcha'] = 'Chưa nhập mã xác nhận!';
            } elseif (strlen($params['captcha']) != 6) {
                $errors['captcha'] = 'Nhập mã xác nhận chưa đúng!';
            } elseif ($params['captcha'] != $_SESSION['captcha']) {
                $errors['captcha'] = 'Nhập mã xác nhận chưa đúng!';
            }

            if (empty($errors)) {
                $arrData = [
                    'contact_title' => $params['subject'],
                    'contact_content' => $params['contact_content'],
                    'created_date' => time()
                ];
                if (CUSTOMER_ID) {
                    $arrData['user_created'] = CUSTOMER_ID;
                } else {
                    $arrData['user_info'] = json_encode(
                            [
                                'user_info_name' => $params['name'],
                                'user_info_email' => $params['email'],
                                'user_info_phone' => $params['phone'],
                            ]
                    );
                }

                $serviceContact = $this->serviceLocator->get('My\Models\Contact');
                if ($serviceContact->add($arrData)) {
                    $success = 'Gửi liên hệ thành công!';
                    $params = [];
                } else {
                    $errors[] = 'Xảy ra lỗi trong quá trình xử lý! Vui lòng thử lại sau giây lát!';
                }
            }
        }

        $this->renderer = $this->serviceLocator->get('Zend\View\Renderer\PhpRenderer');
        $this->renderer->headMeta()->appendName('dc.description', html_entity_decode('Gửi liên hệ với chúng tôi, gửi liên hệ với website quynhon247.com') . General::TITLE_META);
        $this->renderer->headTitle(html_entity_decode('Gửi liên hệ với chúng tôi, gửi liên hệ với website quynhon247.com') . General::TITLE_META);
        $this->renderer->headMeta()->appendName('keywords', html_entity_decode('lien he, lien he quynhon247.com, lien he voi quynhon247,') . General::SITE_DOMAIN);
        $this->renderer->headMeta()->appendName('description', html_entity_decode('Gửi liên hệ với chúng tôi, gửi liên hệ với website quynhon247.com, ') . General::TITLE_META);
        $this->renderer->headMeta()->setProperty('og:url', $this->url()->fromRoute('add-contact'));
        $this->renderer->headMeta()->setProperty('og:title', html_entity_decode('Gửi liên hệ với chúng tôi, gửi liên hệ với website quynhon247.com, ') . General::TITLE_META);
        $this->renderer->headMeta()->setProperty('og:description', html_entity_decode('Gửi liên hệ với chúng tôi, gửi liên hệ với website quynhon247.com, ') . General::TITLE_META);

        return [
            'params' => $params,
            'errors' => $errors,
            'success' => $success,
        ];
    }

}
