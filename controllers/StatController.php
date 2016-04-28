<?php

/**
 * Class StatController
 *
 * Extends Core Controller
 * @uses $model from the core Controller
 *
 * @package Stat
 * @subpackage Controller
 */


class StatController extends Controller
{


    function actionIndex()
    {
        $groups = $this->model->getGroupsData();
        $exams = $this->model->getExamsData();
        $content = '../views/stats/index.php';
        include '../views/main.php';
    }

    function actionSheet()
    {
        $students = $this->model->getStudentsData($_GET['group_select']);
        $exam_data = $this->model->getExamData($_GET['exam_select']);
        $content = '../views/stats/sheet.php';
        include '../views/main.php';

    }

    function actionProgress()
    {
        $students = $this->model->getStudentsData($_GET['group_select']);
        $content = '../views/stats/progress.php';
        include '../views/main.php';
    }
    
    function actionAverage()
    {
        $count = $this->model->countStudents($_GET['group_select']);
        $sum = $this->model->getGroupSum($_GET['group_select']);
        $status = $this->model->getGroupStatus($sum, $count);
        $content = '../views/stats/average.php';
        include '../views/main.php';

    }
}