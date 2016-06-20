<?php

if (APPLICATION_ENV === 'dev') {
    $display_not_found_reason = true;
    $display_exceptions = true;
    $errorHandler = array(
        'display' => true,
        'ajax_only' => true,
        'show_trace' => true
    );
} else {
    $display_not_found_reason = false;
    $display_exceptions = false;
    $errorHandler = array(
        'display' => false,
        'ajax_only' => false,
        'show_trace' => false
    );
}

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'index',
                        'action' => 'index',
                    ),
                ),
            ),
            'frontend' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '[/:controller[/:action][/page:page][/id:id]][/]',
                    'constraints' => array(
                        'controller' => 'index',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'sort' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'page' => '[0-9]+',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'index',
                        'action' => 'index',
                    ),
                ),
            ),
            'index' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '[[/page[/:page]].html]',
                    'constraints' => array(
                        'page' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'index',
                        'action' => 'index',
                        'page' => 1
                    ),
                ),
            ),
            'product_rate' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '[/:rate].html',
                    'constraints' => array(
                        'rate' => '[a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'product',
                        'action' => 'rate'
                    ),
                ),
            ),
            'search' => array(
                'type' => 'Segment',
                'options' => array(
//                    'route' => '/s/[tim-kiem-[:keySlug[.html]]][:brand/][?[s=:s][&price=:price][&sort=:sort][&page=:page]]',
                    'route' => '/tim-kiem[?[khu-vuc=:khu-vuc][&danh-muc=:danh-muc][&tu-khoa=:tu-khoa][&page=:page]]',
                    'constraints' => array(
                        'controller' => 'search',
                        'action' => 'index',
                        'page' => '[0-9]+',
                        'khu-vuc' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'danh-muc' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'tu-khoa' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'search',
                        'action' => 'index',
//                        'trang' => 1,
//                        'khu-vuc' => 'toan-tinh',
//                        'danh-muc' => 'tat-ca-danh-muc',
//                        'tu-khoa' => ''
                    ),
                ),
            ),
            'content' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/rao-vat[[/:action].html]',
                    'constraints' => array(
                        'module' => 'frontend',
                        'controller' => 'content',
                        'action' => '[a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'content',
                        'action' => '[a-zA-Z0-9_-]*',
                    ),
                ),
            ),
            'general' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/general[[/:geneSlug]-[:geneId].html]',
                    'constraints' => array(
                        'module' => 'frontend',
                        'controller' => 'general',
                        'action' => 'index',
                        'geneSlug' => '[a-zA-Z0-9_-]*',
                        'geneId' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'general',
                        'action' => 'index',
                        'geneSlug' => '',
                        'geneId' => 0,
                    ),
                ),
            ),
            'view-content' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/rao-vat[[/:contentSlug]-[:contentId].html]',
                    'constraints' => array(
                        'module' => 'frontend',
                        'controller' => 'content',
                        'action' => 'detail',
                        'contentSlug' => '[a-zA-Z0-9_-]*',
                        'contentId' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'content',
                        'action' => 'detail',
                        'contentSlug' => '',
                        'contentId' => 0
                    ),
                ),
            ),
            'edit-content' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/rao-vat/chinh-sua-rao-vat[[/:contentSlug]-[:contentId].html]',
                    'constraints' => array(
                        'contentSlug' => '[a-zA-Z0-9_-]*',
                        'contentId' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'content',
                        'action' => 'edit',
                        'contentSlug' => '',
                        'contentId' => 0
                    ),
                ),
            ),
            'confirm-pass-content' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/rao-vat/xac-nhan-mat-khau-tin-rao-vat.html',
                    'constraints' => array(
                        'contentId' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'content',
                        'action' => 'confirm-password',
                    ),
                ),
            ),
            'delete-content' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/xoa-tin-rao-vat[[/:contentId].html]',
                    'constraints' => array(
                        'contentId' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'content',
                        'action' => 'delete',
                        'contentId' => 0
                    ),
                ),
            ),
            'deal-vip-content' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/mua-vip-tin.html',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'content',
                        'action' => 'deal-vip',
                    ),
                ),
            ),
            'user-delete-content' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/xoa-tin-rao-vat[[/:contentId].html]',
                    'constraints' => array(
                        'contentId' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'content',
                        'action' => 'delete',
                        'contentId' => 0
                    ),
                ),
            ),
            'addcontent' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/rao-vat/dang-tin-rao-vat[.html]',
                    'constraints' => array(
                        'controller' => 'content',
                        'action' => 'add',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'content',
                        'action' => 'add',
                    ),
                ),
            ),
            'add-content-complete' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/dang-rao-vat-thanh-cong[.html]',
                    'constraints' => array(
                        'controller' => 'content',
                        'action' => 'complete',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'content',
                        'action' => 'complete',
                    ),
                ),
            ),
            'getproperties' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/lay-danh-sach-thuoc-tinh[.html]',
                    'constraints' => array(
                        'controller' => 'content',
                        'action' => 'get-properties',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'content',
                        'action' => 'get-properties',
                    ),
                ),
            ),
            'upload' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/hinh-anh[.html]',
                    'constraints' => array(
                        'controller' => 'content',
                        'action' => 'upload',
//                        'filename'=>'[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'content',
                        'action' => 'upload',
                    ),
                ),
            ),
            'comfirm-forgot-password' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/thanh-vien/xac-nhan-lay-lai-mat-khau[/:randomKey][.html]',
                    'constraints' => array(
                        'module' => 'frontend',
                        'controller' => 'auth',
                        'action' => 'confirm-reset-password',
                        'randomKey' => '[a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'auth',
                        'action' => 'confirm-reset-password',
                        'randomKey' => '[a-zA-Z0-9_-]*'
                    ),
                ),
            ),
            'member-block' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/thanh-vien/da-bi-khoa[.html]',
                    'constraints' => array(
                        'module' => 'frontend',
                        'controller' => 'auth',
                        'action' => 'block',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'auth',
                        'action' => 'block',
                    ),
                ),
            ),
            'user-login' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/thanh-vien/dang-nhap[.html]',
                    'constraints' => array(
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'login',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'login',
                    ),
                ),
            ),
            'user-profile' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/thanh-vien/thong-tin-ca-nhan[.html]',
                    'constraints' => array(
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'index',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'index',
                    ),
                ),
            ),
            'user-list-post' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/thanh-vien/danh-sach-tin-dang[[-:page]].html',
                    'constraints' => array(
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'list-post',
                        'page' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'list-post',
                        'page' => '[0-9]+',
                    ),
                ),
            ),
            'user-list-save-post' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/thanh-vien/danh-sach-rao-vat-da-luu[[-:page]].html',
                    'constraints' => array(
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'list-save-post',
                        'page' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'list-save-post',
                        'page' => '[0-9]+',
                    ),
                ),
            ),
            'user-change-password' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/thanh-vien/doi-mat-khau[.html]',
                    'constraints' => array(
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'change-password',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'change-password',
                    ),
                ),
            ),
            'user-recharge' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/thanh-vien/nap-tien-tai-khoan[.html]',
                    'constraints' => array(
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'recharge',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'recharge',
                    ),
                ),
            ),
            'user-deal-history' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/thanh-vien/lich-su-giao-dich[[-:page]][.html]',
                    'constraints' => array(
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'deal-history',
                        'page' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'deal-history',
                        'page' => 1
                    ),
                ),
            ),
            'user-login-social' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/thanh-vien/dang-nhap-bang-mang-xa-hoi[-:type].html',
                    'constraints' => array(
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'social',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'social',
                    ),
                ),
            ),
            'user-change-avatar' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/thanh-vien/thay-doi-anh-dai-dien.html',
                    'constraints' => array(
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'change-avatar',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'change-avatar',
                    ),
                ),
            ),
            'user-list-messages' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/thanh-vien/danh-sach-tin-nhan[[-:page]].html',
                    'constraints' => array(
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'list-messages',
                        'page' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'list-messages',
                        'page' => '[0-9]+',
                    ),
                ),
            ),
            'user-get-messages' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/thanh-vien/lay-noi-dung-tin-nhan.html',
                    'constraints' => array(
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'get-messages',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'get-messages',
                    ),
                ),
            ),
            'user-replay-messages' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/thanh-vien/phan-hoi-tin-nhan.html',
                    'constraints' => array(
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'replay-messages',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'replay-messages',
                    ),
                ),
            ),
            'delete-messages' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/thanh-vien/phan-hoi-tin-nhan.html',
                    'constraints' => array(
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'delete-messages',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'delete-messages',
                    ),
                ),
            ),
            'delete-save-post' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/thanh-vien/xao-rao-vat-da-luu.html',
                    'constraints' => array(
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'delete-save-post',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'delete-save-post',
                    ),
                ),
            ),
            'refresh-content' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/thanh-vien/lam-moi-rao-vat.html',
                    'constraints' => array(
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'refresh-content',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'refresh-content',
                    ),
                ),
            ),
            'captcha' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/lay-ma-xac-nhan',
                    'constraints' => array(
                        'controller' => 'captcha',
                        'action' => 'index',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'captcha',
                        'action' => 'index',
                    ),
                ),
            ),
            'add-comment' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/dang-phan-hoi',
                    'constraints' => array(
                        'controller' => 'content',
                        'action' => 'add-comment',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'content',
                        'action' => 'add-comment',
                    ),
                ),
            ),
            'add-contact' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/general/gui-lien-he-cho-chung-toi.html',
                    'constraints' => array(
                        'controller' => 'general',
                        'action' => 'contact',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'general',
                        'action' => 'contact',
                    ),
                ),
            ),
            '404' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/404.html',
                    'constraints' => array(
                        'controller' => 'error',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'error',
                        'action' => 'e404',
                    ),
                ),
            ),
            'notfound' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/s[?[s=:s][&price=:price][&sort=:sort][&page=:page]]',
                    'constraints' => array(
                        'controller' => 'error',
                        'index' => 'redirect',
                        's' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'brand' => '[a-zA-Z0-9_-]*',
                        'price' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'sort' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'page' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'error',
                        'action' => 'redirect',
                    ),
                ),
            ),
            'category' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/danh-muc/[[:cateSlug]-[:cateId]][/khu-vuc/[:dist]-[:distId]][/nhu-cau/[:propSlug]-[:propId]][[/:page]][.html]',
                    'constraints' => array(
                        'controller' => 'category',
                        'action' => 'index',
                        'cateSlug' => '[a-zA-Z0-9_-]*',
                        'cateId' => '[0-9]+',
                        'propSlug' => '[a-zA-Z0-9_-]*',
                        'propId' => '[0-9]+',
                        'dist' => '[a-zA-Z0-9_-]*',
                        'distId' => '[0-9]+',
                        'page' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'category',
                        'action' => 'index',
                        'cateSlug' => '',
                        'cateId' => 0,
                        'propId' => 0,
                        'propSlug' => '',
                        'dist' => '',
//                        'distId' => 0,
                        'page' => 1
                    ),
                ),
            ),
            'view-user-info' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/danh-sach-rao-vat-tai-khoan/[[:fullname]-[:userId]][/trang/[:page]][.html]',
                    'constraints' => array(
                        'controller' => 'user',
                        'action' => 'view-user',
                        'fullname' => '[a-zA-Z0-9_-]*',
                        'userId' => '[0-9]+',
                        'page' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'user',
                        'action' => 'view-user',
                        'fullname' => '',
                        'userId' => 0,
                        'page' => 1
                    ),
                ),
            ),
            'auth' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '[/taikhoan[[/][:action][.html]]]',
                    'constraints' => array(
                        'controller' => 'auth',
                        'action' => '[a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'auth',
                        'action' => 'index',
                    ),
                ),
            ),
            'sitemap' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/sitemap/[[:action]][/page[/:page]][.html]',
                    'constraints' => array(
                        'controller' => 'sitemap',
                        'action' => '[a-zA-Z0-9_-]*',
                        'page' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'sitemap',
                        'action' => 'index',
                        'page' => 1
                    ),
                ),
            ),
        ),
    ),
    'module_layouts' => array(
        'Frontend' => FRONTEND_TEMPLATE . '/layout/layout'
    ),
    'view_helpers' => array(
        'invokables' => array(
            'paging' => 'My\View\Helper\Paging',
        )
    ),
    'translator' => array('locale' => 'en_US'),
    'view_manager' => array(
        'display_not_found_reason' => $display_not_found_reason,
        'display_exceptions' => $display_exceptions,
        'doctype' => 'HTML5',
        'template_map' => array(
            FRONTEND_TEMPLATE . '/layout/layout' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/layout/layout.phtml',
            'frontend/header' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/layout/header.phtml',
            'frontend/layder-slider' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/layout/layderSlider.phtml',
            'frontend/search' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/layout/search.phtml',
            'frontend/premium' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/layout/premium.phtml',
            'frontend/category' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/layout/category.phtml',
            'frontend/classify' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/layout/classify.phtml',
            'frontend/footer' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/layout/footer.phtml',
            'frontend/template_email' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/layout/template_email.phtml',
            'frontend/content/upload' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/frontend/content/upload.phtml',
            'frontend/auth/reset-password' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/frontend/auth/reset-password.phtml',
            'frontend/nav-user-left' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/layout/nav-user-left.phtml',
            'frontend/nav-ads-right' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/layout/nav-ads-right.phtml',
            'frontend/content/add-comment' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/frontend/content/add-comment.phtml',
            'frontend/email-messages' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/layout/email-messages.phtml',
            'frontend/footer-email' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/layout/footer-email.phtml',
            'frontend/user/get-messages' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/frontend/user/get-messages.phtml',
            'frontend/email-replay-messages' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/layout/email-replay-messages.phtml'
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view/' . FRONTEND_TEMPLATE,
        ),
        'json_exceptions' => $errorHandler,
    ),
);
