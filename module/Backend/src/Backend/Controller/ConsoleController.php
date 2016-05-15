<?php

namespace Backend\Controller;

use My\General,
    My\Controller\MyController;

class ConsoleController extends MyController {

    public function __construct() {
        if (PHP_SAPI !== 'cli') {
            die('Only use this controller from command line!');
        }
        ini_set('default_socket_timeout', -1);
        ini_set('max_execution_time', -1);
        ini_set('mysql.connect_timeout', -1);
        ini_set('memory_limit', -1);
        ini_set('output_buffering', 0);
        ini_set('zlib.output_compression', 0);
        ini_set('implicit_flush', 1);
    }

    public function indexAction() {
        die();
    }

    private function flush() {
        ob_end_flush();
        ob_flush();
        flush();
    }

    public function migrateAction() {
        $params = $this->request->getParams();
        $intIsCreateIndex = (int) $params['createindex'];

        if (empty($params['type'])) {
            return General::getColoredString("Unknown type \n", 'light_cyan', 'red');
        }

        switch ($params['type']) {
            case 'logs':
                $this->__migrateLogs($intIsCreateIndex);
                break;

            case 'content':
                $this->__migrateContent($intIsCreateIndex);
                break;

            case 'trans-history':
                $this->__migrateTrans($intIsCreateIndex);
                break;

            case 'comment':
                $this->__migrateComment($intIsCreateIndex);
                break;

            case 'favourite':
                $this->__migrateFavourite($intIsCreateIndex);
                break;

            case 'messages':
                $this->__migrateMessages($intIsCreateIndex);
                break;

            case 'district' :
                $this->__migrateDistrict($intIsCreateIndex);
                break;

            case 'category' :
                $this->__migrateCategory($intIsCreateIndex);
                break;

            case 'properties' :
                $this->__migrateProperties($intIsCreateIndex);
                break;

            case 'user' :
                $this->__migrateUser($intIsCreateIndex);
                break;

            case 'district-to-search' :
                $this->__migrateDistrictToSearch($intIsCreateIndex);
                break;

            case 'general' :
                $this->__migrateGeneral($intIsCreateIndex);
                break;

            default:
                echo General::getColoredString("Unknown type \n", 'light_cyan', 'red');
                break;
        }
    }

    public function __migrateGeneral($intIsCreateIndex) {
        $service = $this->serviceLocator->get('My\Models\GeneralBqn');
        $intLimit = 1000;
        $instanceSearch = new \My\Search\GeneralBqn();

        for ($intPage = 1; $intPage < 10000; $intPage ++) {
            $arrList = $service->getListLimit([], $intPage, $intLimit, 'gene_id ASC');

            if (empty($arrList)) {
                break;
            }

            if ($intPage == 1) {
                if ($intIsCreateIndex) {
                    $instanceSearch->createIndex();
                } else {
                    $result = $instanceSearch->removeAllDoc();
                    if (empty($result)) {
                        $this->flush();
                        return General::getColoredString("Cannot delete old search index \n", 'light_cyan', 'red');
                    }
                }
            }
            $arrDocument = [];
            foreach ($arrList as $arr) {
                $id = (int) $arr['gene_id'];

                $arrDocument[] = new \Elastica\Document($id, $arr);
                echo General::getColoredString("Created new document with id = " . $id . " Successfully", 'cyan');

                $this->flush();
            }

            unset($arrList); //release memory
            echo General::getColoredString("Migrating " . count($arrDocument) . " documents, please wait...", 'yellow');
            $this->flush();

            $instanceSearch->add($arrDocument);
            echo General::getColoredString("Migrated " . count($arrDocument) . " documents successfully", 'blue', 'cyan');

            unset($arrDocument);
            $this->flush();
        }

        die('done');
    }

    public function __migrateDistrictToSearch($intIsCreateIndex) {
        $service = $this->serviceLocator->get('My\Models\District');
        $intLimit = 1000;
        $instanceSearch = new \My\Search\District();

        for ($intPage = 1; $intPage < 10000; $intPage ++) {
            $arrList = $service->getListLimit([], $intPage, $intLimit, 'dist_id ASC');

            if (empty($arrList)) {
                break;
            }

            if ($intPage == 1) {
                if ($intIsCreateIndex) {
                    $instanceSearch->createIndex();
                } else {
                    $result = $instanceSearch->removeAllDoc();
                    if (empty($result)) {
                        $this->flush();
                        return General::getColoredString("Cannot delete old search index \n", 'light_cyan', 'red');
                    }
                }
            }
            $arrDocument = [];
            foreach ($arrList as $arr) {
                $id = (int) $arr['dist_id'];

                $arrDocument[] = new \Elastica\Document($id, $arr);
                echo General::getColoredString("Created new document with id = " . $id . " Successfully", 'cyan');

                $this->flush();
            }

            unset($arrList); //release memory
            echo General::getColoredString("Migrating " . count($arrDocument) . " documents, please wait...", 'yellow');
            $this->flush();

            $instanceSearch->add($arrDocument);
            echo General::getColoredString("Migrated " . count($arrDocument) . " documents successfully", 'blue', 'cyan');

            unset($arrDocument);
            $this->flush();
        }

        die('done');
    }

    public function __migrateUser($intIsCreateIndex) {
        $service = $this->serviceLocator->get('My\Models\User');
        $intLimit = 1000;
        $instanceSearch = new \My\Search\User();

        for ($intPage = 1; $intPage < 10000; $intPage ++) {
            $arrList = $service->getListLimit([], $intPage, $intLimit, 'user_id ASC');

            if (empty($arrList)) {
                break;
            }

            if ($intPage == 1) {
                if ($intIsCreateIndex) {
                    $instanceSearch->createIndex();
                } else {
                    $result = $instanceSearch->removeAllDoc();
                    if (empty($result)) {
                        $this->flush();
                        return General::getColoredString("Cannot delete old search index \n", 'light_cyan', 'red');
                    }
                }
            }
            $arrDocument = [];
            foreach ($arrList as $arr) {
                $id = (int) $arr['user_id'];

                $arrDocument[] = new \Elastica\Document($id, $arr);
                echo General::getColoredString("Created new document with id = " . $id . " Successfully", 'cyan');

                $this->flush();
            }

            unset($arrList); //release memory
            echo General::getColoredString("Migrating " . count($arrDocument) . " documents, please wait...", 'yellow');
            $this->flush();

            $instanceSearch->add($arrDocument);
            echo General::getColoredString("Migrated " . count($arrDocument) . " documents successfully", 'blue', 'cyan');

            unset($arrDocument);
            $this->flush();
        }

        die('done');
    }

    public function __migrateProperties($intIsCreateIndex) {
        $service = $this->serviceLocator->get('My\Models\Properties');
        $intLimit = 1000;
        $instanceSearch = new \My\Search\Properties();

        for ($intPage = 1; $intPage < 10000; $intPage ++) {
            $arrList = $service->getListLimit([], $intPage, $intLimit, 'prop_id ASC');

            if (empty($arrList)) {
                break;
            }

            if ($intPage == 1) {
                if ($intIsCreateIndex) {
                    $instanceSearch->createIndex();
                } else {
                    $result = $instanceSearch->removeAllDoc();
                    if (empty($result)) {
                        $this->flush();
                        return General::getColoredString("Cannot delete old search index \n", 'light_cyan', 'red');
                    }
                }
            }
            $arrDocument = [];
            foreach ($arrList as $arr) {
                $id = (int) $arr['prop_id'];

                $arrDocument[] = new \Elastica\Document($id, $arr);
                echo General::getColoredString("Created new document with id = " . $id . " Successfully", 'cyan');

                $this->flush();
            }

            unset($arrList); //release memory
            echo General::getColoredString("Migrating " . count($arrDocument) . " documents, please wait...", 'yellow');
            $this->flush();

            $instanceSearch->add($arrDocument);
            echo General::getColoredString("Migrated " . count($arrDocument) . " documents successfully", 'blue', 'cyan');

            unset($arrDocument);
            $this->flush();
        }

        die('done');
    }

