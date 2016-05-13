<?php
echo '<pre>';
print_r('a');
echo '</pre>';
die();
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
                    'route' => '/Gamebank',
                    'defaults' => array(
                        'controller' => 'Gamebank\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'gamebank' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/partner/gamebank/v1[/:controller][/:action][/id/:id][/page/:page][/]',
                    'constraints' => array(
                        'module' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*',
                        'page' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gamebank\Controller',
                        'module' => 'gamebank',
                        'controller' => 'index',
                        'action' => 'index',
                        'id' => 0,
                        'page' => 1
                    ),
                ),
            ),
        ),
    ),
    'module_layouts' => array(
        'Gamebank' => 'gamebank/layout'
    ),
    'translator' => array('locale' => 'en_US'),
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy'
        ),
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
