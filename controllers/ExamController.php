<?php

/**
 * Class ExamController
 *
 * Extends Core Controller
 * @uses $model from the core Controller
 *
 * @package Exam
 * @subpackage Controller
 */


class ExamController extends Controller
{

    /**
     * Action to show all exams
     *
     * @param string $sort  ASC or DESC sort
     */
    function actionIndex($sort)
    {
        $exams = $this->model->getExamsData($sort);
        $this->view->render('exams/index', array('exams' => $exams));
    }


    /**
     * Action to edit exam data
     * to show edit form, in case of POST request update exam
     *
     * TODO check database for valid id
     *
     * @param int $exam_id
     */
    function actionEdit($exam_id)
    {
        $exam_id = ($exam_id == false) ? (int)$exam_id : $exam_id;
        $exam_data = array();

        Validator::setPost();
        if (Validator::validateId($exam_id)){
            $this->model->updateExam(Validator::$post_data, $exam_id) ? header("Location:/exam") : $error = 'Неправильный id';
        }
        else {
            Validator::isNumber($exam_id) ? $exam_data = $this->model->getExamDataById($exam_id) : $error = 'Неправильный id';

        }
        $this->view->render('exams/edit', array('exam_data' => $exam_data, 'exam_id' => $exam_id), $error);
    }

    /**
     * @return mixed
     */
    function actionAdd()
    {
        Validator::setPost();
        if(Validator::$post_data)
        {
            $this->model->addExam(Validator::$post_data);
            header("Location:/exam");
        }
        else {
            $this->view->render('exams/add');
        }
    }

    /**
     * Action to view groups to choose
     *
     * @param string $exam_id
     */
    function actionView($exam_id)
    {
        $exam_title = $this->model->getExamTitle((int)$exam_id);
        $rows = $this->model->viewGroups();
        $this->view->render('exams/group', array('exam_title' => $exam_title, 'exam_id' => $exam_id, 'rows' => $rows));
    }

    /**
     * Action to delete exam
     *
     * @param $exam_id
     */
    function actionDelete($exam_id)
    {
        $exam_id = (int)$exam_id;
        $result = $this->model->delete($exam_id);
        if (!$result) {
            $this->view->renderPartial('main',array('content'=>'Ошибка при удалении'));
        }
        else
        {
            header("Location:/exam");
        }

    }

    /**
     * @param $group_number
     * @param $exam_id
     */
    function actionGroup($group_number, $exam_id)
    {
        $exam_id = (int)$exam_id;
        Validator::setPost();
        if(!isset($_POST['submit'])) {
            $rows = $this->model->getExamDataByGroup($group_number);
            $rows = $this->model->setStudentsMarks($rows, $exam_id);
            $exam_type = $this->model->getExamType($exam_id);
            $exam_title = $this->model->getExamTitle($exam_id);
            $this->view->render('exams/view', array(
                'rows' => $rows, 'exam_type' => $exam_type, 'exam_title' => $exam_title, 'exam_id' => $exam_id, 'group_number' => $group_number)
            );
        }
        else {
            $this->model->updateStudentMarks($exam_id);
            header("Location:/exam/group/$group_number/$exam_id");
        }
    }



}