    public function __migrateCategory($intIsCreateIndex) {
        $service = $this->serviceLocator->get('My\Models\Category');
        $intLimit = 1000;
        $instanceSearch = new \My\Search\Category();

        for ($intPage = 1; $intPage < 10000; $intPage ++) {
            $arrList = $service->getListLimit([], $intPage, $intLimit, 'cate_id ASC');

            if (empty($arrList)) {
                break;
            }

            if ($intPage == 1) {
                if ($intIsCreateIndex) {
                    $instanceSearch->createIndex();
                } else {
                    $result = $instanceSearch->removeAllDoc();
                    if (empty($result)) {
                        $this->flush();
                        return General::getColoredString("Cannot delete old search index \n", 'light_cyan', 'red');
                    }
                }
            }
            $arrDocument = [];
            foreach ($arrList as $arr) {
                $id = (int) $arr['cate_id'];

                $arrDocument[] = new \Elastica\Document($id, $arr);
                echo General::getColoredString("Created new document with id = " . $id . " Successfully", 'cyan');

                $this->flush();
            }

            unset($arrList); //release memory
            echo General::getColoredString("Migrating " . count($arrDocument) . " documents, please wait...", 'yellow');
            $this->flush();

            $instanceSearch->add($arrDocument);
            echo General::getColoredString("Migrated " . count($arrDocument) . " documents successfully", 'blue', 'cyan');

            unset($arrDocument);
            $this->flush();
        }

        die('done');
    }

    //$arr = [
//	'TP Qui Nhơn','Huyện Vân Canh','Huyện Tuy Phước','Huyện Tây Sơn','Huyện Phù Mỹ','Huyện Phù Cát','Huyện Hoài Nhơn','Huyện Hoài Ân','Huyện An Nhơn','Huyện An Lão','Huyện Vĩnh Thạnh'
//];

    public function __migrateDistrict($intIsCreateIndex) {
        $arr = [
            'TP Qui Nhơn', 'Huyện Vân Canh', 'Huyện Tuy Phước', 'Huyện Tây Sơn', 'Huyện Phù Mỹ', 'Huyện Phù Cát', 'Huyện Hoài Nhơn', 'Huyện Hoài Ân', 'Huyện An Nhơn', 'Huyện An Lão', 'Huyện Vĩnh Thạnh'
        ];
        $service = $this->serviceLocator->get('My\Models\District');
        foreach ($arr as $name) {
            $arrData = [
                'dist_name' => $name,
                'dist_slug' => General::getSlug($name),
                'created_date' => time(),
                'dist_status' => 1,
                'user_created' => 1
            ];
            $service->add($arrData);
        }
        die('done');
    }

    public function __migrateMessages($intIsCreateIndex) {
        $service = $this->serviceLocator->get('My\Models\Messages');
        $intLimit = 1000;
        $instanceSearch = new \My\Search\Messages();

        for ($intPage = 1; $intPage < 10000; $intPage ++) {
            $arrList = $service->getListLimit([], $intPage, $intLimit, 'mess_id ASC');

            if (empty($arrList)) {
                break;
            }

            if ($intPage == 1) {
                if ($intIsCreateIndex) {
                    $instanceSearch->createIndex();
                } else {
                    $result = $instanceSearch->removeAllDoc();
                    if (empty($result)) {
                        $this->flush();
                        return General::getColoredString("Cannot delete old search index \n", 'light_cyan', 'red');
                    }
                }
            }
            $arrDocument = [];
            foreach ($arrList as $arr) {
                $id = (int) $arr['mess_id'];

                $arrDocument[] = new \Elastica\Document($id, $arr);
                echo General::getColoredString("Created new document with id = " . $id . " Successfully", 'cyan');

                $this->flush();
            }

            unset($arrList); //release memory
            echo General::getColoredString("Migrating " . count($arrDocument) . " documents, please wait...", 'yellow');
            $this->flush();

            $instanceSearch->add($arrDocument);
            echo General::getColoredString("Migrated " . count($arrDocument) . " documents successfully", 'blue', 'cyan');

            unset($arrDocument);
            $this->flush();
        }

        die('done');
    }

    public function __migrateFavourite($intIsCreateIndex) {
        $service = $this->serviceLocator->get('My\Models\Favourite');
        $intLimit = 1000;
        $instanceSearch = new \My\Search\Favourite();
        for ($intPage = 1; $intPage < 10000; $intPage ++) {
            $arrList = $service->getListLimit([], $intPage, $intLimit, 'favo_id ASC');

            if (empty($arrList)) {
                break;
            }

            if ($intPage == 1) {
                if ($intIsCreateIndex) {
                    $instanceSearch->createIndex();
                } else {
                    $result = $instanceSearch->removeAllDoc();
                    if (empty($result)) {
                        $this->flush();
                        return General::getColoredString("Cannot delete old search index \n", 'light_cyan', 'red');
                    }
                }
            }
            $arrDocument = [];
            foreach ($arrList as $arr) {
                $id = (int) $arr['favo_id'];

                $arrDocument[] = new \Elastica\Document($id, $arr);
                echo General::getColoredString("Created new document with id = " . $id . " Successfully", 'cyan');

                $this->flush();
            }

            unset($arrList); //release memory
            echo General::getColoredString("Migrating " . count($arrDocument) . " documents, please wait...", 'yellow');
            $this->flush();

            $instanceSearch->add($arrDocument);
            echo General::getColoredString("Migrated " . count($arrDocument) . " documents successfully", 'blue', 'cyan');

            unset($arrDocument);
            $this->flush();
        }

        die('done');
    }

    public function __migrateComment($intIsCreateIndex) {
        $service = $this->serviceLocator->get('My\Models\Comment');
        $intLimit = 1000;
        $instanceSearch = new \My\Search\Comment();
        for ($intPage = 1; $intPage < 10000; $intPage ++) {
            $arrList = $service->getListLimit([], $intPage, $intLimit, 'comm_id ASC');

            if (empty($arrList)) {
                break;
            }

            if ($intPage == 1) {
                if ($intIsCreateIndex) {
                    $instanceSearch->createIndex();
                } else {
                    $result = $instanceSearch->removeAllDoc();
                    if (empty($result)) {
                        $this->flush();
                        return General::getColoredString("Cannot delete old search index \n", 'light_cyan', 'red');
                    }
                }
            }
            $arrDocument = [];
            foreach ($arrList as $arr) {
                $id = (int) $arr['comm_id'];

                $arrDocument[] = new \Elastica\Document($id, $arr);
                echo General::getColoredString("Created new document with id = " . $id . " Successfully", 'cyan');

                $this->flush();
            }

            unset($arrList); //release memory
            echo General::getColoredString("Migrating " . count($arrDocument) . " documents, please wait...", 'yellow');
            $this->flush();

            $instanceSearch->add($arrDocument);
            echo General::getColoredString("Migrated " . count($arrDocument) . " documents successfully", 'blue', 'cyan');

            unset($arrDocument);
            $this->flush();
        }

        die('done');
    }

