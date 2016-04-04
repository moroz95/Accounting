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
				<h2>Средняя успеваемость группы №<?= $_GET['group_select']?></h2>

				<?php   
				
						$sum_evals = 0; //Переменная для суммирования вех оценок
						$gr_num = $_GET['group_select'];


						$studs =  mysql_query("SELECT * FROM `students` INNER JOIN `students_groups` ON(`students`.`id` = `students_groups`.`student`) WHERE `students_groups`.`student_group` = $gr_num");
					    //Количество студентов в группе
						$std_count = mysql_query("SELECT COUNT(`id`) FROM `students` INNER JOIN `students_groups` ON(`students`.`id` = `students_groups`.`student`) WHERE `students_groups`.`student_group` = $gr_num");
					    $std_c = mysql_fetch_array($std_count);//$std_c['0'] - количество студентов в группе
					    $count_of_students = $std_c['0'];


					    while($row=mysql_fetch_array($studs)){
					             //Получаем среднюю оценку студента за экзамен 
					    	$std_id = $row['id'];
					    	$evals = mysql_query("SELECT AVG(`exam_eval`) FROM `exams_eval` WHERE `student`= $std_id");
					             $evl=mysql_fetch_array($evals);//$evl['0'] - сама оценка

					             //Суммируем средний балл каждого тудента 
					             $sum_evals = $sum_evals + $evl['0'];
					         }

					        //Делим просуммированные оценки на количество студентов в группе 
					         $avg_progress = $sum_evals/$count_of_students;
					         if ($avg_progress <= 2) {
					         	$status_group = "Безпробудные двоечники";
					         }
					         elseif ($avg_progress > 2 and $avg_progress <= 3) {
					         	$status_group = "Неудовлетворительно";
					         }
					         elseif ($avg_progress >= 3 and $avg_progress < 4) {
					         	$status_group = "Удовлетворительно";
					         }					       
					         elseif ($avg_progress >= 4 and $avg_progress < 5) {
					         	$status_group = "Хорошо";
					         }	
					         elseif ($avg_progress == 5) {
					         	$status_group = "Отлично";
					         }						            				                 

					        //Выводим результат
					         echo "<h4><b>Cчитается по формуле</b>:<br> Сумма средних баллов студентов группы (".$sum_evals.") / Количество студентов в группе (".$count_of_students.") = ".$avg_progress." (".$status_group.")</h4>";
					         
					         ?>

					     </div>	
					 </div>

					</body>
					</html>