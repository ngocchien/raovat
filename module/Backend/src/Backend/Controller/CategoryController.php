<?php

namespace Backend\Controller;

use My\Controller\MyController,
    My\Validator\Validate,
    My\General;

class CategoryController extends MyController {
    /* @var $serviceCategory \My\Models\Category */

    public function __construct() {
        $this->externalJS = [
            STATIC_URL . '/b/js/my/??category.js'
        ];
    }

    public function indexAction() {
        $params = array_merge($this->params()->fromQuery(), $this->params()->fromRoute());
        $intPage = $this->params()->fromQuery('page', 1);
        $intLimit = 15;
        $arrCondition = array(
            'not_cate_status' => -1
        );

        $serviceCategory = $this->serviceLocator->get('My\Models\Category');
        $arrCategoryList = $serviceCategory->getListLimit($arrCondition, $intPage, $intLimit, 'cate_grade ASC');

        $route = 'backend-user-search';

        $intTotal = $serviceCategory->getTotal($arrConditions);
        $helper = $this->serviceLocator->get('viewhelpermanager')->get('Paging');
        $paging = $helper($params['module'], $params['__CONTROLLER__'], $params['action'], $intTotal, $intPage, $intLimit, $route, $params);

        if (!empty($arrCategoryList)) {
            foreach ($arrCategoryList as $arrCategory) {
                $arrUserIdList[] = $arrCategory['user_created'];
            }
            if (!empty($arrUserIdList)) {
                $arrUserIdList = array_unique($arrUserIdList);
                $strUserList = implode(',', $arrUserIdList);
                $serviceUser = $this->serviceLocator->get('My\Models\User');
                $arrConditionUser = [
                    'user_id_list' => $strUserList
                ];
                $arrUserList = $serviceUser->getList($arrConditionUser);
                if (!empty($arrUserList)) {
                    foreach ($arrUserList as $arrUser) {
                        $arrUserListFM[$arrUser['user_id']] = $arrUser;
                    }
                }
            }
        }
        return array(
            'params' => $params,
            'paging' => $paging,
            'arrCategoryList' => $arrCategoryList,
            'arrUserList' => $arrUserListFM
        );
    }

    public function addAction() {
        $arrParamsRoute = $params = $this->params()->fromRoute();
        $serviceCategory = $this->serviceLocator->get('My\Models\Category');
        //danh sách danh mục cha
        $arrConditionParent = [
            'parent_id' => 0,
            'not_cate_status' => -1
        ];
        $arrParentList = $serviceCategory->getList($arrConditionParent);
        $errors = array();

        if ($this->request->isPost()) {
            $params = $this->params()->fromPost();
            $cateName = trim($params['cate_name']);
            $cateIcon = trim($params['cate_icon']);
            $cateSort = (int) trim($params['cate_sort']);
            $cateMetaTitle = trim($params['cate_meta_title']);
            $cateMetaDescription = trim($params['cate_meta_description']);
            $cateMetaKeyword = trim($params['cate_meta_keyword']);
            $cateStatus = $params['cate_status'];
            $parentId = $params['parent_id'];

            if (empty($cateName)) {
                $errors['cate_name'] = 'Tên danh mục không được bỏ trống!';
            }

            if (empty($parentId)) {
                if (empty($cateIcon)) {
                    $errors['cate_icon'] = 'Chưa chọn Icon cho Danh mục';
                }
            }

            if (empty($cateMetaTitle)) {
                $errors['cate_meta_title'] = 'Chưa nhập SEO Meta Title!';
            }

            if (empty($cateMetaDescription)) {
                $errors['cate_meta_description'] = 'Chưa nhập SEO meta Description!';
            }

            if (empty($cateMetaKeyword)) {
                $errors['cate_meta_keyword'] = 'Chưa nhập SEO meta Keyword!';
            }

            if (empty($errors)) {
                $arrCondition = array(
                    'cate_slug' => General::getSlug($cateName),
                    'not_cate_status' => -1,
                    'not_parent_id' => $parentId
                );
                $arrResult = $serviceCategory->getList($arrCondition);
                if ($arrResult) {
                    $errors[] = 'Danh mục này đã tồn tại trong hệ thống!';
                }

                if (empty($errors)) {
                    $arrParams = [
                        'cate_name' => $cateName,
                        'cate_icon' => $cateIcon,
                        'cate_slug' => General::getSlug($cateName),
                        'cate_meta_title' => $cateMetaTitle,
                        'cate_meta_description' => $cateMetaDescription,
                        'cate_meta_keyword' => $cateMetaKeyword,
                        'cate_sort' => $cateSort,
                        'cate_status' => $cateStatus,
                        'created_date' => time(),
                        'user_created' => UID,
                        'parent_id' => $parentId
                    ];
                    $intResult = $serviceCategory->add($arrParams);
                    if ($intResult) {
                        if ($parentId > 0) {
                            foreach ($arrParentList as $value) {
                                if ($value['cate_id'] == $parentId) {
                                    $detailParent = $value;
                                    continue;
                                }
                            }
                            $dataUpdate = array(
                                'cate_grade' => $detailParent['cate_grade'] . sprintf("%04d", $cateSort) . ':' . sprintf("%04d", $intResult) . ':',
                                'cate_status' => $detailParent['cate_status']
                            );
                        } else {
                            $dataUpdate = array(
                                'cate_grade' => sprintf("%04d", $cateSort) . ':' . sprintf("%04d", $intResult) . ':',
                                'cate_status' => $cateStatus
                            );
                        }
                        $serviceCategory->edit($dataUpdate, $intResult);

                        $serviceLogs = $this->serviceLocator->get('My\Models\Logs');
                        $arrLog = General::createLogs($arrParamsRoute, $arrParams, $intResult);
                        $serviceLogs->add($arrLog);
                        $this->flashMessenger()->setNamespace('success-add-category')->addMessage('Thêm danh mục thành công !');
                        $this->redirect()->toRoute('backend', array('controller' => 'category', 'action' => 'edit', 'id' => $intResult));
                    }
                    $errors[] = 'Xảy ra lỗi trong quá trình thêm dữ liệu! Vui lòng thử lại';
                }
            }
        }
        return array(
            'params' => $params,
            'errors' => $errors,
            'arrParentList' => $arrParentList
        );
    }

