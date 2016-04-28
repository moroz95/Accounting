<?php

/**
 * Class StudentModel
 *
 * Extends Core Model
 * @uses $connection from core Model
 *
 * @package Student
 * @subpackage Model
 */
class StudentModel extends Model
{
    /**
     * @var array student data
     */
    private $student_data = false;


    /**
     * @param  integer $student_id
     * @return array
     */
    public function getStudentData($student_id)
    {
        $groups = mysqli_query($this->connection, "SELECT * FROM `students` WHERE `id`= $student_id");
        $this->student_data = mysqli_fetch_array($groups);
        return $this->student_data;
    }

    /**
     * @param  integer $student_id
     * @return int
     */
    public function getGroup($student_id)
    {
        $current_group = mysqli_query($this->connection, "SELECT `student_group` FROM `students_groups` WHERE `student`= $student_id ");
        $current_group = mysqli_fetch_array($current_group);
        return (int)$current_group['student_group'];
    }

    /**
     * @param  integer $student_id
     * @return array
     */
    public function getSimilarGroups($student_id)
    {
        ($this->student_data) ?: $this->student_data = $this->getStudentData($student_id);
        $income = $this->student_data['income_year'];
        $query = mysqli_query($this->connection, "SELECT * FROM `groups` WHERE `formation_date`='$income' ");
        while ($temp = mysqli_fetch_array($query)) {
            $similar_groups[] = $temp;
        }
        return $similar_groups;
    }

    /**
     * @param integer $student_id
     */
    public function delete($student_id)
    {
        mysqli_query($this->connection, "DELETE FROM `students` WHERE `id`='$student_id'");
        mysqli_query($this->connection, "DELETE FROM `exams_eval` WHERE `student`='$student_id'");
    }

    /**
     * @param $student_id
     */
    public function update($student_id)
    {
        foreach ($_POST as $key => $value)
        {
            $$key = iconv("utf-8", "cp1251", $value);
        }

        mysqli_query($this->connection, "UPDATE `students` SET `name`='$studName',`sname`='$studSname',`oname`='$studOname',`birthday`='$studBirth',`gradebook_number`='$studGradebook'  WHERE `id`= $student_id");
        mysqli_query($this->connection, "UPDATE `students_groups` SET `student_group`=$studGroup WHERE `student`= $student_id");
    }

    /**
     * @param $group_number
     */
    public function add($group_number)
    {
        foreach ($_POST as $key => $value)
        {
            $$key = iconv("utf-8", "cp1251", $value);
        }

        $students = mysqli_query($this->connection, "SELECT * FROM `groups` WHERE `group_number`= $group_number");
        if ($row = mysqli_fetch_array($students)) {
            $stud_income_year = $row[1];//$row[1] - дата формирования группы

            //Узнав эту дату записываем её как год поступления этого студента в таблицу students
            mysqli_query($this->connection, "INSERT INTO `students`(`name`, `sname`, `oname`, `birthday`, `gradebook_number`, `income_year`) VALUES ('$studName','$studSname','$studOname','$studBirth','$studGradebook','$stud_income_year')");

            //Связываем сдудента с группой (таблица students_groups)
            //Находим в таблице students только что добвленного предыдущей командой студента
            $query = mysqli_query($this->connection, "SELECT * FROM `students` WHERE `name`='$studName' AND `sname`='$studSname' AND `oname`='$studOname' AND `gradebook_number`='$studGradebook'");

            //Связываем студента и его группу
            $temp = mysqli_fetch_array($query);
            $std_id = $temp[0];// id студента в таблице students
            //группа в которую добавили студента $stud_group_numb;
            mysqli_query($this->connection, "INSERT INTO `students_groups`(`student`, `student_group`) VALUES ('$std_id','$group_number')");
        }


    }
}