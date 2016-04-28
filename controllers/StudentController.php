<?php

/**
 * Class StudentController
 *
 * Extends Core Controller
 * @uses $model from the core Controller
 *
 * @package Student
 * @subpackage Controller
 */

class StudentController extends Controller
{

    /**
     * Action to show edit form
     *
     * @param int $student_id
     */
    function actionEdit($student_id)
    {
        $row = $this->model->getStudentData($student_id);
        $similar_groups = $this->model->getSimilarGroups($student_id);
        $current_group = $this->model->getGroup($student_id);
        $content = '../views/students/edit.php';
        include '../views/main.php';
    }

    /**
     * Action to update student data
     *
     * @param int $student_id
     */
    function actionUpdate($student_id)
    {
        $current_group = $this->model->getGroup($student_id);
        $this->model->update($student_id);
        header("Location:/group/view/$current_group");

    }

    /**
     * Action to show add form
     * in case of POST request add new student and redirect to group view
     *
     * @param int $group_number
     */
    function actionAdd($group_number)
    {
        if(isset($_POST['submit']))
        {
            $this->model->add($group_number);
            header("Location:/group/view/$group_number");
        }
        else {
            $content = "../views/students/add.php";
            include '../views/main.php';
        }
    }

    /**
     * Action to delete student
     * redirect to group view
     *
     * @param int $student_id
     */
    function actionDelete($student_id)
    {
        $current_group = $this->model->getGroup($student_id);
        $this->model->delete($student_id);
        header("Location:/group/view/$current_group");
    }


}