    public function __migrateLogs($intIsCreateIndex) {
        $serviceLogs = $this->serviceLocator->get('My\Models\Logs');
        $intLimit = 1000;
        $instanceSearchLogs = new \My\Search\Logs();
        for ($intPage = 1; $intPage < 10000; $intPage ++) {
            $arrLogsList = $serviceLogs->getListLimit([], $intPage, $intLimit, 'log_id ASC');
            if (empty($arrLogsList)) {
                break;
            }

            if ($intPage == 1) {
                if ($intIsCreateIndex) {
                    $instanceSearchLogs->createIndex();
                } else {
                    $result = $instanceSearchLogs->removeAllDoc();
                    if (empty($result)) {
                        $this->flush();
                        return General::getColoredString("Cannot delete old search index \n", 'light_cyan', 'red');
                    }
                }
            }
            $arrDocument = [];
            foreach ($arrLogsList as $arrLogs) {
                $logId = (int) $arrLogs['log_id'];

                $arrDocument[] = new \Elastica\Document($logId, $arrLogs);
                echo General::getColoredString("Created new document with log_id = " . $logId . " Successfully", 'cyan');

                $this->flush();
            }

            unset($arrLogsList); //release memory
            echo General::getColoredString("Migrating " . count($arrDocument) . " documents, please wait...", 'yellow');
            $this->flush();

            $instanceSearchLogs->add($arrDocument);
            echo General::getColoredString("Migrated " . count($arrDocument) . " documents successfully", 'blue', 'cyan');

            unset($arrDocument);
            $this->flush();
        }

        die('done');
    }

    public function __migrateContent($intIsCreateIndex) {
        $serviceContent = $this->serviceLocator->get('My\Models\Content');
        $intLimit = 1000;
        $instanceSearchContent = new \My\Search\Content();

        for ($intPage = 1; $intPage < 10000; $intPage ++) {
            $arrContentList = $serviceContent->getListLimit([], $intPage, $intLimit, 'cont_id ASC');
            if (empty($arrContentList)) {
                break;
            }

            if ($intPage == 1) {
                if ($intIsCreateIndex) {
                    $instanceSearchContent->createIndex();
                } else {
                    $result = $instanceSearchContent->removeAllDoc();
                    if (empty($result)) {
                        $this->flush();
                        return General::getColoredString("Cannot delete old search index \n", 'light_cyan', 'red');
                    }
                }
            }
            $arrDocument = [];
            foreach ($arrContentList as $arrContent) {
                $id = (int) $arrContent['cont_id'];

                $arrDocument[] = new \Elastica\Document($id, $arrContent);
                echo General::getColoredString("Created new document with cont_id = " . $id . " Successfully", 'cyan');

                $this->flush();
            }

            unset($arrContentList); //release memory
            echo General::getColoredString("Migrating " . count($arrDocument) . " documents, please wait...", 'yellow');
            $this->flush();

            $instanceSearchContent->add($arrDocument);
            echo General::getColoredString("Migrated " . count($arrDocument) . " documents successfully", 'blue', 'cyan');

            unset($arrDocument);
            $this->flush();
        }

        die('done');
    }

    public function __migrateTrans($intIsCreateIndex) {
        $service = $this->serviceLocator->get('My\Models\TransactionHistory');
        $intLimit = 1000;
        $instanceSearch = new \My\Search\TransactionHistory();
        for ($intPage = 1; $intPage < 10000; $intPage ++) {
            $arrListLimit = $service->getListLimit([], $intPage, $intLimit, 'tran_id ASC');
            if (empty($arrListLimit)) {
                break;
            }

            if ($intPage == 1) {
                if ($intIsCreateIndex) {
                    $instanceSearch->createIndex();
                } else {
                    $result = $instanceSearch->removeAllDoc();
                    if (empty($result)) {
                        $this->flush();
                        return General::getColoredString("Cannot delete old search index \n", 'light_cyan', 'red');
                    }
                }
            }
            $arrDocument = [];
            foreach ($arrListLimit as $value) {
                $id = (int) $value['tran_id'];

                $arrDocument[] = new \Elastica\Document($id, $value);
                echo General::getColoredString("Created new document with tran_id = " . $id . " Successfully", 'cyan');

                $this->flush();
            }

            unset($arrListLimit); //release memory
            echo General::getColoredString("Migrating " . count($arrDocument) . " documents, please wait...", 'yellow');
            $this->flush();

            $instanceSearch->add($arrDocument);
            echo General::getColoredString("Migrated " . count($arrDocument) . " documents successfully", 'blue', 'cyan');

            unset($arrDocument);
            $this->flush();
        }

        die('done');
    }

