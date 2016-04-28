<?php

namespace My\Job;

use My\General;

class JobMessages extends JobAbstract {
    /*
     * save Content
     */

    public function writeMessages($params) {
        if ($params->workload()) {
            $arrParams = unserialize($params->workload());
        }

        if (empty($arrParams)) {
            echo General::getColoredString("ERROR: Params is incorrent or empty ", 'light_cyan', 'red');
            return false;
        }

        $id = $arrParams['mess_id'];
        $instanceSearch = new \My\Search\Messages();
        $arrDocument = new \Elastica\Document($id, $arrParams);
        $intResult = $instanceSearch->add($arrDocument);

        if (!$intResult) {
            echo General::getColoredString("ERROR: Cannot add favo ID = {$id} to Search \n", 'light_cyan', 'red');
            return false;
        }

        echo General::getColoredString("Add favo ID: {$id} to Search Success", 'green');

        return true;
    }

    /* edit */

    public function editMessages($params) {

        if ($params->workload()) {
            $arrParams = unserialize($params->workload());
        }

        if (empty($arrParams)) {
            echo General::getColoredString("ERROR: Params is incorrent or empty ", 'light_cyan', 'red');
            return false;
        }

        $id = $arrParams['mess_id'];
        $updateData = new \Elastica\Document();
        $updateData->setData($arrParams);
        $document = new \Elastica\Document($id, $arrParams);
        $document->setUpsert($updateData);

        $instanceSearch = new \My\Search\Messages();
        $resutl = $instanceSearch->edit($document);

        if (!$resutl) {
            echo General::getColoredString("ERROR: Cannot Edit id = {$id} to Search \n", 'light_cyan', 'red');
            return false;
        }

        echo General::getColoredString("Edit id: {$id} to Search Success", 'green');

        return true;
    }

}
