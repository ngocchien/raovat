<?php

namespace Backend\Controller;

use My\Controller\MyController;
use Sunra\PhpSimple\HtmlDomParser;

class IndexController extends MyController {

    public function __construct() {
        
    }

    public function indexAction() {
        return;
        include PUBLIC_PATH . '/simple_html_dom.php';
        $html = file_get_html('http://www.raovatbinhdinh.vn/viec-lam-tuyen-dung-1-19.html');
        $domain = 'http://www.raovatbinhdinh.vn';
        
        $arr = [];
        foreach ($html->find('#ccr-left-section .ccr-world-news a') as $element) {
            if ($element->href != 'javascript:void(0);') {
                $arr[] = $element->href;
            }
        }
        unset($html);
        foreach ($arr as $value) {

            $html = file_get_html($domain . $value);
            $arrData = [];
            foreach ($html->find('h2') as $element) {
                preg_match('/<h2>(.*?)<label style="float:right;margin-right: 5px;"><i class="fa fa-eye"><\/i>.*?<\/label><\/h2>/', $element->outertext, $arrRa);
                $arrData['cont_title'] = $arrRa[1];
                $arrData['cont_slug'] = \My\General::getSlug($arrRa[1]);
                $arrData['updated_date'] = time();
                $arrData['cate_id'] = 79;
                $arrData['cont_status'] = 1;
            }
            foreach ($html->find('#ccr-left-section #ccr-article .ccr-world-news li') as $key => $element) {
                if ($key == 2) {
                    preg_match('/Người đăng :(.*?) - Điện thoại : (.*?) - Email :(.*?)/', $element->plaintext, $arrRa);
                    $arrUser = [
                        'user_fullname' => $arrRa[1],
                        'user_phone' => $arrRa[2],
                        'user_email' => $arrRa[3],
                        'cont_password' => '123123'
                    ];
                    $arrData['user_info'] = json_encode($arrUser);
                }
            }
            foreach ($html->find('#DetailCommerce div[style=border-bottom: 1px solid #e3e2e2;float:left;width:100%]') as $key => $element) {
                $arrData['cont_detail'] = $element->plaintext;
                $arrData['cont_detail_text'] = \My\General::getSlug($element->plaintext);
                $arrData['created_date'] = time();
            }
            $serviceContent = $this->serviceLocator->get('My\Models\Content');
            if ($serviceContent->add($arrData)) {
                echo \My\General::getColoredString("Sitemap content done", 'green', 'cyan');
            } else {
                echo \My\General::getColoredString("Sitemap content done", 'red', 'cyan');
            }
            unset($arrData);
            unset($serviceContent);
        }
        die();
    }

}