    public function workerAction() {
        $params = $this->request->getParams();

        //stop all job
        if ($params['stop'] === 'all') {
            if ($params['type'] || $params['background']) {
                return General::getColoredString("Invalid params \n", 'light_cyan', 'red');
            }
            exec("ps -ef | grep -v grep | grep 'type=proship-*' | awk '{ print $2 }'", $PID);

            if (empty($PID)) {
                return General::getColoredString("Cannot found PID \n", 'light_cyan', 'red');
            }

            foreach ($PID as $worker) {
                shell_exec("kill " . $worker);
                echo General::getColoredString("Kill worker with PID = {$worker} stopped running in backgound \n", 'green');
            }

            return true;
        }

        //stop job sendmail
        if ($params['stop'] === 'raovat-logs') {
            if ($params['type'] || $params['background']) {
                return General::getColoredString("Invalid params \n", 'light_cyan', 'red');
            }
            exec("ps -ef | grep -v grep | grep 'type=raovat-logs' | awk '{ print $2 }'", $PID);
            $PID = current($PID);
            if ($PID) {
                shell_exec("kill " . $PID);
                echo General::getColoredString("Job raovat-logs is stopped running in backgound \n", 'green');
                return;
            } else {
                echo General::getColoredString("Cannot found PID \n", 'light_cyan', 'red');
                return;
            }
        }

        //stop job sendmail
        if ($params['stop'] === 'raovat-content') {
            if ($params['type'] || $params['background']) {
                return General::getColoredString("Invalid params \n", 'light_cyan', 'red');
            }
            exec("ps -ef | grep -v grep | grep 'type=raovat-content' | awk '{ print $2 }'", $PID);
            $PID = current($PID);
            if ($PID) {
                shell_exec("kill " . $PID);
                echo General::getColoredString("Job raovat-content is stopped running in backgound \n", 'green');
                return;
            } else {
                echo General::getColoredString("Cannot found PID \n", 'light_cyan', 'red');
                return;
            }
        }

        //stop job sendmail
        if ($params['stop'] === 'raovat-tran') {
            if ($params['type'] || $params['background']) {
                return General::getColoredString("Invalid params \n", 'light_cyan', 'red');
            }
            exec("ps -ef | grep -v grep | grep 'type=raovat-tran' | awk '{ print $2 }'", $PID);
            $PID = current($PID);
            if ($PID) {
                shell_exec("kill " . $PID);
                echo General::getColoredString("Job raovat-tran is stopped running in backgound \n", 'green');
                return;
            } else {
                echo General::getColoredString("Cannot found PID \n", 'light_cyan', 'red');
                return;
            }
        }

        //stop job comment
        if ($params['stop'] === 'raovat-comment') {
            if ($params['type'] || $params['background']) {
                return General::getColoredString("Invalid params \n", 'light_cyan', 'red');
            }
            exec("ps -ef | grep -v grep | grep 'type=raovat-comment' | awk '{ print $2 }'", $PID);
            $PID = current($PID);
            if ($PID) {
                shell_exec("kill " . $PID);
                echo General::getColoredString("Job raovat-comment is stopped running in backgound \n", 'green');
                return;
            } else {
                echo General::getColoredString("Cannot found PID \n", 'light_cyan', 'red');
                return;
            }
        }

        //stop job Favourite
        if ($params['stop'] === 'raovat-favourite') {
            if ($params['type'] || $params['background']) {
                return General::getColoredString("Invalid params \n", 'light_cyan', 'red');
            }
            exec("ps -ef | grep -v grep | grep 'type=raovat-favourite' | awk '{ print $2 }'", $PID);
            $PID = current($PID);
            if ($PID) {
                shell_exec("kill " . $PID);
                echo General::getColoredString("Job raovat-favourite is stopped running in backgound \n", 'green');
                return;
            } else {
                echo General::getColoredString("Cannot found PID \n", 'light_cyan', 'red');
                return;
            }
        }

        //stop job Messages
        if ($params['stop'] === 'raovat-messages') {

            if ($params['type'] || $params['background']) {
                return General::getColoredString("Invalid params \n", 'light_cyan', 'red');
            }

            exec("ps -ef | grep -v grep | grep 'type=raovat-messages' | awk '{ print $2 }'", $PID);

            $PID = current($PID);
            if ($PID) {
                shell_exec("kill " . $PID);
                echo General::getColoredString("Job raovat-messages is stopped running in backgound \n", 'green');
                return;
            } else {
                echo General::getColoredString("Cannot found PID \n", 'light_cyan', 'red');
                return;
            }
        }

        //stop job Messages
        if ($params['stop'] === 'raovat-mail') {
            if ($params['type'] || $params['background']) {
                return General::getColoredString("Invalid params \n", 'light_cyan', 'red');
            }
            exec("ps -ef | grep -v grep | grep 'type=raovat-mail' | awk '{ print $2 }'", $PID);
            $PID = current($PID);
            if ($PID) {
                shell_exec("kill " . $PID);
                echo General::getColoredString("Job raovat-mail is stopped running in backgound \n", 'green');
                return;
            } else {
                echo General::getColoredString("Cannot found PID \n", 'light_cyan', 'red');
                return;
            }
        }

        //stop job Messages
        if ($params['stop'] === 'raovat-category') {
            if ($params['type'] || $params['background']) {
                return General::getColoredString("Invalid params \n", 'light_cyan', 'red');
            }
            exec("ps -ef | grep -v grep | grep 'type=raovat-category' | awk '{ print $2 }'", $PID);
            $PID = current($PID);
            if ($PID) {
                shell_exec("kill " . $PID);
                echo General::getColoredString("Job raovat-category is stopped running in backgound \n", 'green');
                return;
            } else {
                echo General::getColoredString("Cannot found PID \n", 'light_cyan', 'red');
                return;
            }
        }

        //stop job Messages
        if ($params['stop'] === 'raovat-properties') {
            if ($params['type'] || $params['background']) {
                return General::getColoredString("Invalid params \n", 'light_cyan', 'red');
            }
            exec("ps -ef | grep -v grep | grep 'type=raovat-properties' | awk '{ print $2 }'", $PID);
            $PID = current($PID);
            if ($PID) {
                shell_exec("kill " . $PID);
                echo General::getColoredString("Job raovat-properties is stopped running in backgound \n", 'green');
                return;
            } else {
                echo General::getColoredString("Cannot found PID \n", 'light_cyan', 'red');
                return;
            }
        }

        //stop job Messages
        if ($params['stop'] === 'raovat-user') {
            if ($params['type'] || $params['background']) {
                return General::getColoredString("Invalid params \n", 'light_cyan', 'red');
            }
            exec("ps -ef | grep -v grep | grep 'type=raovat-user' | awk '{ print $2 }'", $PID);
            $PID = current($PID);
            if ($PID) {
                shell_exec("kill " . $PID);
                echo General::getColoredString("Job raovat-user is stopped running in backgound \n", 'green');
                return;
            } else {
                echo General::getColoredString("Cannot found PID \n", 'light_cyan', 'red');
                return;
            }
        }

        //stop job general
        if ($params['stop'] === 'raovat-general') {
            if ($params['type'] || $params['background']) {
                return General::getColoredString("Invalid params \n", 'light_cyan', 'red');
            }
            exec("ps -ef | grep -v grep | grep 'type=raovat-general' | awk '{ print $2 }'", $PID);
            $PID = current($PID);
            if ($PID) {
                shell_exec("kill " . $PID);
                echo General::getColoredString("Job raovat-general is stopped running in backgound \n", 'green');
                return;
            } else {
                echo General::getColoredString("Cannot found PID \n", 'light_cyan', 'red');
                return;
            }
        }

        $worker = General::getWorkerConfig();
        //  die($params['type']);
        switch ($params['type']) {
            case 'raovat-logs':
                //start job in background
                if ($params['background'] === 'true') {
                    $PID = shell_exec("nohup php " . PUBLIC_PATH . "/index.php worker --type=raovat-logs >/dev/null & echo 2>&1 & echo $!");
                    if (empty($PID)) {
                        echo General::getColoredString("Cannot deamon PHP process to run job raovat-logs in background. \n", 'light_cyan', 'red');
                        return;
                    }
                    echo General::getColoredString("Job raovat-logs is running in background ... \n", 'green');
                }

                $funcName1 = SEARCH_PREFIX . 'writeLog';
                $methodHandler1 = '\My\Job\JobLog::writeLog';
                $worker->addFunction($funcName1, $methodHandler1, $this->serviceLocator);

                break;

            case 'raovat-content':
                //start job in background
                if ($params['background'] === 'true') {
                    $PID = shell_exec("nohup php " . PUBLIC_PATH . "/index.php worker --type=raovat-content >/dev/null & echo 2>&1 & echo $!");
                    if (empty($PID)) {
                        echo General::getColoredString("Cannot deamon PHP process to run job raovat-content in background. \n", 'light_cyan', 'red');
                        return;
                    }
                    echo General::getColoredString("Job raovat-content is running in background ... \n", 'green');
                }

                $funcName1 = SEARCH_PREFIX . 'writeContent';
                $methodHandler1 = '\My\Job\JobContent::writeContent';
                $worker->addFunction($funcName1, $methodHandler1, $this->serviceLocator);

                $funcName2 = SEARCH_PREFIX . 'editContent';
                $methodHandler2 = '\My\Job\JobContent::editContent';
                $worker->addFunction($funcName2, $methodHandler2, $this->serviceLocator);

                $funcName3 = SEARCH_PREFIX . 'multiEditContent';
                $methodHandler3 = '\My\Job\JobContent::multiEditContent';
                $worker->addFunction($funcName3, $methodHandler3, $this->serviceLocator);

                break;
            case 'raovat-tran':
                //start job in background
                if ($params['background'] === 'true') {
                    $PID = shell_exec("nohup php " . PUBLIC_PATH . "/index.php worker --type=raovat-tran >/dev/null & echo 2>&1 & echo $!");
                    if (empty($PID)) {
                        echo General::getColoredString("Cannot deamon PHP process to run job raovat-tran in background. \n", 'light_cyan', 'red');
                        return;
                    }
                    echo General::getColoredString("Job raovat-tran is running in background ... \n", 'green');
                }

                $funcName1 = SEARCH_PREFIX . 'writeTran';
                $methodHandler1 = '\My\Job\JobTransactionHistory::writeTran';
                $worker->addFunction($funcName1, $methodHandler1, $this->serviceLocator);

                break;

            case 'raovat-comment':
                //start job in background
                if ($params['background'] === 'true') {
                    $PID = shell_exec("nohup php " . PUBLIC_PATH . "/index.php worker --type=raovat-comment >/dev/null & echo 2>&1 & echo $!");
                    if (empty($PID)) {
                        echo General::getColoredString("Cannot deamon PHP process to run job raovat-comment in background. \n", 'light_cyan', 'red');
                        return;
                    }
                    echo General::getColoredString("Job raovat-comment is running in background ... \n", 'green');
                }

                $funcName1 = SEARCH_PREFIX . 'writeComment';
                $methodHandler1 = '\My\Job\JobComment::writeComment';
                $worker->addFunction($funcName1, $methodHandler1, $this->serviceLocator);

                $funcName2 = SEARCH_PREFIX . 'editComment';
                $methodHandler2 = '\My\Job\JobComment::editComment';
                $worker->addFunction($funcName2, $methodHandler2, $this->serviceLocator);

                break;

            case 'raovat-favourite':
                //start job in background
                if ($params['background'] === 'true') {
                    $PID = shell_exec("nohup php " . PUBLIC_PATH . "/index.php worker --type=raovat-favourite >/dev/null & echo 2>&1 & echo $!");
                    if (empty($PID)) {
                        echo General::getColoredString("Cannot deamon PHP process to run job raovat-favourite in background. \n", 'light_cyan', 'red');
                        return;
                    }
                    echo General::getColoredString("Job raovat-favourite is running in background ... \n", 'green');
                }

                $funcName1 = SEARCH_PREFIX . 'writeFavourite';
                $methodHandler1 = '\My\Job\JobFavourite::writeFavourite';
                $worker->addFunction($funcName1, $methodHandler1, $this->serviceLocator);

                $funcName2 = SEARCH_PREFIX . 'editFavourite';
                $methodHandler2 = '\My\Job\JobFavourite::editFavourite';
                $worker->addFunction($funcName2, $methodHandler2, $this->serviceLocator);

                $funcName3 = SEARCH_PREFIX . 'multiEditFavourite';
                $methodHandler3 = '\My\Job\JobFavourite::multiEditFavourite';
                $worker->addFunction($funcName3, $methodHandler3, $this->serviceLocator);

                break;

            case 'raovat-messages':
                //start job in background
                if ($params['background'] === 'true') {
                    $PID = shell_exec("nohup php " . PUBLIC_PATH . "/index.php worker --type=raovat-messages >/dev/null & echo 2>&1 & echo $!");
                    if (empty($PID)) {
                        echo General::getColoredString("Cannot deamon PHP process to run job raovat-messages in background. \n", 'light_cyan', 'red');
                        return;
                    }
                    echo General::getColoredString("Job raovat-messages is running in background ... \n", 'green');
                }

                $funcName1 = SEARCH_PREFIX . 'writeMessages';
                $methodHandler1 = '\My\Job\JobMessages::writeMessages';
                $worker->addFunction($funcName1, $methodHandler1, $this->serviceLocator);

                $funcName2 = SEARCH_PREFIX . 'editMessages';
                $methodHandler2 = '\My\Job\JobMessages::editMessages';
                $worker->addFunction($funcName2, $methodHandler2, $this->serviceLocator);

                $funcName3 = SEARCH_PREFIX . 'multiEditMessages';
                $methodHandler3 = '\My\Job\JobMessages::multiEditMessages';
                $worker->addFunction($funcName3, $methodHandler3, $this->serviceLocator);

                break;

            case 'raovat-mail':
                //start job in background
                if ($params['background'] === 'true') {
                    $PID = shell_exec("nohup php " . PUBLIC_PATH . "/index.php worker --type=raovat-mail >/dev/null & echo 2>&1 & echo $!");
                    if (empty($PID)) {
                        echo General::getColoredString("Cannot deamon PHP process to run job raovat-mail in background. \n", 'light_cyan', 'red');
                        return;
                    }
                    echo General::getColoredString("Job raovat-mail is running in background ... \n", 'green');
                }

                $funcName1 = SEARCH_PREFIX . 'sendMail';
                $methodHandler1 = '\My\Job\JobMail::sendMail';
                $worker->addFunction($funcName1, $methodHandler1, $this->serviceLocator);

                break;

            case 'raovat-category':
                //start job in background
                if ($params['background'] === 'true') {
                    $PID = shell_exec("nohup php " . PUBLIC_PATH . "/index.php worker --type=raovat-category >/dev/null & echo 2>&1 & echo $!");
                    if (empty($PID)) {
                        echo General::getColoredString("Cannot deamon PHP process to run job raovat-category in background. \n", 'light_cyan', 'red');
                        return;
                    }
                    echo General::getColoredString("Job raovat-category is running in background ... \n", 'green');
                }

                $funcName1 = SEARCH_PREFIX . 'writeCategory';
                $methodHandler1 = '\My\Job\JobCategory::writeCategory';
                $worker->addFunction($funcName1, $methodHandler1, $this->serviceLocator);

                $funcName2 = SEARCH_PREFIX . 'editCategory';
                $methodHandler2 = '\My\Job\JobCategory::editCategory';
                $worker->addFunction($funcName2, $methodHandler2, $this->serviceLocator);

                $funcName3 = SEARCH_PREFIX . 'multiEditCategory';
                $methodHandler3 = '\My\Job\JobCategory::multiEditCategory';
                $worker->addFunction($funcName3, $methodHandler3, $this->serviceLocator);

                break;

            case 'raovat-properties':
                //start job in background
                if ($params['background'] === 'true') {
                    $PID = shell_exec("nohup php " . PUBLIC_PATH . "/index.php worker --type=raovat-properties >/dev/null & echo 2>&1 & echo $!");
                    if (empty($PID)) {
                        echo General::getColoredString("Cannot deamon PHP process to run job raovat-properties in background. \n", 'light_cyan', 'red');
                        return;
                    }
                    echo General::getColoredString("Job raovat-properties is running in background ... \n", 'green');
                }

                $funcName1 = SEARCH_PREFIX . 'writeProperties';
                $methodHandler1 = '\My\Job\JobProperties::writeProperties';
                $worker->addFunction($funcName1, $methodHandler1, $this->serviceLocator);

                $funcName2 = SEARCH_PREFIX . 'editProperties';
                $methodHandler2 = '\My\Job\JobProperties::editProperties';
                $worker->addFunction($funcName2, $methodHandler2, $this->serviceLocator);

                $funcName3 = SEARCH_PREFIX . 'multiEditProperties';
                $methodHandler3 = '\My\Job\JobProperties::multiEditProperties';
                $worker->addFunction($funcName3, $methodHandler3, $this->serviceLocator);

                break;

            case 'raovat-user':
                //start job in background
                if ($params['background'] === 'true') {
                    $PID = shell_exec("nohup php " . PUBLIC_PATH . "/index.php worker --type=raovat-user >/dev/null & echo 2>&1 & echo $!");
                    if (empty($PID)) {
                        echo General::getColoredString("Cannot deamon PHP process to run job raovat-user in background. \n", 'light_cyan', 'red');
                        return;
                    }
                    echo General::getColoredString("Job raovat-user is running in background ... \n", 'green');
                }

                $funcName1 = SEARCH_PREFIX . 'writeUser';
                $methodHandler1 = '\My\Job\JobUser::writeUser';
                $worker->addFunction($funcName1, $methodHandler1, $this->serviceLocator);

                $funcName2 = SEARCH_PREFIX . 'editUser';
                $methodHandler2 = '\My\Job\JobUser::editUser';
                $worker->addFunction($funcName2, $methodHandler2, $this->serviceLocator);

                $funcName3 = SEARCH_PREFIX . 'multiEditUser';
                $methodHandler3 = '\My\Job\JobUser::multiEditUser';
                $worker->addFunction($funcName3, $methodHandler3, $this->serviceLocator);

                break;

            case 'raovat-general':
                //start job in background
                if ($params['background'] === 'true') {
                    $PID = shell_exec("nohup php " . PUBLIC_PATH . "/index.php worker --type=raovat-general >/dev/null & echo 2>&1 & echo $!");
                    if (empty($PID)) {
                        echo General::getColoredString("Cannot deamon PHP process to run job raovat-general in background. \n", 'light_cyan', 'red');
                        return;
                    }
                    echo General::getColoredString("Job raovat-general is running in background ... \n", 'green');
                }

                $funcName1 = SEARCH_PREFIX . 'writeGeneral';
                $methodHandler1 = '\My\Job\JobGeneral::writeGeneral';
                $worker->addFunction($funcName1, $methodHandler1, $this->serviceLocator);

                $funcName2 = SEARCH_PREFIX . 'editGeneral';
                $methodHandler2 = '\My\Job\JobGeneral::editGeneral';
                $worker->addFunction($funcName2, $methodHandler2, $this->serviceLocator);

                break;

            default:
                return General::getColoredString("Invalid or not found function \n", 'light_cyan', 'red');
        }

        if (empty($params['background'])) {
            echo General::getColoredString("Waiting for job...\n", 'green');
        } else {
            return;
        }
        $this->flush();
        while (@$worker->work() || ($worker->returnCode() == GEARMAN_IO_WAIT) || ($worker->returnCode() == GEARMAN_NO_JOBS)) {
            if ($worker->returnCode() != GEARMAN_SUCCESS) {
                echo "return_code: " . $worker->returnCode() . "\n";
                break;
            }
        }
    }

