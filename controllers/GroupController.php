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
     * @param string $sort  ASC or DESC sort
     */
    function actionIndex($sort)
    {
        $rows = $this->model->getGroupNumbers($sort);
        $content = '../views/groups/index.php';
        include '../views/main.php';
    }

    /**
     * Action to show edit form
     *
     * @param integer $group_number current group number
     */
    function actionEdit($group_number)
    {;
        $row = $this->model->getGroupData($group_number);
        $content = '../views/groups/edit.php';
        include '../views/main.php';

    }

    /**
     * Action to update group
     * redirect to actionIndex
     *
     * @param integer $group_number current group number
     */
    function actionUpdate($group_number)
    {
        $this->model->update($group_number, $_POST['groupNumber'], $_POST['formationDate']);
        header('Location:/');
    }

    /**
     * Action to delete group and set its students to group zero
     * redirect to actionIndex
     *
     * @param integer $group_number current group number
     */
    function actionDelete($group_number)
    {
        $this->model->delete($group_number);
        header('Location:/');
    }

    /**
     * Action to show edit form
     * in case of POST request add new group and redirect to actionIndex
     */
    function actionAdd()
    {
        $content = '../views/groups/add.php';
        include '../views/main.php';
        if(isset($_POST['groupNumber']) && isset($_POST['formationDate']))
        {
            if(!($this->model->add($_POST['groupNumber'], $_POST['formationDate']))){
                echo "Группа уже существует, ошибка";
            }
            else header('Location:/');
        }
    }

    /**
     * Action to show students of current group
     *
     * @param integer $group_number current group number
     */
    function actionView($group_number)
    {
        $rows = $this->model->viewStudents($group_number);
        $content = '../views/groups/view.php';
        include '../views/main.php';
    }



}