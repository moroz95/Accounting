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

	$group_numb = $_GET['group_number'];
	$exam_tit = $_GET['exam_title'];
	?>
	<?php 
			//Находим запись о экзамене
	$exam =  mysql_query("SELECT * FROM `exams` WHERE `exam_title`='$exam_tit'");
	$ex_row=mysql_fetch_array($exam);
			$id_exam = $ex_row[0];//exam_id для проставления оценок
			$type_exam = $ex_row['exam_type'];//тип испытания (Экзамен или Зачёт)

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

						<h2>Испытание "<?= $_GET['exam_title']?>" группы №<?= $_GET['group_number']?></h2>
						<form action=<?php echo "view_exam_group.php?exam_id=".$id_exam."" ?> method="POST" class="col-md-12">
							<table class="table table-hover">
								<tr>
									<th>Фамилия</th>
									<th>Имя</th>
									<th>Отчество</th>
									<th>Оценка</th>
								</tr>
								<?php   

								$gr_num = $_GET['group_number'];
								$studs =  mysql_query("SELECT * FROM `students` INNER JOIN `students_groups` ON(`students`.`id` = `students_groups`.`student`) WHERE `students_groups`.`student_group` = $gr_num");
			 // Нужно получить тип испытания. В зависимости от того, экзамен или зачёт выводим разные селекты(зачёт/экзамен или неуд - отлично)
								$exa_type = mysql_query(" SELECT `exam_type` FROM `exams` WHERE `exam_title`='$exam_tit' ");
			$ext = mysql_fetch_array($exa_type);//$ext[0] - тип испытания
			

		    //В качестве атрибута name у select используем row['student_id'] или $row[0]
			while($row=mysql_fetch_array($studs)){

				echo
				'<tr>'.
				'<td>'.$row['sname'].'</td>'.
				'<td>'.$row['name'].'</td>'.
				'<td>'.$row['oname'].'</td>';

				if ($ext[0] == 'Зачёт') {
					//Доделать
					//Делаем запрос на оценку по такому-то экзамену у такого то студента
					//Если она уже есть, то делаем её selected
					//Делаем несколько if в зависимости от значения оценки
					//Например, если зачёт, то selected будет option зачёт 
					echo 
					'<td>
					<select name="'.$row[0].'">
						<option value="NULL">---</option>
						<option value="0">Незачёт</option>
						<option value="1">Зачёт</option>
					</select>
				</td>'
				;
			} 

			else {
				echo 
				'<td>
				<select name="'.$row[0].'">
					<option value="NULL">---</option>
					<option value="2">Неудовлетворительно</option>
					<option value="3">Удовлетворительно</option>
					<option value="4">Хорошо</option>
					<option value="5">Отлично</option>
				</select>
			</td>'
			;
		}
		echo'</tr>';
	}

	?>
</table>
<div class="col-md-10 col-md-offset-2">
	<button type="reset" class="btn btn-default">Отмена</button>
	<button type="submit" class="btn btn-primary">ok</button>
</div>

</form>

<?php
		//array_keys - Возвращает список из ключей массива (id студентов)
$keys = array_keys($_POST);
		 //Заполняем таблицу exams_eval оценками за текцщий экзамен
$exid = $_GET['exam_id'];

if (isset($_GET['exam_id'])) {
	for ($n=0; $n < count($keys); $n++) { 

			 	//ТЕСТЫ
			 	//--------------------------------------	

			  	//echo $keys[$n]." --> ".$_POST[$keys[$n]]." = ".$exid."<br>";
			  	//студент  --> оценка = id экзамена

			 	// echo "
			 	// 	INSERT INTO `exams_eval`(`exam_id`, `student`, `exam_eval`) VALUES 
			 	// 	(".$exid.",".$keys[$n].",".$_POST[$keys[$n]].")<br>
			 	// ";

			 	//--------------------------------------

				 	$a = $exid; //id экзамена
				 	$b = $keys[$n]; //студент 
				 	$c = $_POST[$keys[$n]]; //оценка

				 	//Проверяем, если у студента уже есть оценка по данному предмету, то обновляем её, чтобы избежать появления дупликатов в базе

				 	$eva = mysql_query("SELECT COUNT(`exam_eval`) FROM `exams_eval` WHERE `student`=$b AND `exam_id`=$a");
				 	$ev = mysql_fetch_array($eva);
				 	if ($ev[0] > 0) {
				 		$stud_eval= mysql_query("
				 			UPDATE `exams_eval` SET `exam_eval`=$c WHERE `student`=$b AND `exam_id`=$a
				 			");
				 		//echo "UPDATE `exams_eval` SET `exam_eval`=$c WHERE `student`=$b AND `exam_id`=$a";
				 	}
				 	else{
				 		$stud_eval= mysql_query("
				 			INSERT INTO `exams_eval`(`exam_id`, `student`, `exam_eval`) VALUES 
				 			($a,$b,$c)
				 			");
				 	}

				 }
				 header('Location: exams.php');
				}
				?>

			</div>	
		</div>

	</body>
	</html>