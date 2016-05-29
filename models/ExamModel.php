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
    public function getExamsData($sort)
    {
        if ($sort == "DESC")
        {
            $stmt = $this->connection->query("select * from `exams`  order by exam_date DESC");
        }
        else
        {
            $stmt = $this->connection->query("select * from `exams`  order by exam_date ASC");
        }

        $exams = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $exams;

    }

    /**
     * @param $exam_id
     * @return array
     */
    public function getExamDataById($exam_id)
    {
        $exam_data = array();
        $stm = $this->connection->prepare("SELECT * FROM `exams` WHERE `id`= ? ");
        $stm->execute(array($exam_id));
        $exam_data = $stm->fetch();
        return $exam_data;
    }

    /**
     * @param $data
     * @param $exam_id
     * @return bool
     */
    public function updateExam($data, $exam_id)
    {
        $stm = $this->connection->prepare("UPDATE exams SET exam_title=:examName, exam_type=:examType,exam_date=:examDate,exam_teacher=:examTeacher WHERE id=:exam_id");
        $stm->execute(array('examName'=>$data['examName'],'examType'=>$data['examType'], 'examDate'=>$data['examDate'], 'examTeacher' => $data['examTeacher'], 'exam_id' => $exam_id));
        return $stm->rowCount();
    }

    /**
     * @param $exam_id
     * @return bool|mysqli_result
     */
    public function delete($exam_id)
    {
        $stm = $this->connection->prepare("SELECT COUNT(`exam_id`) FROM `exams_eval` WHERE `exam_id`=?");
        $stm->execute(array($exam_id));
        $exams_count = $stm->fetch()[0];
        if ($exams_count > 0) {
            return false;
        } else {
            $stm = $this->connection->prepare("DELETE FROM `exams` WHERE `id`=?");
            return $stm->execute(array($exam_id));
        }

    }

    /**
     * @return array
     *
     */
    public function viewGroups()
    {
        $stm = $this->connection->query("select `group_number` from `groups`");
        while ($temp = $stm->fetch()) {
            $rows[] = $temp;
        }
        return $rows;
    }

    /**
     * @param $group_number
     * @return array
     */
    public function getExamDataByGroup($group_number)
    {
        $stm = $this->connection->prepare("SELECT * FROM `students` INNER JOIN `students_groups` ON(`students`.`id` = `students_groups`.`student`) WHERE `students_groups`.`student_group` = ?");
        $stm->execute(array($group_number));
        $rows = $stm->fetchAll();
        return $rows;
    }

    /**
     * @param $exam_id
     * @return array
     */
    public function getExamType($exam_id)
    {
        $stm = $this->connection->prepare("SELECT `exams`.`exam_type` from `exams` WHERE `exams`.`id`=?");
        $stm->execute(array($exam_id));
        $exam_type = $stm->fetch();
        return $exam_type;
    }

    /**
     * @param $exam_id
     * @return mixed
     *
     */
    public function getExamTitle($exam_id)
    {
        $stm = $this->connection->prepare("SELECT `exams`.`exam_title` from `exams` WHERE `exams`.`id` = ?");
        $stm->execute(array($exam_id));
        $exam_id = $stm->fetch();
        return $exam_id[0];
    }

    /**
     * @param $exam_id
     *
     * TODO remove double execute
     */
    public function updateStudentMarks($exam_id)
    {
        foreach (Validator::$post_data as $student_id => $mark) {
            if (Validator::isNumber($mark)) {
                $stm = $this->connection->prepare("SELECT COUNT(`exam_eval`) FROM `exams_eval` WHERE `student`=? AND `exam_id`=?");
                $stm->execute(array($student_id, $exam_id));
                $ev = $stm->fetch();
                if ($ev[0] > 0) {
                    $stm = $this->connection->prepare("UPDATE `exams_eval` SET `exam_eval`=? WHERE `student`=? AND `exam_id`=? ");
                    $stm->execute(array($mark, $student_id, $exam_id));
                } else {
                    $stm = $this->connection->prepare("INSERT INTO `exams_eval`(`exam_id`, `student`, `exam_eval`) VALUES (?,?,?)");
                    $stm->execute(array($exam_id, $student_id, $mark));
                }
            }
        }
    }

    /**
     * @param $student_id
     * @param $exam_id
     * @return mixed
     */
    public function getStudentMark($student_id, $exam_id)
    {
        $stm = $this->connection->prepare("SELECT `exams_eval`.`exam_eval` FROM `exams_eval` WHERE `exams_eval`.`student` = ? AND `exams_eval`.`exam_id` = ?");
        $stm->execute(array($student_id, $exam_id));
        $result = $stm->fetch()[0];
        return $result;
    }

    /**
     * @param $data
     */
    public function addExam($data)
    {
        extract($data);
        $stm = $this->connection->prepare("INSERT INTO `exams`(`exam_title`, `exam_type`, `exam_date`, `exam_teacher`) VALUES (?, ?, ?, ?)");
        $stm->execute(array($examName, $examType, $examDate, $examTeacher));
    }

    public function setStudentsMarks($students, $exam_id)
    {
        foreach ($students as &$student)
        {
            $student['mark'] = $this->getStudentMark($student[0], $exam_id);
        }
        return $students;
    }
}