    public function checkWorkerRunningAction() {

        //check content worker
        exec("ps -ef | grep -v grep | grep 'type=raovat-content' | awk '{ print $2 }'", $PID);
        $PID = current($PID);
        if (empty($PID)) {
            $command = shell_exec("nohup php " . PUBLIC_PATH . "/index.php worker --type=raovat-content >/dev/null & echo 2>&1 & echo $!");
            $PID = shell_exec($command);
            if (empty($PID)) {
                echo General::getColoredString("Cannot deamon PHP process to run job raovat-content in background. \n", 'light_cyan', 'red');
                return;
            } else {
                echo General::getColoredString("PHP process run job raovat-content in background with PID : {$PID}. \n", 'light_cyan', 'red');
            }
        }

        //check send-mail worker
        exec("ps -ef | grep -v grep | grep 'type=raovat-logs' | awk '{ print $2 }'", $PID);
        $PID = current($PID);
        if (empty($PID)) {
            $PID = shell_exec("nohup php " . PUBLIC_PATH . "/index.php worker --type=raovat-logs >/dev/null & echo 2>&1 & echo $!");
            if (empty($PID)) {
                echo General::getColoredString("Cannot deamon PHP process to run job raovat-logs in background. \n", 'light_cyan', 'red');
                return;
            }
        }

        //check tran worker
        exec("ps -ef | grep -v grep | grep 'type=raovat-tran' | awk '{ print $2 }'", $PID);
        $PID = current($PID);
        if (empty($PID)) {
            $PID = shell_exec("nohup php " . PUBLIC_PATH . "/index.php worker --type=raovat-tran >/dev/null & echo 2>&1 & echo $!");
            if (empty($PID)) {
                echo General::getColoredString("Cannot deamon PHP process to run job raovat-tran in background. \n", 'light_cyan', 'red');
                return;
            }
        }

        //check tran worker
        exec("ps -ef | grep -v grep | grep 'type=raovat-comment' | awk '{ print $2 }'", $PID);
        $PID = current($PID);
        if (empty($PID)) {
            $PID = shell_exec("nohup php " . PUBLIC_PATH . "/index.php worker --type=raovat-comment >/dev/null & echo 2>&1 & echo $!");
            if (empty($PID)) {
                echo General::getColoredString("Cannot deamon PHP process to run job raovat-comment in background. \n", 'light_cyan', 'red');
                return;
            }
        }


        //check tran worker
        exec("ps -ef | grep -v grep | grep 'type=raovat-favourite' | awk '{ print $2 }'", $PID);
        $PID = current($PID);
        if (empty($PID)) {
            $PID = shell_exec("nohup php " . PUBLIC_PATH . "/index.php worker --type=raovat-favourite >/dev/null & echo 2>&1 & echo $!");
            if (empty($PID)) {
                echo General::getColoredString("Cannot deamon PHP process to run job raovat-favourite in background. \n", 'light_cyan', 'red');
                return;
            }
        }

        //check tran worker
        exec("ps -ef | grep -v grep | grep 'type=raovat-messages' | awk '{ print $2 }'", $PID);
        $PID = current($PID);
        if (empty($PID)) {
            $PID = shell_exec("nohup php " . PUBLIC_PATH . "/index.php worker --type=raovat-messages >/dev/null & echo 2>&1 & echo $!");
            if (empty($PID)) {
                echo General::getColoredString("Cannot deamon PHP process to run job raovat-messages in background. \n", 'light_cyan', 'red');
                return;
            }
        }

        //check job mail worker
        exec("ps -ef | grep -v grep | grep 'type=raovat-mail' | awk '{ print $2 }'", $PID);
        $PID = current($PID);
        if (empty($PID)) {
            $command = shell_exec("nohup php " . PUBLIC_PATH . "/index.php worker --type=raovat-mail >/dev/null & echo 2>&1 & echo $!");
            $PID = shell_exec($command);
            if (empty($PID)) {
                echo General::getColoredString("Cannot deamon PHP process to run job raovat-mail in background. \n", 'light_cyan', 'red');
                return;
            } else {
                echo General::getColoredString("PHP process run job raovat-mail in background with PID : {$PID}. \n", 'light_cyan', 'red');
            }
        }

        //check job mail worker
        exec("ps -ef | grep -v grep | grep 'type=raovat-category' | awk '{ print $2 }'", $PID);
        $PID = current($PID);
        if (empty($PID)) {
            $command = shell_exec("nohup php " . PUBLIC_PATH . "/index.php worker --type=raovat-category >/dev/null & echo 2>&1 & echo $!");
            $PID = shell_exec($command);
            if (empty($PID)) {
                echo General::getColoredString("Cannot deamon PHP process to run job raovat-category in background. \n", 'light_cyan', 'red');
                return;
            } else {
                echo General::getColoredString("PHP process run job raovat-category in background with PID : {$PID}. \n", 'light_cyan', 'red');
            }
        }

        //check job mail worker
        exec("ps -ef | grep -v grep | grep 'type=raovat-properties' | awk '{ print $2 }'", $PID);
        $PID = current($PID);
        if (empty($PID)) {
            $command = shell_exec("nohup php " . PUBLIC_PATH . "/index.php worker --type=raovat-properties >/dev/null & echo 2>&1 & echo $!");
            $PID = shell_exec($command);
            if (empty($PID)) {
                echo General::getColoredString("Cannot deamon PHP process to run job raovat-properties in background. \n", 'light_cyan', 'red');
                return;
            } else {
                echo General::getColoredString("PHP process run job raovat-properties in background with PID : {$PID}. \n", 'light_cyan', 'red');
            }
        }

        //check job user worker
        exec("ps -ef | grep -v grep | grep 'type=raovat-user' | awk '{ print $2 }'", $PID);
        $PID = current($PID);
        if (empty($PID)) {
            $command = shell_exec("nohup php " . PUBLIC_PATH . "/index.php worker --type=raovat-user >/dev/null & echo 2>&1 & echo $!");
            $PID = shell_exec($command);
            if (empty($PID)) {
                echo General::getColoredString("Cannot deamon PHP process to run job raovat-user in background. \n", 'light_cyan', 'red');
                return;
            } else {
                echo General::getColoredString("PHP process run job raovat-user in background with PID : {$PID}. \n", 'light_cyan', 'red');
            }
        }

        //check job user worker
        exec("ps -ef | grep -v grep | grep 'type=raovat-general' | awk '{ print $2 }'", $PID);
        $PID = current($PID);
        if (empty($PID)) {
            $command = shell_exec("nohup php " . PUBLIC_PATH . "/index.php worker --type=raovat-general >/dev/null & echo 2>&1 & echo $!");
            $PID = shell_exec($command);
            if (empty($PID)) {
                echo General::getColoredString("Cannot deamon PHP process to run job raovat-general in background. \n", 'light_cyan', 'red');
                return;
            } else {
                echo General::getColoredString("PHP process run job raovat-general in background with PID : {$PID}. \n", 'light_cyan', 'red');
            }
        }
    }

