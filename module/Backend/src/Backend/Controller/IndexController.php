<?php

namespace Backend\Controller;

use My\Controller\MyController;
use Sunra\PhpSimple\HtmlDomParser,
    Zend\View\Model\ViewModel;

class IndexController extends MyController {

    public function __construct() {
        
    }

    public function indexAction() {
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
            'liên hệ'
        ];
//        $k = 'Cần cho thuê nhà nguyên căn tại Quốc Lộ 1A, thôn Quảng Tín, xã Phước Lộc, huyện Tuy Phước, tỉnh Bình Định. Nhà cấp 4, DT 6m x 20m, điện nước đầy đủ, gần chợ Quán Mối, mâm lốp Thanh An, Duy Khiêm, Nem chợ Huyện 72.Tiện buôn bán, làm văn phòng, kinh doanh... Liên hệ chỉnh chủ: chú Long - 0978 561 535. Giá tốt cho người có thiện chí.';
//        //thue nha nguyen can QL1A Binh Dinh
//        $goc = 'Cần bán nhà đường nội bộ hoàng văn thụ, lộ giới 8m.trước mặt nhà 6m nhà mới mua về ở liền kg cần sửa chữa, dt 70m2 ngang 5 dài 14m nhà 1 mê lỡ hướng tây bắc, thích hợp cho v/c thích yên tĩnh, giá 1tỷ 400tr ai có nhu cầu lh:0903281721';
//        $str = str_replace($arrPatent, $arrReplace, $k);
//        echo '<pre>';
//        print_r($str);
//        echo '</pre>';
//        die();

        return;
//        $instanceSearchDistrict = new \My\Search\District();
//        $temp = 'Qui Nhơn';
//        $arr = $instanceSearchDistrict->getDetail(['like_name'=>$temp]);
//        echo '<pre>';
//        print_r($arr);
//        echo '</pre>';
//        die();


        die();
    }

}
