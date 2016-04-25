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

            default:
                echo General::getColoredString("Unknown type \n", 'light_cyan', 'red');
                break;
        }
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
        $instanceSearch->createIndex();
        die('done');
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
                $methodHandler2 = '\My\Job\editComment::editComment';
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
            $PID = shell_exec("nohup php " . PUBLIC_PATH . "/index.php worker --type=raovat-content >/dev/null & echo 2>&1 & echo $!");
            if (empty($PID)) {
                echo General::getColoredString("Cannot deamon PHP process to run job raovat-content in background. \n", 'light_cyan', 'red');
                return;
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
    }

}
