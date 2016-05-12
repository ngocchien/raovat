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

        $link = 'http://www.raovatquynhon.com/raovat/nhan-su-viec-lam/';
//        
//        $html = file_get_html($link);
//        $cate = $html->find('table');
//        echo '<pre>';
//        print_r($cate);
//        echo '</pre>';
//        die();
//// Find all images 
//        foreach ($html->find('img') as $element)
//            echo $element->src . '<br>';
//
//// Find all links 
//        foreach ($html->find('a') as $element)
//            echo $element->href . '<br>';
//        
//        $link = 'http://raovatquynhon.com';
        $content = \My\General::crawler($link);
//        $dom = HtmlDomParser::str_get_html($content);
////        $dom = HtmlDomParser::file_get_html($link);
//
//        echo '<pre>';
//        print_r($dom);
//        echo '</pre>';
//        die();
//        $link = 'http://bidimark.com/home.aspx';


        try {
            $dom = new \Zend\Dom\Query($content);
//            $results = $dom->execute('table#Table2 tr td tr td');
            $results = $dom->execute('table#Table2 tr td tr td');
            echo '<pre>';
            print_r($dom);
            echo '</pre>';
//            die();
            $results = $dom->execute('div');
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