    public function editAction() {
        $arrParamsRoute = $params = $this->params()->fromRoute();
        if (empty($params['id'])) {
            $this->redirect()->toRoute('backend', array('controller' => 'category', 'action' => 'index'));
        }
        $intCategoryId = (int) $params['id'];
        $arrCondition = array('cate_id' => $intCategoryId);
        $serviceCategory = $this->serviceLocator->get('My\Models\Category');
        $arrCategory = $serviceCategory->getDetail($arrCondition);

        if (empty($arrCategory)) {
            $this->redirect()->toRoute('backend', array('controller' => 'user', 'action' => 'index'));
        }
        $errors = array();
        $arrParentList = [];
        if ($arrCategory['parent_id'] != 0) {
            //danh sách danh mục cha
            $arrConditionParent = [
                'parent_id' => 0,
                'not_cate_status' => -1
            ];
            $arrParentList = $serviceCategory->getList($arrConditionParent);
        }

        if ($this->request->isPost()) {
            $params = $this->params()->fromPost();

            $cateName = trim($params['cate_name']);
            $cateIcon = trim($params['cate_icon']);
            $cateSort = (int) trim($params['cate_sort']);
            $cateMetaTitle = trim($params['cate_meta_title']);
            $cateMetaDescription = trim($params['cate_meta_description']);
            $cateMetaKeyword = trim($params['cate_meta_keyword']);
            $cateStatus = $params['cate_status'];
            $parentId = (int) $params['parent_id'];

            if (empty($cateName)) {
                $errors['cate_name'] = 'Tên danh mục không được bỏ trống!';
            }

            if (empty($parentId)) {
                if (empty($cateIcon)) {
                    $errors['cate_icon'] = 'Chưa chọn Icon cho Danh mục';
                }
            }

            if (empty($cateMetaTitle)) {
                $errors['cate_meta_title'] = 'Chưa nhập SEO Meta Title!';
            }

            if (empty($cateMetaDescription)) {
                $errors['cate_meta_description'] = 'Chưa nhập SEO meta Description!';
            }

            if (empty($cateMetaKeyword)) {
                $errors['cate_meta_keyword'] = 'Chưa nhập SEO meta Keyword!';
            }

            if (empty($errors)) {
                $arrCondition = array(
                    'cate_slug' => General::getSlug($cateName),
                    'not_cate_status' => -1,
                    'not_cate_id' => $intCategoryId,
                    'not_parent_id' => $parentId
                );
                $arrResult = $serviceCategory->getList($arrCondition);

                if ($arrResult) {
                    $errors[] = 'Danh mục này đã tồn tại trong hệ thống!';
                }

                if (empty($errors)) {
                    $arrParams = array(
                        'cate_name' => $cateName,
                        'cate_icon' => $cateIcon,
                        'cate_slug' => General::getSlug($cateName),
                        'cate_meta_title' => $cateMetaTitle,
                        'cate_meta_description' => $cateMetaDescription,
                        'cate_meta_keyword' => $cateMetaKeyword,
                        'cate_sort' => $cateSort,
                        'cate_status' => $cateStatus,
                        'updated_date' => time(),
                        'user_updated' => UID,
                        'parent_id' => $parentId
                    );

                    $intResult = $serviceCategory->edit($arrParams, $intCategoryId);

                    if ($intResult) {
                        if ($arrCategory['parent_id'] != $parentId || $arrCategory['cate_sort'] != $cateSort) {
                            $detailParent = $serviceCategory->getDetail(array('cate_id' => $parentId));

                            if (!empty($detailParent)) {
                                $dataUpdate = array(
                                    'cate_grade' => $arrCategory['cate_grade'],
                                    'grade_update' => $detailParent['cate_grade'] . sprintf("%04d", $cateSort) . ':' . sprintf("%04d", $intCategoryId) . ':',
                                    'cate_status' => $detailParent['cate_status'],
                                    'parentID' => $parentId,
                                );
                            } else {
                                $dataUpdate = array(
                                    'cate_grade' => $arrCategory['cate_grade'],
                                    'grade_update' => sprintf("%04d", $cateSort) . ':' . sprintf("%04d", $intCategoryId) . ':',
                                    'cate_status' => $cateStatus,
                                    'parentID' => $parentId,
                                );
                            }

                            $serviceCategory->updateTree($dataUpdate);
                        }

                        if ($arrCategory['cate_status'] != $cateStatus) {
                            $dataUpdate = array(
                                'cate_status' => $cateStatus,
                                'grade_update' => $arrCategory['cate_grade'],
                            );
                            $serviceCategory->updateStatusTree($dataUpdate);
                        }

                        $serviceLogs = $this->serviceLocator->get('My\Models\Logs');
                        $arrLog = General::createLogs($arrParamsRoute, $arrParams, $intCategoryId);
                        $serviceLogs->add($arrLog);

                        $this->flashMessenger()->setNamespace('success-edit-category')->addMessage('Chỉnh sửa danh mục thành công !');
                        $this->redirect()->toRoute('backend', array('controller' => 'category', 'action' => 'edit', 'id' => $intCategoryId));
                    } else {
                        $errors[] = 'Xảy ra lỗi trong quá trình thêm dữ liệu! Vui lòng thử lại';
                    }
                }
            }
        }
        return array(
            'params' => $params,
            'arrCategory' => $arrCategory,
            'errors' => $errors,
            'arrParentList' => $arrParentList
        );
    }

