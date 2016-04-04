<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Учёт успеваемости</title>
	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
</head>
<body>
	<?php
	require_once 'config.php';
	$group_numb = $_GET['group_select'];
	$exam_id = $_GET['exam_select'];

	$exam_title = mysql_query("SELECT `exam_title`,`exam_type` FROM `exams` WHERE `id`=$exam_id");
//echo "SELECT `exam_title` FROM `exams` WHERE `id`=$exam_id";
	$exam_t=mysql_fetch_array($exam_title);

	$exam_title = $exam_t['exam_title'];
	$exam_type = $exam_t['exam_type'];
//echo $exam_title;
	?>

	<div class="container col-md-12">
		<div class="menu col-md-3">
			<h2>Учёт успеваемости</h2>
			<ul>
				<li><a href="/">Группы</a></li>
				<li><a href="/exams.php">Экзамены</a></li>
				<li><a href="/stat.php">Статистика</a></li>
			</div>
			<div class="content col-md-9">
				<fieldset>
					<legend><h2>Ведомость испытания "<?= $exam_title ?>" группы №<?= $_GET['group_select']?></h2></legend>
				</fieldset>

				<h3>Вид испытания "<?= $exam_type ?>"</h3>
				<table class="table table-hover">
					<tr>
						<th>Фамилия</th>
						<th>Имя</th>
						<th>Отчество</th>
						<th>Номер зачётной книжки</th>
						<th>Оценка</th>
					</tr>
					<?php   

					$gr_num = $_GET['group_select'];
					$studs =  mysql_query("SELECT * FROM `students` INNER JOIN `students_groups` ON(`students`.`id` = `students_groups`.`student`) WHERE `students_groups`.`student_group` = $gr_num");

					while($row=mysql_fetch_array($studs)){
						echo '<tr>'.
						'<td>'.$row['sname'].'</td>'.
						'<td>'.$row['name'].'</td>'.
						'<td>'.$row['oname'].'</td>'.
						'<td>'.$row['gradebook_number'].'</td>';

							             //Получаем оценку студента за экзамен 
						$std_id = $row['id'];
						$evals = mysql_query("SELECT `exam_eval` FROM `exams_eval` WHERE `student`= $std_id AND `exam_id`='$exam_id'");
							             $evl=mysql_fetch_array($evals);//$evl['exam_eval'] - сама оценка (0-5)



							             if ($evl['exam_eval'] == '0') {
							             	echo '<td><i>Незачёт</i> </td>';
							             }
							             elseif ($evl['exam_eval'] == 1) {
							             	echo '<td><i>Зачёт</i> </td>';
							             }
							             elseif ($evl['exam_eval'] == 2) {
							             	echo '<td><i>Неудовлетворительно</i> </td>';
							             }		
							             elseif ($evl['exam_eval'] == 3) {
							             	echo '<td><i>Удовлетворительно</i> </td>';
							             }
							             elseif ($evl['exam_eval'] == 4) {
							             	echo '<td><i>Хорошо</i> </td>';
							             }
							             elseif ($evl['exam_eval'] == 5) {
							             	echo '<td><i>Отлично</i> </td>';
							             }		

							             elseif ($evl['exam_eval'] == "NULL") {
							             	echo '<td></td>';
							             }		             							             
							             else{
							             	echo '<td>'.$evl['exam_eval'].'</td>';
							             }
							             echo '</tr>';
							         }
							         

							         ?>
							     </table>
							 </div>	
							</div>

						</body>
						</html>