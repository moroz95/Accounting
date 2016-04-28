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
        $groups = mysqli_query($this->connection, "select group_number from `groups` order by group_number $sort");
        while ($row = mysqli_fetch_array($groups)) {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * @param  integer $group_number current group number
     * @return array   $row          group information
     */
    public function getGroupData($group_number)
    {
        $groups =  mysqli_query($this->connection, "SELECT * FROM `groups` WHERE `group_number`= $group_number ");
        $row = mysqli_fetch_array($groups);
        return $row;
    }

    /**
     * @param integer $group_number current group number
     * @param integer $new_number   new group number
     * @param string  $date         new date
     */
    public function update($group_number, $new_number, $date)
    {
        mysqli_query($this->connection, "UPDATE groups SET group_number='$new_number', formation_date='$date' WHERE group_number='$group_number'");
    }

    /**
     * @param integer $group current group number
     */
    public function delete($group)
    {
        $students_count = mysqli_query($this->connection, "SELECT COUNT(`student`) FROM `students_groups` WHERE `student_group`=$group");
        $temp = mysqli_fetch_array($students_count);
        $students_count = $temp[0];
        mysqli_query($this->connection, "DELETE FROM `groups` WHERE `group_number`='$group'");

        if ($students_count > 0) {
            mysqli_query($this->connection, "UPDATE `students_groups` SET `student_group`='0' WHERE `student_group`=$group");
        }

    }

    /**
     * @param integer $new_number new group number to add
     * @param string  $date       new date for the new group
     * @return boolean
     */
    public function add($new_number, $date)
    {
        $group = mysqli_query($this->connection, "select COUNT(`group_number`) from `groups` WHERE `group_number` = $new_number");
        $group = mysqli_fetch_array($group);

        if ($group[0] > 0) {
            return false;
        }
        else {
            return mysqli_query($this->connection, "INSERT INTO `accounting_performance`.`groups` (`group_number`, `formation_date`, `is_delete`) VALUES ('$new_number', '$date', '')");
        }
    }

    /**
     * @param  integer $group_number group to show
     * @return array   $rows         students data
     */
    public function viewStudents($group_number)
    {
        $group_number = (int)$group_number;
        $students =  mysqli_query($this->connection, "SELECT * FROM `students` INNER JOIN `students_groups` ON(`students`.`id` = `students_groups`.`student`) WHERE `students_groups`.`student_group` = $group_number ");
        while ($row = mysqli_fetch_array($students)) {
            $rows[] = $row;
        }
        return $rows;
    }

}