    public function crontabAction() {
        $params = $this->request->getParams();

        if (empty($params['type'])) {
            return General::getColoredString("Unknown type or id \n", 'light_cyan', 'red');
        }

        switch ($params['type']) {

            case 'update-vip-content':
                $this->_jobUpdateVipContent();
                break;

            default:
                echo General::getColoredString("Unknown type or id \n", 'light_cyan', 'red');

                break;
        }

        return true;
    }

    protected function _jobUpdateVipContent() {
        $str = '|| test';
        $filename = PUBLIC_PATH . '/test.txt';
        file_put_contents($filename, json_encode($str), FILE_APPEND);
        return;
        $instanceSearchContent = new \My\Search\Content();
        $arrContentList = $instanceSearchContent->getList(['less_expired_time' => time()]);

        if (!empty($arrContentList)) {
            $serivceConent = $this->serviceLocator->get('My\Models\Content');
            foreach ($arrContentList as $arrContent) {
                $arrData = [
                    'expired_time' => NULL,
                    'is_vip' => NULL,
                    'vip_type' => NULL
                ];
                $serivceConent->edit($arrContent, $arrContent['cont_id']);
            }
        }
    }

    public function crawlerAction() {
        $params = $this->request->getParams();

        if (empty($params['type'])) {
            return General::getColoredString("Unknown type or id \n", 'light_cyan', 'red');
        }

        if ($name == 'raovatquynhon') {
            $link = 'http://raovatquynhon.com';
            $content = General::crawler($link);
            echo '<pre>';
            print_r($content);
            echo '</pre>';
            die();
            try {
                $dom = new \Zend\Dom\Query($content);
                $results = $dom->execute('table#Table2 tr td tr td');
            } catch (\Exception $ex) {
                echo '<pre>';
                print_r($ex->getMessage());
                echo '</pre>';

                return $flag;
            }


            $pattern = '#phát thành công#';
            foreach ($results as $item) {
                $subject = $item->textContent;

                if (preg_match($pattern, $subject)) {
                    $flag = true;
                    break;
                }
            }

            return $flag;


            $arrCate = [
                'Nhân sự việc làm',
            ];

            $arrProperties = [
                'Tin Rao Vặt', 'Tin Quảng Cáo', 'Tin Dịch Vụ'
            ];
        }
    }

