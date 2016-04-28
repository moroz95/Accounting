<?php
// echo "stud_id-".$stud_id;
// echo "wqe-".$qwe;

//Обновление информации студента
if(
    isset($_POST['studName']) &&
    isset($_POST['studSname']) &&
    isset($_POST['studOname']) &&
    isset($_POST['studGradebook']) &&
    isset($_POST['studBirth'])	&&
    isset($_POST['studGroup'])

){
    $stud_name = $_POST['studName'];
    $stud_sname = $_POST['studSname'];
    $stud_oname = $_POST['studOname'];
    $stud_gradebook = $_POST['studGradebook'];
    $stud_birth = $_POST['studBirth'];
    $stud_group_numb = $_GET['stud_group_numb'];//группа в которой студент сейчас
    $stud_new_group = $_POST['studGroup'];//группа в которую переводим студента


    echo $stud_name . " " .
        $stud_sname . " " .
        $stud_oname . " " .
        $stud_gradebook . " " .
        $stud_birth . " " .
        $stud_group_numb . " " .
        $stud_new_group
    ;


    //Делаем update информации о студенте в таблице students
    $a = mysql_query("UPDATE `students` SET `name`=$stud_name,`sname`=$stud_sname,`oname`=$stud_oname,`birthday`=$stud_birth,`gradebook_number`=$stud_gradebook  WHERE `id`= $stud_id");

    //Делаем update таблицы students_groups
    $b = mysql_query("UPDATE `students_groups` SET `student_group`=$stud_new_group WHERE `student`= $stud_id");

    header('Location:/php-simple-accounting-system');
}