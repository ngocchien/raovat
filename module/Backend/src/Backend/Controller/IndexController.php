<?php

namespace Backend\Controller;

use My\Controller\MyController;
use Sunra\PhpSimple\HtmlDomParser,
    Zend\View\Model\ViewModel;

class IndexController extends MyController {

    public function __construct() {
        
    }

    public function indexAction() {
//        echo '<a href="http://dev.st.raovat.vn/18-05-2016-03_49_18.xlsx" download>nè</a>';
//        die();
        return;
        $url = 'http://www.raovatquynhon.com/raovat/viec-tim-nguoi/';
        $subject = file_get_contents($url);
        preg_match_all('/<table width="100%" cellspacing="0" border="0">(.*?)<\/table>/', $subject, $matches);
        preg_match_all('/http:\/\/www.raovatquynhon.com\/raovat\/(.+?)html/', $matches[1][1], $chil);
        $arr_href = $chil[0];
        unset($subject);
        unset($matches);
        unset($chil);
//        <h1 class="titdetail">Tuyển nhân viên kinh doanh phát triển thị trường hàng tiêu dùng</h1>
        foreach ($arr_href as $value) {
            $arr_data = [];
            $content = file_get_contents($value);

            preg_match('/<h1 class="titdetail">(.+?)<\/h1>/', $content, $matches);
            $arr_data['cont_title'] = $this->coverStr($matches[1]);
            $arr_data['cont_slug'] = \My\General::getSlug($arr_data['cont_title']);

            //find in DB;
            $instanceSearchContent = new \My\Search\Content();
            $arr_detail = $instanceSearchContent->getDetail(['cont_slug' => $arr_data['cont_slug'], 'not_cont_status' => -1]);
            if ($arr_detail) {
                unset($arr_detail);
                unset($instanceSearchContent);
                unset($content);
                unset($matches);
                continue;
            }
            preg_match('/<span class="orange">(.+?)<\/span>/', $content, $matches);
            list($day, $month, $yeah) = explode('/', $matches[1]);
            if ((int) $month < 3) {
                unset($arr_detail);
                unset($instanceSearchContent);
                unset($content);
                unset($matches);
                continue;
            }
            $arr_data['created_date'] = time();

            //content
            preg_match('/<div id="contentview">(.*?)<div class="infobottom titdetailbar">/', $content, $matches);
            $arr_data['cont_detail'] = $this->coverStr(trim($matches[1]));
            $arr_data['cont_detail_txt'] = strip_tags($arr_data['cont_detail']);

            //info user
            preg_match_all('/<td class="rv_tdrow4">(.*?)<\/td>/', $content, $info);

            $user_info = [
                'user_email' => trim(strip_tags($info[1][1])),
                'user_phone' => trim(strip_tags($info[1][5])),
            ];

            if ($user_info['user_email'] == 'ctytrio@gmail.com') {
                continue;
            }

            $temp = preg_match('/<table width="100%" cellspacing="1" celpadding="0" border="0" class="tablebg_silver">(.*?)<\/table>/', $content, $matches);
            preg_match('/<b>(.*?)<\/b>/', $matches[1], $name);
            $user_info['user_fullname'] = trim($name[1]);
            $user_info['cont_password'] = \My\General::randomDigits();

            $arr_data['user_info'] = $user_info;
            $arr_data['updated_date'] = time();
            $arr_data['dist_id'] = 0;
            $arr_data['total_comment'] = 0;
            $arr_data['from_soucre'] = 'raovatquynhon.com';
            $arr_data['is_send'] = 0;
            $arr_data['cate_id'] = 79;

            $serviceContent = $this->serviceLocator->get('My\Models\Content');
            if ($serviceContent->add($arr_data)) {
                $instanceSearchCategory = new \My\Search\Category();
                $arrCate = $instanceSearchCategory->getDetail(['cate_id' => 79]);

                $serviceCategory = $this->serviceLocator->get('My\Models\Category');
                $serviceCategory->edit(['total_content' => (int) $arrCate['total_content'] + 1], 79);
                echo \My\General::getColoredString("Crawler success 1 post from raovatquynhon.com \n", 'green');
            } else {
                echo \My\General::getColoredString("Error insert from raovatquynhon.com \n", 'red');
            }
            unset($instanceSearchCategory);
            unset($instanceSearchContent);
            unset($arr_detail);
            unset($arr_data);
            unset($serviceContent);

            $this->flush();
        }
        echo \My\General::getColoredString("Crawler raovatquynhon.com Success \n", 'green');

        return true;
    }

    public function coverStr($str) {
        $arrPatent = [
            'mọi người',
            'tận nhà',
            'mobi',
            'vina',
            'https://web.facebook.com/',
            'https://facebook.com/',
            'Đ/C',
            'A.',
            'bạn',
            'lh',
            'v/c',
            'Tôi',
            'tôi',
            'nhà mới',
            'dt',
            'thue',
            'nha nguyen can',
            'QL1A',
            'Binh Dinh',
            'DT',
            'Tiện',
            'tiện',
            'ai cần',
            'LH',
            'Tuyển nhân viên',
        ];
        $arrReplace = [
            'tất cả mọi người',
            'tận nơi',
            'mobiphone',
            'vinaphone',
            'http://fb.com/',
            'http://fb.com/',
            'địa chỉ',
            'anh',
            'anh chị',
            'liên hệ',
            'vợ/chồng',
            'Mình',
            'mình',
            'nhà mới xây',
            'diện tích',
            'thuê',
            'nhà nguyên căn',
            'Quốc lộ 1A',
            'Bình Định',
            'diện tích',
            'Thuận tiện',
            'thuận tiện',
            'ai có nhu cầu',
            'liên hệ',
            'Cần tuyển nhân viên',
        ];

        $strRt = str_replace($arrPatent, $arrReplace, $str);
        return $strRt;
    }

}
