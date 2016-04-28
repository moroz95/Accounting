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
        $rows = $this->model->viewExams($sort);
        $content = '../views/exams/index.php';
        include '../views/main.php';
    }

    /**
     * Action to show edit form
     *
     * @param int $exam_id
     */
    function actionEdit($exam_id)
    {
        $exam_id = (int)$exam_id;
        $row = $this->model->viewEditForm($exam_id);
        $content = '../views/exams/edit.php';
        include '../views/main.php';
    }

    /**
     * Action to update exam data
     *
     * @param int $exam_id
     */
    function actionUpdate($exam_id)
    {
        $exam_id = (int)$exam_id;
        $this->model->update($exam_id);
        header("Location:/exam");
    }

    /**
     * @return mixed
     */
    function actionAdd()
    {
        if(isset($_POST['examName']))
        {
            $this->model->addExam();
            header("Location:/exam");

        }
        else {
            $content = '../views/exams/add.php';
            include '../views/main.php';
        }
    }

    /**
     * Action to view groups to choose
     *
     * @param string $exam_title
     */
    function actionView($exam_title)
    {

        $_SESSION['exam_title'] = urldecode(preg_replace('/%u([0-9A-F]{4})/se','iconv("UTF-16BE", "UTF-8", pack("H4", "$1"))', $exam_title));
        $rows = $this->model->viewGroups();
        $content = "../views/exams/group.php";
        include '../views/main.php';

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
            echo "Ошибка.";
        }
        header("Location:/exam");
    }

    /**
     * Action to show 
     *
     * @param $group_number
     */
    function actionGroup($group_number)
    {
        if(!isset($_POST['submit'])) {
            $rows = $this->model->getExamData($group_number);
            $exam_type = $this->model->getExamType($_SESSION['exam_title']);
            $exam_id = $this->model->getExamId($_SESSION['exam_title']);
            $content = '../views/exams/view.php';
            include '../views/main.php';
        }
        else {
            $this->model->updateStudentMarks();
            header("Location:/exam/group/$group_number");
        }
    }



}