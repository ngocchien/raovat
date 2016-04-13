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
                    'route' => '[/:controller[/:action][/page:page]][/]',
                    'constraints' => array(
                        'controller' => 'index',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'sort' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'page' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'index',
                        'action' => 'index',
                    ),
                ),
            ),
//            'frontend-search' => array(
//                'type' => 'Segment',
//                'options' => array(
//                    'route' => '/s/[o-[:keySlug[.html]]][[:categorySlug]-[:categoryID/]][:brand/][?[s=:s][&price=:price][&sort=:sort][&page=:page]]',
//                    'constraints' => array(
//                        'controller' => 'search',
//                        'index' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                        's' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                        'categorySlug' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                        'categoryID' => '[0-9]+',
//                        'brand' => '[a-zA-Z0-9_-]*',
//                         'keySlug' => '[a-zA-Z0-9_-]*',
//                        'price' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                        'sort' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                        'page' => '[0-9]+',
//                    ),
//                    'defaults' => array(
//                        '__NAMESPACE__' => 'Frontend\Controller',
//                        'module' => 'frontend',
//                        'controller' => 'search',
//                        'action' => 'index',
//                    ),
//                ),
//            ),
            'frontend-order' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '[/:controller[/:action][?[s=:s][&page=:page]]]',
                    'constraints' => array(
                        'controller' => 'order',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        //'category' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        's' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'page' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'index',
                        'action' => 'index',
                    ),
                ),
            ),
            'order-view' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '[/:controller[/:action][/id/:id]]',
                    'constraints' => array(
                        'controller' => 'order',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
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
                    'route' => '[/:controller[/:action]]',
                    'constraints' => array(
                        'controller' => 'search',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'search',
                        'action' => 'index',
                    ),
                ),
            ),
            'product' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/rao-vat[[/:productslug]-[:productId].html]',
                    'constraints' => array(
                        //'categorySlug' => '[a-zA-Z0-9_-]*',
                        //'categoryId' => '[a-zA-Z0-9_-]*',
                        'productslug' => '[a-zA-Z0-9_-]*',
                        'productId' => '[0-9]+',
                        'page' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'product',
                        'action' => 'detail',
                        //'categorySlug' => '',
                        //'categoryId' => 0,
                        'productslug' => '',
                        'productId' => 0
                    ),
                ),
            ),
            
            'edit_product' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/chinh-sua-rao-vat[[/:productslug]-[:productId].html]',
                    'constraints' => array(
                        //'categorySlug' => '[a-zA-Z0-9_-]*',
                        //'categoryId' => '[a-zA-Z0-9_-]*',
                        'productslug' => '[a-zA-Z0-9_-]*',
                        'productId' => '[0-9]+',
//                        'page' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'product',
                        'action' => 'edit',
                        //'categorySlug' => '',
                        //'categoryId' => 0,
                        'productslug' => '',
                        'productId' => 0
                    ),
                ),
            ),
            
            'addcontent' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/dang-tin-rao-vat[.html]',
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
            
            'getproperties' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/rao-vat/get-properties[.html]',
                    'constraints' => array(
                        'controller' => 'product',
                        'action' => 'get-properties',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'product',
                        'action' => 'get-properties',
                    ),
                ),
            ),
            
            'upload' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/hinh-anh[.html]',
                    'constraints' => array(
                        'controller' => 'product',
                        'action' => 'upload',
//                        'filename'=>'[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'product',
                        'action' => 'upload',
                    ),
                ),
            ),
            
            'tags' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/tags[/:tagsSlug]-[:tagsID][/:brand][.html][?[&price=:price][&sort=:sort][&page=:page]]',
                    'constraints' => array(
                        'tagsSlug' => '[a-zA-Z0-9_-]*',
                        'tagsID' => '[a-zA-Z0-9_-]*',
                        'sort' => '[a-zA-Z0-9_-]*',
                        'brand' => '[a-zA-Z0-9_-]*',
                        'price' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'page' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'tags',
                        'action' => 'index',
                        'tagsSlug' => '',
                        'tagsID' => 0,
                    ),
                ),
            ),
            'tags-content' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/ctags[/:tagsSlug]-[:tagsID][.html][?[&page=:page]]',
                    'constraints' => array(
                        'tagsSlug' => '[a-zA-Z0-9_-]*',
                        'tagsID' => '[a-zA-Z0-9_-]*',
                        'page' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'TagsContent',
                        'action' => 'index',
                        'tagsSlug' => '',
                        'tagsID' => 0,
                    ),
                ),
            ),
            'category' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '[/danh-muc[/:categorySlug]-[:categoryID][.html][?[&page=:page]]]',
                    'constraints' => array(
                        'controller' => 'category',
                        'action' => '[a-zA-Z0-9_-]*',
                        'categorySlug' => '[a-zA-Z0-9_-]*',
                        'categoryID' => '[0-9]+',
                        'sort' => '[a-zA-Z0-9_-]*',
                        'page' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'category',
                        'action' => 'index',
                        'categorySlug' => '',
                        'categoryID' => 0,
                    ),
                ),
            ),
