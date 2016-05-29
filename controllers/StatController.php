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
        $this->view->render('stats/index', array('groups' =>$groups, 'exams' => $exams));
    }

    function actionSheet()
    {
        $students = $this->model->getStudentsData($_GET['group_select']);
        $exam_data = $this->model->getExamData($_GET['exam_select']);
        $students = $this->model->setStudentsMark($students, $exam_data['exam_title']);
        $this->view->render('stats/sheet', array('students' => $students, 'exam_data' => $exam_data));

    }

    function actionProgress()
    {
        $students = $this->model->getStudentsData($_GET['group_select']);
        $students = $this->model->setAverageData($students);
        $this->view->render('stats/progress', array('students' => $students));
    }
    
    function actionAverage()
    {
        $count = $this->model->countStudents($_GET['group_select']);
        $sum = $this->model->getGroupSum($_GET['group_select']);
        $status = $this->model->getGroupStatus($sum, $count);
        $this->view->render('stats/average', array('count' => $count, 'sum' => $sum, 'status' => $status));
    }
}