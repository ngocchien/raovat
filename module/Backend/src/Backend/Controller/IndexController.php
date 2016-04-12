<?php

namespace Backend\Controller;

use My\Controller\MyController;

class IndexController extends MyController {

    public function __construct() {
    }

    public function indexAction() {
        return ;
        $servicePermission = $this->serviceLocator->get('My\Models\Permission');
        $arrData = $servicePermission->getAllResource();
        p($arrData);die;
        
        $dirScanner = new \Zend\Code\Scanner\DirectoryScanner();
//        p(WEB_ROOT.'/module/Backend/');die;
        $dirScanner->addDirectory(WEB_ROOT . '/module/Backend/');
        foreach ($dirScanner->getClasses(true) as $classScanner) {
            list($moduleName, $tmp, $controllerName) = explode('\\', $classScanner->getName());
            $controllerName = str_replace('Controller', '', $controllerName);
            $action = array();
            foreach ($classScanner->getMethods(true) as $method) {
                if (strpos($method->getName(), 'Action')) {
                    $action[] = str_replace('Action', '', $method->getName());
                }
            }
            $arrData[] = array('module' => $moduleName, 'controller' => $controllerName, 'action' => $action);
        }
        p($arrData);die;
        $params = $this->params()->fromRoute();
        return array(
            'params' => $params,
        );
    }

}