    public function sitemapAction() {
        $this->siteMapCategory();
        $this->siteMapContent();
        $this->sitemapOther();

        $xml = '<?xml version="1.0" encoding="UTF-8"?><sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></sitemapindex>';
        $xml = new \SimpleXMLElement($xml);

        if (is_file(PUBLIC_PATH . '/xml/content.xml')) {
            $sitemap = $xml->addChild('sitemap', '');
            $sitemap->addChild('loc', BASE_URL . '/xml/content.xml');
            $sitemap->addChild('lastmod', date('c', time()));
        }
        if (is_file(PUBLIC_PATH . '/xml/category.xml')) {
            $sitemap = $xml->addChild('sitemap', '');
            $sitemap->addChild('loc', BASE_URL . '/xml/category.xml');
            $sitemap->addChild('lastmod', date('c', time()));
        }
//
//        if (is_file(PUBLIC_PATH . '/xml/general.xml')) {
//            $sitemap = $xml->addChild('sitemap');
//            $sitemap->addChild('loc', BASE_URL . '/xml/general.xml');
//            $sitemap->addChild('lastmod', date('c', time()));
//        }
        if (is_file(PUBLIC_PATH . '/xml/other.xml')) {
            $sitemap = $xml->addChild('sitemap');
            $sitemap->addChild('loc', BASE_URL . '/xml/other.xml');
            $sitemap->addChild('lastmod', date('c', time()));
        }

        $result = file_put_contents(PUBLIC_PATH . '/xml/bestquynhon_sitemap.xml', $xml->asXML());
        if ($result) {
            echo General::getColoredString("Create bestquynhon_sitemap.xml completed!", 'blue', 'cyan');
            $this->flush();
        }
        echo General::getColoredString("DONE!", 'blue', 'cyan');
        die('done');
    }

