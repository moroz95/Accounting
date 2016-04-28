<?php

/**
 * Class ExamModel
 *
 * Extends Core Model
 *
 * @package Exam
 * @subpackage Model
 */
class ExamModel extends Model
{
    /**
     * @param $sort
     * @return array
     */
    public function viewExams($sort)
    {
        $exams = mysqli_query($this->connection, "select * from `exams`  order by exam_date $sort");
        while ($row = mysqli_fetch_array($exams)) {
            $rows[] = $row;
        }
        return $rows;

    }

    /**
     * @param $exam_id
     * @return array
     */
    public function viewEditForm($exam_id)
    {
        $exams = mysqli_query($this->connection, "SELECT * FROM `exams` WHERE `id`= $exam_id ");
        $row = mysqli_fetch_array($exams);
        return $row;
    }

    /**
     * @param $exam_id
     */
    public function update($exam_id)
    {
        foreach ($_POST as $key => $value) {
            $$key = iconv("utf-8", "cp1251", $value);
        }
        mysqli_query($this->connection, "UPDATE exams SET exam_title='$examName', exam_type='$examType',exam_date='$examDate',exam_teacher='$examTeacher' WHERE id='$exam_id'");
    }

    /**
     * @param $exam_id
     * @return bool|mysqli_result
     */
    public function delete($exam_id)
    {
        $count_evals = mysqli_query($this->connection, "SELECT COUNT(`exam_id`) FROM `exams_eval` WHERE `exam_id`=$exam_id");
        $temp = mysqli_fetch_array($count_evals);
        $exams_count = $temp[0];

        if ($exams_count > 0) {
            return false;
        } else {
            return mysqli_query($this->connection, "DELETE FROM `exams` WHERE `id`='$exam_id'");
        }

    }

    /**
     * @return array
     */
    public function viewGroups()
    {
        $groups = mysqli_query($this->connection, "select * from `groups`");
        while ($temp = mysqli_fetch_array($groups)) {
            $rows[] = $temp;
        }
        return $rows;
    }

    /**
     * @param $group_number
     * @return array
     */
    public function getExamData($group_number)
    {
        $students = mysqli_query($this->connection, "SELECT * FROM `students` INNER JOIN `students_groups` ON(`students`.`id` = `students_groups`.`student`) WHERE `students_groups`.`student_group` = $group_number");

        while ($temp = mysqli_fetch_array($students)) {
            $rows[] = $temp;
        }
        return $rows;
    }

    /**
     * @param $exam_title
     * @return array
     */
    public function getExamType($exam_title)
    {
        $exam_title = iconv("utf-8", "cp1251", $exam_title);
        $exam_type = mysqli_query($this->connection, "SELECT `exam_type` FROM `exams` WHERE `exam_title`='$exam_title'");
        return mysqli_fetch_array($exam_type);
    }

    /**
     * @param $exam_title
     * @return mixed
     */
    public function getExamId($exam_title)
    {
        $exam_title = iconv("utf-8", "cp1251", $exam_title);
        $exam =  mysqli_query($this->connection, "SELECT * FROM `exams` WHERE `exam_title`='$exam_title'");
        $ex_row = mysqli_fetch_array($exam);
        $exam_id = $ex_row[0];
        return $exam_id;
    }

    /**
     * TODO: new algorithm
     *
     *
     */
    public function updateStudentMarks()
    {
        $keys = array_keys($_POST);
        $exid = $this->getExamId($_SESSION['exam_title']);
        for ($n=0; $n < count($keys); $n++) {
            $a = $exid; //id экзамена
            $b = $keys[$n]; //студент
            $c = $_POST[$keys[$n]]; //оценка
            $eva = mysqli_query($this->connection, "SELECT COUNT(`exam_eval`) FROM `exams_eval` WHERE `student`=$b AND `exam_id`=$a");
            $ev = mysqli_fetch_array($eva);
            if ($ev[0] > 0) {
                mysqli_query($this->connection, "UPDATE `exams_eval` SET `exam_eval`='$c' WHERE `student`='$b' AND `exam_id`=$a ");
            }
            else {
                mysqli_query($this->connection, "INSERT INTO `exams_eval`(`exam_id`, `student`, `exam_eval`) VALUES ($a,$b,$c)");
            }

        }
    }

    /**
     * @param $student_id
     * @return mixed
     */
    public function getStudentMark($student_id, $exam_title)
    {
        $exam_id = $this->getExamId($exam_title);
        $result = mysqli_query($this->connection, "SELECT `exam_eval` FROM `exams_eval` WHERE `student`=$student_id AND `exam_id`=$exam_id");
        $result = mysqli_fetch_array($result);
        return $result[0];
    }

    /**
     *
     */
    public function addExam()
    {
        foreach ($_POST as $key => $value) {
            $$key = iconv("utf-8", "cp1251", $value);
        }
        
        mysqli_query($this->connection, "INSERT INTO `exams`(`exam_title`, `exam_type`, `exam_date`, `exam_teacher`) VALUES ('$examName','$examType','$examDate','$examTeacher')");
    }
}