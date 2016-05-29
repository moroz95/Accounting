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
        $stm = $this->connection->prepare("SELECT * FROM `students` WHERE `id`= ? ");
        $stm->execute(array($student_id));
        $this->student_data = $stm->fetch();
        return $this->student_data;
    }

    /**
     * @param  integer $student_id
     * @return int
     */
    public function getGroupNumber($student_id)
    {
        $stm = $this->connection->prepare("SELECT `student_group` FROM `students_groups` WHERE `student`= ? ");
        $stm->execute(array($student_id));
        $current_group = $stm->fetch();
        return (int)$current_group['student_group'];
    }

    /**
     * @param  integer $student_id
     * @return array
     */
    public function getSimilarGroups($student_id)
    {
        ($this->student_data) ?: $this->student_data = $this->studentDataById($student_id);
        $income = $this->student_data['income_year'];
        $stm = $this->connection->prepare("SELECT * FROM `groups` WHERE `formation_date`= ? ");
        $stm->execute(array($income));
        $similar_groups = $stm->fetchAll();
        return $similar_groups;
    }

    /**
     * @param $student_id
     * @return bool
     */
    public function deleteStudent($student_id)
    {
        $stm = $this->connection->prepare("DELETE FROM `students` WHERE `id`=?");
        $stm->execute(array($student_id));
        $stm_2 = $this->connection->prepare("DELETE FROM `exams_eval` WHERE `student`=?");
        $stm_2->execute(array($student_id));
        return ($stm && $stm_2);
    }

    /**
     *
     * TODO Implement transaction
     *
     * @param $student_id
     * @param $data
     *
     * @return bool
     */
    public function updateStudent($student_id, $data)
    {
        $stm = $this->connection->prepare("UPDATE `students` SET `name`=?,`sname`=?,`oname`=?,`birthday`=?,`gradebook_number`=?  WHERE `id`= ?");
        $stm->execute(array($data['studName'], $data['studSname'], $data['studOname'], $data['studBirth'], $data['studGradebook'], $student_id));

        $stm_2 = $this->connection->prepare("UPDATE `students_groups` SET `student_group`=? WHERE `student`= ?");
        $stm_2->execute(array($data['studGroup'], $student_id));

        return ($stm && $stm_2);
    }

    /**
     * @param $group_number
     * @param $data
     * @return bool
     */
    public function addStudentToGroup($group_number, $data)
    {
        extract($data);

        $stm = $this->connection->prepare("SELECT * FROM `groups` WHERE `group_number`= ? ");
        $stm->execute(array($group_number));

        if ($student = $stm->fetch())
        {
            $income_year = $student[1];
            $stm = $this->connection->prepare("INSERT INTO `students`(`name`, `sname`, `oname`, `birthday`, `gradebook_number`, `income_year`) VALUES (?, ?, ?, ?, ?, ?)");
            $stm->execute(array($studName, $studSname,$studOname,$studBirth, $studGradebook, $income_year));

            $stm_2 = $this->connection->prepare("SELECT * FROM `students` WHERE `name`=? AND `sname`=? AND `oname`=? AND `gradebook_number`=?");
            $stm_2->execute(array($studName, $studSname, $studOname, $studGradebook));
            $student_id = $stm_2->fetch()[0];

            $stm_3 = $this->connection->prepare("INSERT INTO `students_groups`(`student`, `student_group`) VALUES (?, ?)");
            $stm_3->execute(array($student_id, $group_number));

            return $stm && $stm_2 && $stm_3;
        }
        else return false;

    }
}