if(isset($_GET["del_exam"])){
$studForDelete = $_COOKIE['std_id'];
$del =  mysql_query("DELETE FROM `students` WHERE `id`='$studForDelete'");
$del_evals =  mysql_query("DELETE FROM `exams_eval` WHERE `student`='$studForDelete'");

header('Location:/php-simple-accounting-system');
}
?>