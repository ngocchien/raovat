<?php

namespace Frontend\Controller;

use My\Controller\MyController,
    My\General;

class GeneralController extends MyController {

    public function __construct() {
    }

    public function indexAction() {
        $params = $this->params()->fromRoute();
        if(empty($params['id'])){
            return $this->redirect()->toRoute('frontend', array('controller' => 'index', 'action' => 'index'));
        }
        $intGeneralId = (int) $params['id'];
        $serviceGeneral = $this->serviceLocator->get('My\Models\General');
        $arrGeneralDetail  = $serviceGeneral->getDetail(array('gene_id'=>$intGeneralId,'gene_status'=>1));
        if(empty($arrGeneralDetail)){
            return $this->redirect()->toRoute('frontend', array('controller' => 'index', 'action' => 'index'));
        }
        
        return array(
            'params'=>$params,
            'arrGeneralDetail'=>$arrGeneralDetail
        ); 
        
    }

}
