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
     * Action to update student data
     *
     * @param int $student_id
     */
    function actionEdit($student_id)
    {
        Validator::setPost();
        $error = false;

        $row = $this->model->getStudentData($student_id);
        $similar_groups = $this->model->getSimilarGroups($student_id);
        $current_group = $this->model->getGroupNumber($student_id);

        if(Validator::validateId($student_id))
        {
            if($this->model->updateStudent($student_id, Validator::$post_data))
            {
                header("Location:/group/view/$current_group");
            }
            else $error = "Ошибка добавления";

        }

        $this->view->render('students/edit', array(
            'row' => $row, 'similar_groups' => $similar_groups, 'current_group' => $current_group, 'student_id' => $student_id
        ), $error);


    }

    /**
     * Action to show add form
     * in case of POST request add new student and redirect to group view
     *
     * TODO implement validation for student form
     *
     * @param int $group_number
     */
    function actionAdd($group_number)
    {
        Validator::setPost();
        $error = false;

        if(Validator::validateId($group_number))
        {
            if($this->model->addStudentToGroup($group_number, Validator::$post_data))
            {
                header("Location:/group/view/$group_number");
            }
            else $error = 'Ошибка добавления';

        }
        else if(!Validator::isNumber($group_number))
        {
            $error = 'Ошибка id';
        }

        $this->view->render('students/add', array('group_number' => $group_number), $error);
    }

    /**
     * Action to delete student
     * redirect to group view
     *
     * TODO implement error message
     *
     * @param int $student_id
     */
    function actionDelete($student_id)
    {

        $current_group = $this->model->getGroupNumber($student_id);
        if($this->model->deleteStudent($student_id) && Validator::isNumber($student_id))
        {
            header("Location:/group/view/$current_group");
        }
        else
        {
            $this->view->renderPartial('main', array(), 'Ошибка удаления');
        }

    }


}