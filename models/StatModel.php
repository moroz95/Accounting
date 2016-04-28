<?php

/**
 * Class StatModel
 */
class StatModel extends Model
{

    /**
     * @return array
     */
    public function getGroupsData()
    {
        $query = mysqli_query($this->connection, "SELECT * FROM `groups`");
        while ($temp = mysqli_fetch_array($query)) {
            $groups[] = $temp;
        }

        return $groups;
    }

    /**
     * @return array
     */
    public function getExamsData()
    {
        $query = mysqli_query($this->connection, "SELECT * FROM `exams`");
        while ($temp = mysqli_fetch_array($query)) {
            $exams[] = $temp;
        }

        return $exams;
    }

    /**
     * @param $group_number
     * @return array
     */
    public function getStudentsData($group_number)
    {
        $group_number = (int)$group_number;
        $students = mysqli_query($this->connection, "SELECT * FROM `students` INNER JOIN `students_groups` ON(`students`.`id` = `students_groups`.`student`) WHERE `students_groups`.`student_group` = $group_number ");
        while ($row = mysqli_fetch_array($students)) {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * @param $exam_id
     * @return array|null
     */
    public function getExamData($exam_id)
    {
        $exams = mysqli_query($this->connection, "SELECT * FROM `exams` WHERE `id`= $exam_id ");
        $row = mysqli_fetch_array($exams);
        return $row;
    }

    /**
     * @param $student_id
     * @param $exam_title
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
     * @param $student_id
     * @return mixed
     */
    public function countStudentExams($student_id)
    {
        $ex = mysqli_query($this->connection, "SELECT COUNT(`exam_id`) FROM `exams_eval` WHERE `student`= $student_id");
        $exa = mysqli_fetch_array($ex);//$exa['0'] - количество сданных экзаменов
        return $exa['0'];
    }

    /**
     * @param $student_id
     * @return mixed
     */
    public function getAverageMark($student_id)
    {
        $evals = mysqli_query($this->connection, "SELECT AVG(`exam_eval`) FROM `exams_eval` WHERE `student`= $student_id");
        $evl=mysqli_fetch_array($evals);//$evl['0'] - сама оценка
        return $evl['0'];
    }

    /**
     * @param $group_number
     * @return mixed
     */
    public function countStudents($group_number)
    {
        $std_count = mysqli_query($this->connection, "SELECT COUNT(`id`) FROM `students` INNER JOIN `students_groups` ON(`students`.`id` = `students_groups`.`student`) WHERE `students_groups`.`student_group` = $group_number");
        $std_c = mysqli_fetch_array($std_count);//$std_c['0'] - количество студентов в группе
        return $std_c['0'];
    }

    /**
     * @param $group_number
     * @return int|mixed
     */
    public function getGroupSum($group_number)
    {
        $sum = 0;
        $students = $this->getStudentsData($group_number);
        foreach ($students as $student)
        {
            $mark = $this->getAverageMark($student['id']);
            $sum += $mark;
        }
        return $sum;
    }

    /**
     * @param $sum
     * @param $count
     * @return string
     */
    public function getGroupStatus($sum, $count)
    {
        $average = $sum/ $count;
        if ($average <= 2) {
           return "Безпробудные двоечники";
        } elseif ($average > 2 and $average <= 3) {
            return  "Неудовлетворительно";
        } elseif ($average >= 3 and $average < 4) {
            return  "Удовлетворительно";
        } elseif ($average >= 4 and $average < 5) {
            return "Хорошо";
        } elseif ($average == 5) {
            return "Отлично";
        }
    }
}