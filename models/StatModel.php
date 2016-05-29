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
        $stm = $this->connection->query("SELECT * FROM `groups`");

        while ($temp = $stm->fetch()) {
            $groups[] = $temp;
        }

        return $groups;
    }

    /**
     * @return array
     */
    public function getExamsData()
    {
        $stm = $this->connection->query("SELECT * FROM `exams`");

        while ($temp = $stm->fetch()) {
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

        $stm = $this->connection->prepare("SELECT * FROM `students` INNER JOIN `students_groups` ON(`students`.`id` = `students_groups`.`student`) WHERE `students_groups`.`student_group` = ?");
        $stm->execute(array($group_number));

        $students = $stm->fetchAll();
        return $students;
    }

    /**
     * @param $exam_id
     * @return array|null
     */
    public function getExamData($exam_id)
    {
        $stm = $this->connection->prepare("SELECT * FROM `exams` WHERE `id`=?");
        $stm->execute(array($exam_id));
        $exam = $stm->fetch();
        return $exam;
    }

    /**
     * @param $student_id
     * @param $exam_title
     * @return mixed
     */
    public function getStudentMark($student_id, $exam_title)
    {
        $exam_id = $this->getExamId($exam_title);
        $stm = $this->connection->prepare("SELECT `exams_eval`.`exam_eval` FROM `exams_eval` WHERE `exams_eval`.`student` = ? AND `exams_eval`.`exam_id` = ?");
        $stm->execute(array($student_id, $exam_id));
        $result = $stm->fetch()[0];
        return $result;
    }

    /**
     * @param $exam_title
     * @return mixed
     *
     * TODO change exam_title for exam_id
     *
     */
    public function getExamId($exam_title)
    {
        $exam_title = iconv("utf-8", "cp1251", $exam_title);
        $stm =  $this->connection->prepare("SELECT * FROM `exams` WHERE `exam_title`=?");
        $stm->execute(array($exam_title));
        $exam_id = $stm->fetch()[0];
        return $exam_id;
    }

    /**
     * @param $student_id
     * @return mixed
     */
    public function countStudentExams($student_id)
    {
        $stm = $this->connection->prepare("SELECT COUNT(`exam_id`) FROM `exams_eval` WHERE `student`= ?");
        $stm->execute(array($student_id));

        return $stm->fetch()['0'];
    }

    /**
     * @param $student_id
     * @return mixed
     */
    public function getAverageMark($student_id)
    {
        $stm = $this->connection->prepare("SELECT AVG(`exam_eval`) FROM `exams_eval` WHERE `student`= ?");
        $stm->execute(array($student_id));

        return $stm->fetch()['0'];
    }

    /**
     * @param $group_number
     * @return mixed
     */
    public function countStudents($group_number)
    {
        $stm = $this->connection->prepare("SELECT COUNT(`id`) FROM `students` INNER JOIN `students_groups` ON(`students`.`id` = `students_groups`.`student`) WHERE `students_groups`.`student_group` = ?");
        $stm->execute(array($group_number));
        return $stm->fetch()['0'];
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

    public function setStudentsMark($students, $exam_title)
    {
        foreach ($students as &$student)
        {
            $student['mark'] = $this->getStudentMark($student['id'], $exam_title);
        }

        return $students;
    }

    public function setAverageData($students)
    {
        foreach ($students as &$student)
        {
            $student['count'] = $this->countStudentExams($student['id']);
            $student['mark'] = $this->getAverageMark($student['id']);
        }

        return $students;
    }
}