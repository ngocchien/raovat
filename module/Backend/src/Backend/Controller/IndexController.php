<?php

namespace Backend\Controller;

use My\Controller\MyController;

class IndexController extends MyController {

    public function __construct() {
        
    }

    public function indexAction() {
//        $link = 'http://raovatquynhon.com';
        $link = 'http://bidimark.com/home.aspx';
        $content = \My\General::crawler($link);
        
        try {
            $dom = new \Zend\Dom\Query($content);
//            $results = $dom->execute('table#Table2 tr td tr td');
            
            $results = $dom->execute('.tbaLR #inc_main td');
            echo '<pre>';
            print_r(count($results));
            echo '</pre>';
            die();
        } catch (\Exception $ex) {
            echo '<pre>';
            print_r($ex->getMessage());
            echo '</pre>';
            die();
//            return $flag;
        }
        echo '<pre>';
        print_r(count($results));
        echo '</pre>';
        die();

//        $pattern = '#phát thành công#';
        foreach ($results as $item) {
            echo '<pre>';
            print_r($item);
            echo '</pre>';
            die();
            $subject = $item->textContent;

            if (preg_match($pattern, $subject)) {
                $flag = true;
                break;
            }
        }
        echo '<pre>';
        print_r('aaaa');
        echo '</pre>';
        die();

        return $flag;


        $arrCate = [
            'Nhân sự việc làm',
        ];

        $arrProperties = [
            'Tin Rao Vặt', 'Tin Quảng Cáo', 'Tin Dịch Vụ'
        ];

        return;
        $servicePermission = $this->serviceLocator->get('My\Models\Permission');
        $arrData = $servicePermission->getAllResource();
        p($arrData);
        die;

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
        p($arrData);
        die;
        $params = $this->params()->fromRoute();
        return array(
            'params' => $params,
        );
    }

}
