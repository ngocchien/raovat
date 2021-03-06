<?php

namespace My\Controller;

use Zend\Mvc\MvcEvent,
    Zend\Mvc\Controller\AbstractActionController,
    My\General;

class MyController extends AbstractActionController {
    /* @var $groupService \My\Models\Group */
    /* @var $serviceUser \My\Models\User */
    /* @var $serviceTemplate \My\Models\Template */

    protected $defaultJS = '';
    protected $externalJS = '';
    protected $defaultCSS = '';
    protected $externalCSS = '';
    protected $serverUrl;
    protected $authservice;
    private $resource;
    private $renderer;

    public function onDispatch(MvcEvent $e) {
        if (php_sapi_name() != 'cli') {
            $this->serverUrl = $this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost();
            $this->params = $this->params()->fromRoute();
            $this->params['module'] = strtolower($this->params['module']);
            $this->params['controller'] = strtolower($this->params['__CONTROLLER__']);
            $this->params['action'] = strtolower($this->params['action']);
            $this->resource = $this->params['module'] . ':' . $this->params['controller'] . ':' . $this->params['action'];
            $this->renderer = $this->serviceLocator->get('Zend\View\Renderer\PhpRenderer');
            $auth = $this->authenticate($this->params);

            if ($this->params['module'] === 'backend' && !$auth) {
                if (!$this->permission($this->params)) {
                    if ($this->request->isXmlHttpRequest()) {
                        die('Permission Denied!!!');
                    }
                    $this->layout('backend/error/accessDeny');
                    return false;
                }
            }

            $instanceStaticManager = new \My\StaticManager\StaticManager($this->resource, $this->serviceLocator);
            $instanceStaticManager
                    ->setJS(array('defaultJS' => $this->defaultJS))
                    ->setJS(array('externalJS' => $this->externalJS))
                    ->setCSS(array('defaultCSS' => $this->defaultCSS))
                    ->setCSS(array('externalCSS' => $this->externalCSS))
                    ->render(2.1);
            $this->setMeta($this->params);
        }
        return parent::onDispatch($e);
    }

    private function setMeta($arrData) {
        $this->renderer->headMeta()->setCharset('UTF-8');
        $this->renderer->headMeta()->appendName('viewport', 'width=device-width, initial-scale=1.0');
        switch ($this->resource) {
            case 'frontend:index:index':
                $this->renderer->headTitle(\My\General::SITE_DOMAIN . ' - Diễn đàn rao vặt Bình Định, Rao vặt miễn phí.');
                $this->renderer->headMeta()->appendName('keywords', 'bestquynhon.com,dien dan rao vạt binh dinh, rao vặt quy nhon, binh dinh, rao vat quy nhon, rao vat binh dinh, rao vat quy nhon - binh dinh, mua ban laptop, rao vat smartphone - dien thoai - laptop - my tinh pc - nha dat - dich vu - tuyen dung - viec lam ...');
                $this->renderer->headMeta()->appendName('description', 'bestquynhon.com, diễn đàn rao vặt bình định, rao vặt quy nhon, rao vặt bình định , mạng rao vặt quy nhơn - bình định, rao vặt mua bán Smartphone - điện thoại di động - laptop - pc - nhà đất - nhân sự - việc làm tại bình định');
                $this->renderer->headMeta()->appendName('dc.description', html_entity_decode('Diễn đàn rao vặt Bình Định , Rao vặt miễn phí!') . General::TITLE_META);
                $this->renderer->headMeta()->appendName('dc.subject', html_entity_decode('Diễn đàn rao vặt Bình Định , Rao vặt miễn phí!') . General::TITLE_META);
                $this->renderer->headMeta()->appendName('social', $metaSocial);
                $this->renderer->headMeta()->setProperty('og:url', $this->url()->fromRoute('home'));
                $this->renderer->headMeta()->setProperty('og:title', html_entity_decode(\My\General::SITE_DOMAIN . ' - Diễn đàn rao vặt Bình Định, Rao vặt miễn phí.'));
                $this->renderer->headMeta()->setProperty('og:description', html_entity_decode(\My\General::SITE_DOMAIN . ' - Diễn đàn rao vặt Bình Định, Rao vặt miễn phí.'));
                $this->renderer->headMeta()->setProperty('og:image', STATIC_URL . '/f/v1/images/logoct.png');
                $this->renderer->headMeta()->setProperty('og:image:type', 'image/png');
                $this->renderer->headMeta()->setProperty('og:image:width', '621');
                $this->renderer->headMeta()->setProperty('og:image:height', '132');
                $this->renderer->headMeta()->setProperty('og:type', 'website');

//                $this->renderer->headMeta()->setProperty('fb:pages', '272925143041233');

                $this->renderer->headMeta()->setProperty('itemprop:name', General::SITE_DOMAIN);
                $this->renderer->headMeta()->setProperty('itemprop:description', html_entity_decode('bestquynhon.com, diễn dàn rao vặt bình định, rao vặt quy nhon, rao vặt bình định , mạng rao vặt quy nhơn - bình định, rao vặt mua bán Smartphone - điện thoại di động - laptop - pc - nhà đất - nhân sự - việc làm tại bình định'));
                $this->renderer->headMeta()->setProperty('itemprop:image', STATIC_URL . '/f/v1/images/logoct.png');

                $this->renderer->headMeta()->setProperty('twitter:card', 'summary');
                $this->renderer->headMeta()->setProperty('twitter:site', General::SITE_AUTH);
                $this->renderer->headMeta()->setProperty('twitter:title', General::SITE_AUTH);
                $this->renderer->headMeta()->setProperty('twitter:description', 'bestquynhon.com, diễn dàn rao vặt bình định, rao vặt quy nhon, rao vặt bình định , mạng rao vặt quy nhơn - bình định, rao vặt mua bán Smartphone - điện thoại di động - laptop - pc - nhà đất - nhân sự - việc làm tại bình định');
                $this->renderer->headMeta()->setProperty('twitter:creator', General::SITE_AUTH);
                $this->renderer->headMeta()->setProperty('twitter:image:src', STATIC_URL . '/f/v1/images/logoct.png');
                $this->renderer->headMeta()->appendName('social', General::SOCIAL_FACEBOOK_URL);

                break;
            default:
                break;
        }
        if ($arrData['module'] === 'backend') {
            $this->renderer->headTitle('Administrator - BESTQUYNHON.COM');
        }
    }