    public function siteMapCategory() {
        $doc = '<?xml version="1.0" encoding="UTF-8"?>';
        $doc .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
        $doc .= '</urlset>';
        $xml = new \SimpleXMLElement($doc);
        $this->flush();
        $instanceSearchCategory = new \My\Search\Category();
        $arrCategoryList = $instanceSearchCategory->getList(['cate_status' => 1], [], ['cate_sort' => ['order' => 'asc'], 'cate_id' => ['order' => 'asc']]);

        $arrCategoryParentList = [];
        $arrCategoryByParent = [];
        if (!empty($arrCategoryList)) {
            foreach ($arrCategoryList as $arrCategory) {
                if ($arrCategory['parent_id'] == 0) {
                    $arrCategoryParentList[$arrCategory['cate_id']] = $arrCategory;
                } else {
                    $arrCategoryByParent[$arrCategory['parent_id']][] = $arrCategory;
                }
            }
        }

        ksort($arrCategoryByParent);

        //findall district
        $instanceSearchDistrict = new \My\Search\District();
        $arrDistrict = $instanceSearchDistrict->getList(['not_dist_status' => -1], [], ['dist_sort' => ['order' => 'asc'], 'dist_id' => ['order' => 'asc']]);

        //findall properties
        $instanceSearchProperties = new \My\Search\Properties();
        $arrProperties = $instanceSearchProperties->getList(['not_prop_status' => -1, 'not_parent_id' => 0]);

        //format properties
        $arrPropertiesFormat = [];
        foreach ($arrProperties as $value) {
            $arrPropertiesFormat[$value['parent_id']][] = $value;
        }

        foreach ($arrCategoryParentList as $value) {
            $strCategoryURL = BASE_URL . '/danh-muc/' . $value['cate_slug'] . '-' . $value['cate_id'] . '.html';
            $url = $xml->addChild('url');
            $url->addChild('loc', $strCategoryURL);
            $url->addChild('lastmod', date('c', time()));
            $url->addChild('changefreq', 'daily');
            $url->addChild('priority', 0.7);

            //khu vuc tat ca
            foreach ($arrPropertiesFormat[$value['prop_id']] as $prop) {
                $href = BASE_URL . '/danh-muc/' . $value['cate_slug'] . '-' . $value['cate_id'] . '/khu-vuc/toan-tinh-0/nhu-cau/' . $prop['prop_slug'] . '-' . $prop['prop_id'] . '.html';
                $url = $xml->addChild('url');
                $url->addChild('loc', $href);
                $url->addChild('lastmod', date('c', time()));
                $url->addChild('changefreq', 'daily');
                $url->addChild('priority', 0.7);
            }

            foreach ($arrDistrict as $arrLoca) {
                $href = BASE_URL . '/danh-muc/' . $value['cate_slug'] . '-' . $value['cate_id'] . '/khu-vuc/' . $arrLoca['dist_slug'] . '-' . $arrLoca['dist_id'] . '.html';
                $url = $xml->addChild('url');
                $url->addChild('loc', $href);
                $url->addChild('lastmod', date('c', time()));
                $url->addChild('changefreq', 'daily');
                $url->addChild('priority', 0.7);

                foreach ($arrPropertiesFormat[$value['prop_id']] as $prop) {
                    $href = BASE_URL . '/danh-muc/' . $value['cate_slug'] . '-' . $value['cate_id'] . '/khu-vuc/' . $arrLoca['dist_slug'] . '-' . $arrLoca['dist_id'] . '/nhu-cau/' . $prop['prop_slug'] . '-' . $prop['prop_id'] . '.html';
                    $url = $xml->addChild('url');
                    $url->addChild('loc', $href);
                    $url->addChild('lastmod', date('c', time()));
                    $url->addChild('changefreq', 'daily');
                    $url->addChild('priority', 0.7);
                }
            }
        }
        foreach ($arrCategoryByParent as $key => $arr) {
            foreach ($arr as $value) {
                $strCategoryURL = BASE_URL . '/danh-muc/' . $value['cate_slug'] . '-' . $value['cate_id'] . '.html';
                $url = $xml->addChild('url');
                $url->addChild('loc', $strCategoryURL);
                $url->addChild('lastmod', date('c', time()));
                $url->addChild('changefreq', 'daily');
                $url->addChild('priority', 0.7);

                //khu vuc tat ca
                foreach ($arrPropertiesFormat[$arrCategoryParentList[$key]['prop_id']] as $prop) {
                    $href = BASE_URL . '/danh-muc/' . $value['cate_slug'] . '-' . $value['cate_id'] . '/khu-vuc/toan-tinh-0/nhu-cau/' . $prop['prop_slug'] . '-' . $prop['prop_id'] . '.html';
                    $url = $xml->addChild('url');
                    $url->addChild('loc', $href);
                    $url->addChild('lastmod', date('c', time()));
                    $url->addChild('changefreq', 'daily');
                    $url->addChild('priority', 0.7);
                }

                foreach ($arrDistrict as $arrLoca) {
                    $href = BASE_URL . '/danh-muc/' . $value['cate_slug'] . '-' . $value['cate_id'] . '/khu-vuc/' . $arrLoca['dist_slug'] . '-' . $arrLoca['dist_id'] . '.html';
                    $url = $xml->addChild('url');
                    $url->addChild('loc', $href);
                    $url->addChild('lastmod', date('c', time()));
                    $url->addChild('changefreq', 'daily');
                    $url->addChild('priority', 0.7);

                    foreach ($arrPropertiesFormat[$arrCategoryParentList[$key]['prop_id']] as $prop) {
                        $href = BASE_URL . '/danh-muc/' . $value['cate_slug'] . '-' . $value['cate_id'] . '/khu-vuc/' . $arrLoca['dist_slug'] . '-' . $arrLoca['dist_id'] . '/nhu-cau/' . $prop['prop_slug'] . '-' . $prop['prop_id'] . '.html';
                        $url = $xml->addChild('url');
                        $url->addChild('loc', $href);
                        $url->addChild('lastmod', date('c', time()));
                        $url->addChild('changefreq', 'daily');
                        $url->addChild('priority', 0.7);
                    }
                }
            }
        }

        unlink(PUBLIC_PATH . '/xml/category.xml');
        $result = file_put_contents(PUBLIC_PATH . '/xml/category.xml', $xml->asXML());
        if ($result) {
            echo General::getColoredString("Sitemap category done", 'blue', 'cyan');
            $this->flush();
        }

        return true;
    }

    public function siteMapContent() {
        $instanceSearchContent = new \My\Search\Content();
        $doc = '<?xml version="1.0" encoding="UTF-8"?>';
        $doc .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
        $doc .= '</urlset>';
        $xml = new \SimpleXMLElement($doc);
        $this->flush();
        $intLimit = 100;
        for ($intPage = 1; $intPage < 10000; $intPage ++) {
            $arrContentList = $instanceSearchContent->getListLimit(['not_cont_status' => -1], $intPage, $intLimit, ['cont_id' => ['order' => 'desc']]);
            if (empty($arrContentList)) {
                break;
            }
            foreach ($arrContentList as $arr) {
                $href = BASE_URL . '/rao-vat/' . $arr['cont_slug'] . '-' . $arr['cont_id'] . '.html';
                $url = $xml->addChild('url');
                $url->addChild('loc', $href);
                $url->addChild('lastmod', date('c', time()));
                $url->addChild('changefreq', 'daily');
                $url->addChild('priority', 0.7);
            }
        }

        unlink(PUBLIC_PATH . '/xml/content.xml');
        $result = file_put_contents(PUBLIC_PATH . '/xml/content.xml', $xml->asXML());
        if ($result) {
            echo General::getColoredString("Sitemap content done", 'blue', 'cyan');
            $this->flush();
        }

        return true;
    }

    public function siteMapSearch() {
        
    }

    private function sitemapOther() {
        $doc = '<?xml version="1.0" encoding="UTF-8"?>';
        $doc .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
        $doc .= '</urlset>';
        $xml = new \SimpleXMLElement($doc);
        $this->flush();
        $arrData = ['http://bestquynhon.com/'];
        foreach ($arrData as $value) {
            $href = $value;
            $url = $xml->addChild('url');
            $url->addChild('loc', $href);
            $url->addChild('lastmod', date('c', time()));
            $url->addChild('changefreq', 'daily');
            $url->addChild('priority', 1);
        }

        unlink(PUBLIC_PATH . '/xml/other.xml');
        $result = file_put_contents(PUBLIC_PATH . '/xml/other.xml', $xml->asXML());
        if ($result) {
            echo General::getColoredString("Sitemap orther done", 'blue', 'cyan');
            $this->flush();
        }
    }

}