    public function deleteAction() {
        $arrParamsRoute = $this->params()->fromRoute();
        if ($this->request->isPost()) {
            $params = $this->params()->fromPost();
            if (empty($params['categoryId'])) {
                return $this->getResponse()->setContent(json_encode(array('st' => -1, 'ms' => 'Xảy ra lỗi ! Vui lòng thử lại!')));
            }
            $intCategoryId = (int) $params['categoryId'];
            //find Category in system
            $serviceCategory = $this->serviceLocator->get('My\Models\Category');
            $arrConditionCategory = array(
                'cate_id' => $intCategoryId
            );
            $arrCategory = $serviceCategory->getDetail($arrConditionCategory);

            if (empty($arrCategory)) {
                return $this->getResponse()->setContent(json_encode(array('st' => -1, 'ms' => 'Find not found Category in DB!')));
            }

            /**/
            $arrCategoryChild = [];
            if ($arrCategory['parent_id'] == 0) {
                $arrConditionChild = [
                    'parent_id' => $intCategoryId,
                    'not_cate_status' => -1
                ];
                $arrCategoryChild = $serviceCategory->getDetail($arrConditionChild);
            }

            if(!empty($arrCategoryChild)){
                return $this->getResponse()->setContent(json_encode(array('st' => -1, 'ms' => 'Danh mục này có nhiều danh mục con! Vui lòng xóa các danh mục con trước!')));
            }

            $arrParams = array(
                'cate_status' => -1,
                'user_updated' => UID,
                'updated_date' => time()
            );

            $result = $serviceCategory->edit($arrParams, $intCategoryId);

            if ($result) {
                $serviceLogs = $this->serviceLocator->get('My\Models\Logs');
                $arrLog = General::createLogs($arrParamsRoute, $arrParams, $intCategoryId);
                $serviceLogs->add($arrLog);

                return $this->getResponse()->setContent(json_encode(array('st' => 1, 'ms' => 'Deleted Category Success!')));
            }

            return $this->getResponse()->setContent(json_encode(array('st' => -1, 'ms' => 'Xảy ra lỗi trong quá trình xử lý ! Vui lòng thử lại!')));
        }
    }

    public function changeIconAction() {
        return;
    }

}