    private function permission($params) {

        //check can access CPanel
        if (IS_ACP != 1) {
            return false;
        }

        //check use in fullaccess role
        if (FULL_ACCESS) {
            return true;
        }

        $ser = $this->serviceLocator;
        $serviceACL = $this->serviceLocator->get('ACL');

        $strActionName = $params['action'];

        if (strpos($params['action'], '-')) {
            $strActionName = '';
            $arrActionName = explode('-', $params['action']);
            foreach ($arrActionName as $k => $str) {
                if ($k > 0) {
                    $strActionName .= ucfirst($str);
                }
            }
            $strActionName = $arrActionName[0] . $strActionName;
        }

        $strControllerName = $params['controller'];
        if (strpos($params['controller'], '-')) {
            $strControllerName = '';
            $arrControllerName = explode('-', $params['controller']);
            foreach ($arrControllerName as $k => $str) {
                if ($k > 0) {
                    $strControllerName .= ucfirst($str);
                }
            }
            $strControllerName = $arrControllerName[0] . $strControllerName;
        }

        $strActionName = str_replace('_', '', $strActionName);
        $strControllerName = str_replace('_', '', $strControllerName);

        return $serviceACL->checkPermission($params['module'], $strControllerName, $strActionName);
    }

    protected function getAuthService() {
        if (!$this->authservice) {
            $this->authservice = $this->getServiceLocator()->get('AuthService');
        }
        return $this->authservice;
    }