//            'cate' => array(
//                'type' => 'Segment',
//                'options' => array(
//                    'route' => '[/:controller[/:action]]',
//                    'constraints' => array(
//                        'controller' => 'category',
//                        'action' => '[a-zA-Z0-9_-]*',
//                        'id' => '[0-9]+',
//                    ),
//                    'defaults' => array(
//                        '__NAMESPACE__' => 'Frontend\Controller',
//                        'module' => 'frontend',
//                        'controller' => 'category',
//                        'action' => 'index',
//                    ),
//                ),
//            ),
//            'brand' => array(
//                'type' => 'Segment',
//                'options' => array(
//                    'route' => '[/br[/:brandSlug][[/:categorySlug]-[:categoryID]].html][?[s=:s][&price=:price][&sort=:sort][&page=:page]]',
//                    'constraints' => array(
//                        'controller' => 'brand',
//                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                        'brandSlug' => '[a-zA-Z0-9_-]*',
//                        's' => '[a-zA-Z0-9_-]*',
//                        'categorySlug' => '[a-zA-Z0-9_-]*',
//                        'categoryID' => '[0-9]+',
//                        'price' => '[a-zA-Z0-9_-]*',
//                        'sort' => '[a-zA-Z0-9_-]*',
//                        'page' => '[0-9]+',
//                    ),
//                    'defaults' => array(
//                        '__NAMESPACE__' => 'Frontend\Controller',
//                        'module' => 'frontend',
//                        'controller' => 'brand',
//                        'action' => 'index',
//                        'brandSlug' => '',
//                        'brandID' => 0,
//                    ),
//                ),
//            ),
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
            'captcha' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '[/:controller[/:action][.html]]',
                    'constraints' => array(
                        'controller' => 'captcha',
                        'action' => '[a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'captcha',
                        'action' => '[a-zA-Z0-9_-]*',
                    ),
                ),
            ),
            'checkout' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '[/:controller[/][:action/]]',
                    'constraints' => array(
                        'controller' => 'checkout',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'checkout',
                        'action' => 'index',
                    ),
                ),
            ),
            'checkout_add_product' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/checkout/[:slug]-[:prod_id].html',
                    'constraints' => array(
                        'slug' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'prod_id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'checkout',
                        'action' => 'index',
                        'slug' => 'khong-them-san-pham-nao',
                        'prod_id' => 0,
                    ),
                ),
            ),
            'add_comment' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/dang-binh-luan.html',
                    'constraints' => array(
                        'controller' => 'comment',
                        'action' => 'add',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'comment',
                        'action' => 'add',
                    ),
                ),
            ),
            'profile' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '[/:controller[/:action]]',
                    'constraints' => array(
                        'controller' => 'profile',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'index',
                        'action' => 'index',
                    ),
                ),
            ),
            'general' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/ge/[:title]-[:id].html',
                    'constraints' => array(
                        'title' => '[a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'general',
                        'action' => 'index',
                        'title' => '',
                        'id' => 0,
                    ),
                ),
            ),
//            'content' => array(
//                'type' => 'Segment',
//                'options' => array(
//                    'route' => '/tt[[/:categorySlug]-[:categoryID].html][?[&page=:page]]',
//                    'constraints' => array(
//                        'slug' => '[a-zA-Z0-9_-]*',
//                        'id' => '[0-9]+',
//                        'page' => '[0-9]+',
//                    ),
//                    'defaults' => array(
//                        '__NAMESPACE__' => 'Frontend\Controller',
//                        'module' => 'frontend',
//                        'controller' => 'content',
//                        'action' => 'index',
//                        'slug' => 'tt',
//                        'id' => 0,
//                    ),
//                ),
//            ),
            'content_detail' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/co/[:contslug]-[:contId].html',
                    'constraints' => array(
                        'contslug' => '[a-zA-Z0-9_-]*',
                        'contId' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'content',
                        'action' => 'view',
                        'contslug' => 'chi-tiet',
                        'contId' => 0,
                    ),
                ),
            ),

            'ordertracking' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '[/:controller[/:action][?id=:id][&email=:email]]',
                    'constraints' => array(
                        'controller' => 'ordertracking',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'email' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'index',
                        'action' => 'index',
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
            
            'menu' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '[/:controller[/][:action[/]]]',
                    'constraints' => array(
                        'controller' => 'menu',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'module' => 'frontend',
                        'controller' => 'menu',
                        'action' => 'load-menu',
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
//            'frontend/createOrder' => __DIR__ . '/../view/email/create_order.phtml',
//            'frontend/topbar' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/layout/topbar.phtml',
//            'frontend/vertical-menu' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/layout/vertical-menu.phtml',
//            'frontend/horizontal-menu' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/layout/horizontal-menu.phtml',
//            'frontend/main-left-banner' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/layout/main-left-banner.phtml',
//            'frontend/main-right-banner' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/layout/main-right-banner.phtml',
//            'frontend/main-bottom-banner' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/layout/main-bottom-banner.phtml',
            
//            'frontend/layout/viewQuotation' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/layout/view-quotation.phtml',
//            'error/production' => __DIR__ . '/../view/error/production.phtml',
            'frontend/header' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/layout/header.phtml',
            'frontend/layder-slider' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/layout/layderSlider.phtml',
            'frontend/search' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/layout/search.phtml',
            'frontend/premium' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/layout/premium.phtml',
            'frontend/category' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/layout/category.phtml',
            'frontend/classify' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/layout/classify.phtml',
            'frontend/footer' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/layout/footer.phtml',
            'frontend/template_email' => __DIR__ . '/../view/' . FRONTEND_TEMPLATE . '/layout/template_email.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view/' . FRONTEND_TEMPLATE,
        ),
        'json_exceptions' => $errorHandler,
    ),
);
