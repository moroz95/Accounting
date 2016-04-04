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
				<h2>Успеваемость группы №<?= $_GET['group_select']?></h2>

				<table class="table table-hover">
					<tr>
						<th>Фамилия</th>
						<th>Имя</th>
						<th>Отчество</th>
						<th>Номер зачётной книжки</th>
						<th>Экзаменов сдано</th>
						<th>Средний балл</th>
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

						$std_id = $row['id'];
						$ex = mysql_query("SELECT COUNT(`exam_id`) FROM `exams_eval` WHERE `student`= $std_id");
							             $exa = mysql_fetch_array($ex);//$exa['0'] - количество сданных экзаменов
							             echo '<td>'.$exa[0].'</td>';


							              //Получаем среднюю оценку студента за экзамен 
							             $evals = mysql_query("SELECT AVG(`exam_eval`) FROM `exams_eval` WHERE `student`= $std_id");
							             $evl=mysql_fetch_array($evals);//$evl['0'] - сама оценка

							             echo '<td>'.$evl[0].'</td>';

							             echo '</tr>';
							         }
							         ?>
		     </table>
		 </div>	
		</div>
</body>
</html>