    private function authenticate($arrData) {
        $arrUserData = $this->getAuthService()->getIdentity();
        if ($arrData['module'] === 'backend') {

            if (empty($arrUserData)) {
                return $this->redirect()->toRoute('backend', array('controller' => 'auth', 'action' => 'login'));
            }

            define('UID', (int) $arrUserData['user_id']);
            define('MODULE', $arrData['module']);
            define('CONTROLLER', $arrData['controller']);
            define('FULLNAME', $arrUserData['user_fullname']);
            define('USERNAME', $arrUserData['user_name']);
            define('EMAIL', $arrUserData['user_email']);
            define('GROU_ID', $arrUserData['group_id'] ? (int) $arrUserData['group_id'] : 0);
            define('IS_ACP', (empty($arrUserData['group_id']) ? 0 : $arrUserData['is_acp']));
            define('PERMISSION', json_encode($arrUserData['permission']));
            define('FULL_ACCESS', empty($arrUserData['is_full_access']) ? 0 : 1);
        }

        if ($arrData['module'] === 'frontend') {
            define('CUSTOMER_ID', $arrUserData['user_id'] ? (int) $arrUserData['user_id'] : 0);
            define('CUSTOMER_FULLNAME', $arrUserData['user_fullname'] ? $arrUserData['user_fullname'] : '');
            define('CUSTOMER_EMAIL', $arrUserData['user_email'] ? $arrUserData['user_email'] : '');
            define('CUSTOMER_PHONE', $arrUserData['user_phone'] ? $arrUserData['user_phone'] : '');
            define('CUSTOMER_AVATAR', $arrUserData['user_avatar'] ? $arrUserData['user_avatar'] : '');
            define('LOGGED', $arrUserData ? 1 : 0);
            define('CUSTOMER_BALANCE', $arrUserData['user_balance'] ? (int) $arrUserData['user_balance'] : 0);

            if (empty(CUSTOMER_ID) && $arrData['controller'] != 'user' && $arrData['action'] != 'social') {
                /*
                 * Oauth Google API;
                 */
                $googleClient = $this->__createServiceGoogle();
                $googleAuthUrl = $googleClient->createAuthUrl();
                /*
                 * facebook
                 */
                $fbInfo = General::$fbConfig;
                $helperFacebook = $this->__createServiceFacebook();
                $permissions = ['email', 'public_profile'];
                $loginFacebookUrl = $helperFacebook->getLoginUrl($fbInfo['redirect_uri'], $permissions);
            }
            define('GOOGLE_AUTH_URL', $googleAuthUrl ? $googleAuthUrl : '' );
            define('FACEBOOK_AUTH_URL', $loginFacebookUrl ? $loginFacebookUrl : '');

            $intTotalMessages = 0;
            if (CUSTOMER_ID) {
                $instaceSearchMessages = new \My\Search\Messages();
                $intTotalMessages = $instaceSearchMessages->getTotal(['to_user_id' => CUSTOMER_ID, 'is_view' => 0]);
            }
            define('NEW_MESSAGES', $intTotalMessages);

            $instanceSearchCategory = new \My\Search\Category();
            $arrCategoryList = $instanceSearchCategory->getList(['cate_status' => 1], [], ['cate_sort' => ['order' => 'asc'], 'cate_id' => ['order' => 'asc']]);

            $arrCategoryParentList = [];
            $arrCategoryByParent = [];
            $arrCategoryFormat = [];
            if (!empty($arrCategoryList)) {
                foreach ($arrCategoryList as $arrCategory) {
                    if ($arrCategory['parent_id'] == 0) {
                        $arrCategoryParentList[$arrCategory['cate_id']] = $arrCategory;
                    } else {
                        $arrCategoryByParent[$arrCategory['parent_id']][] = $arrCategory;
                    }
                    $arrCategoryFormat[$arrCategory['cate_id']] = $arrCategory;
                }
            }

            define('ARR_CATEGORY_PARENT', serialize($arrCategoryParentList));
            define('ARR_CATEGORY_BY_PARENT', serialize($arrCategoryByParent));
            define('ARR_CATEGORY', serialize($arrCategoryFormat));

            //location
            $instanceSearchDistrict = new \My\Search\District();
            $arrDistrictList = $instanceSearchDistrict->getList(['not_dist_status' => -1], [], ['dist_sort' => ['order' => 'asc'], 'dist_id' => ['order' => 'asc']]);
            $arrDistrictListFormat = [];
            foreach ($arrDistrictList as $value) {
                $arrDistrictListFormat[$value['dist_id']] = $value;
            }
            define('ARR_DISTRICT', serialize($arrDistrictListFormat));
            
            //lay danh sach tin cho nav right
//            if($arrData['controller'] == 'category' || $arrData['controller'] == 'content' || $arrData['controller'] == 'user' || $arrData['controller'] == 'tags'){
//                $instanceSearchContent = new \My\Search\Content();
//                $arrContentList = $instanceSearchContent->getListLimit(['not_cont_status'=>-1], 1, 5, ['updated_date'=>'crea']);
//            }

            //xu hướng tìm kiếm
            $instanceSearchKeyword = new \My\Search\Keyword();
            $arrKeywordTop = $instanceSearchKeyword->getListLimit(['is_crawler'=>1],1,50,['created_date'=>['order'=>'ASC']]);
            define('KEY_TOP', serialize($arrKeywordTop));

            unset($arrKeywordTop);
            unset($instanceSearchDistrict);
            unset($instaceSearchMessages);
            unset($instanceSearchCategory);
            unset($arrDistrictList);
            unset($arrDistrictListFormat);
            unset($arrCategory);
            unset($arrCategoryParentList);
            unset($arrCategoryByParent);
            unset($arrCategoryFormat);
        }
    }

    private function __createServiceGoogle() {
        $gpInfo = General::$ggConfig;
        $googleClient = new \Google_Client();
        $googleClient->setClientId($gpInfo['client_id']);
        $googleClient->setClientSecret($gpInfo['client_secret']);
        $googleClient->addScope('email');
        $googleClient->addScope('profile');
        $googleClient->setRedirectUri($gpInfo['redirect_uri']);

        return $googleClient;
    }

    private function __createServiceFacebook() {
        $fbInfo = General::$fbConfig;

        /*
         * facebook
         */
        $facebookClient = new \Facebook\Facebook([
            'app_id' => $fbInfo['appId'],
            'app_secret' => $fbInfo['secret'],
            'default_graph_version' => 'v2.5'
        ]);
        $helper = $facebookClient->getRedirectLoginHelper();
//        $loginFacebookUrl = $helperFacebook->getLoginUrl($fbInfo['redirect_uri']);
        return $helper;
    }

}
