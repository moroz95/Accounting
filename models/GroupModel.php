<?php

/**
 * Class GroupModel
 *
 * Extends Core Model
 * @uses $connection from core Model
 *
 * @package Group
 * @subpackage Model
 */


class GroupModel extends Model
{
    /**
     * @param  string $sort ASC or DESC sort
     * @return array  $rows groups number
     */
    public function getGroupNumbers($sort)
    {
        $group_numbers = array();
        
        if ($sort == "DESC")
        {
            $stmt = $this->connection->query("select group_number from groups order by group_number DESC");
        }
        else
        {
            $stmt = $this->connection->query("select group_number from groups order by group_number ASC");
        }

        $group_numbers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $group_numbers;
    }

    /**
     * @param  integer $group_number current group number
     * @return array   $row          group information
     */
    public function getGroupData($group_number)
    {
        $group_data = array();
        $stm = $this->connection->prepare("SELECT * FROM `groups` WHERE `group_number`= ? ");
        $stm->execute(array($group_number));
        $group_data = $stm->fetch();

        return $group_data;
    }

    /**
     * @param integer $group_number current group number
     * @param integer $new_number   new group number
     * @param string  $date         new date
     *
     * @return boolean
     */
    public function updateGroup($group_number, $new_number, $date)
    {
        $stm = $this->connection->prepare("UPDATE groups SET group_number=:new_number, formation_date=:date WHERE group_number=:group_number");
        return $stm->execute(array('new_number'=>$new_number,'date'=>$date, 'group_number'=>$group_number));
    }

    /**
     * @param integer $group current group number
     */
    public function deleteGroup($group)
    {
        $stm = $this->connection->prepare("SELECT COUNT(`student`) FROM `students_groups` WHERE `student_group`=?");
        $stm->execute(array($group));
        $students_count = $stm->fetch()[0];

        $stm = $this->connection->prepare("DELETE FROM `groups` WHERE `group_number`=?");
        $stm->execute(array($group));

        if ($students_count > 0) {
            $stm = $this->connection->prepare("UPDATE `students_groups` SET `student_group`='0' WHERE `student_group`=?");
            $stm->execute(array($group));
        }

    }

    /**
     * @param integer $new_number new group number to add
     * @param string  $date       new date for the new group
     * @return boolean
     */
    public function addGroup($new_number, $date)
    {
        $stm = $this->connection->prepare("select COUNT(`group_number`) from `groups` WHERE `group_number` = ?");
        $stm->execute(array($new_number));
        $group_count = $stm->fetch()[0];
        if ($group_count[0] == 0) {
            $stm = $this->connection->prepare("INSERT INTO `accounting_performance`.`groups` (`group_number`, `formation_date`, `is_delete`) VALUES (?, ?, '')");
            return $stm->execute(array($new_number, $date));
        }
        else return false;
    }

    /**
     * @param  integer $group_number group to show
     * @return array   $rows         students data
     */
    public function getStudents($group_number)
    {
        $rows = array();
        $stm = $this->connection->prepare("SELECT * FROM `students` INNER JOIN `students_groups` ON(`students`.`id` = `students_groups`.`student`) WHERE `students_groups`.`student_group` = ?");
        $stm->execute(array((int)$group_number));
        while ($row = $stm->fetch()) {
            $rows[] = $row;
        }
        return $rows;
    }

}