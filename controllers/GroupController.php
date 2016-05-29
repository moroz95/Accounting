<?php

/**
 * Class GroupController
 *
 * Extends Core Controller
 * @uses $model from the core Controller
 *
 * @package Group
 * @subpackage Controller
 */
class GroupController extends Controller
{
    /**
     * Action to show groups
     *
     * @param string $sort ASC or DESC sort
     */
    function actionIndex($sort)
    {
        $group_numbers = $this->model->getGroupNumbers($sort);
        $this->view->render('groups/index', array('group_numbers' => $group_numbers));
    }

    /**
     * Action to show edit form
     * in case of POST request to update group and redirect to index
     *
     * @param integer $group_number current group number
     */
    function actionEdit($group_number)
    {
        Validator::setPost();
        if (Validator::validateId(Validator::$post_data['groupNumber'])) {
            $this->model->updateGroup($group_number, Validator::$post_data['groupNumber'], Validator::$post_data['formationDate']);
            header('Location:/groups/index');
        } else {
            $group_data = $this->model->getGroupData($group_number);
            $this->view->render('groups/edit', array('group_data' => $group_data, 'group_number' => $group_number));
        }

    }

    /**
     * Action to delete group and set its students to group zero
     * redirect to actionIndex
     *
     * @param integer $group_number current group number
     */
    function actionDelete($group_number)
    {
        $this->model->deleteGroup($group_number);
        header('Location:/groups/index');
    }

    /**
     * Action to show edit form
     * in case of POST request add new group and redirect to actionIndex
     */
    function actionAdd()
    {
        $error = false;
        Validator::setPost();

        if (Validator::$post_data) {
            if (!($this->model->addGroup(Validator::$post_data['groupNumber'], Validator::$post_data['formationDate']))) {
                $error = "Группа уже существует, ошибка";
            }
        }

        $this->view->render('groups/add', array(), $error);

    }

    /**
     * Action to show students of current group
     *
     * @param integer $group_number current group number
     */
    function actionView($group_number)
    {
        $group_number = ($group_number == false) ? (int)$group_number : $group_number;
        $rows = $this->model->getStudents($group_number);

        $error = Validator::isNumber($group_number) ? false : 'Группа не существует';

        $this->view->render('groups/view', array('group_number' => $group_number, 'rows' => $rows), $error);
    }


}