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
	?>

	<div class="container col-md-12">
		<div class="menu col-md-3">
			<h2>Учёт успеваемости</h2>
			<ul>
				<li><a href="/">Группы</a></li>
				<li><a href="/exams.php">Экзамены</a></li>
				<li><a href="/stat.php">Статистика</a></li>
			</ul>
		</div>
		<div class="content col-md-9">

			<legend>Редактировать информацию о экзамене</legend>	
			<?php
			$exam_id = $_GET['exam_id'];
			$exams =  mysql_query("SELECT * FROM `exams` WHERE `id`= $exam_id ");
			$row=mysql_fetch_array($exams);
			//var_dump($row);
			?>
			<form action="/edit_exam.php" method="POST" class="form-horizontal col-md-12">
				<?php 
					//Записываем текущий id экзамена
				SetCookie("exid",$_GET['exam_id']);
					 $tecExId = $_COOKIE['exid'];//в куках текущий id экзамена
					 ?>
					 <div class="form-group">
					 	<label for="examName" class="col-md-3 control-label">Название экзамена</label>
					 	<div class="col-md-6">
					 		<input type="text" class="form-control" name="examName" id="examName"  value= <?= $row['exam_title']?> >
					 	</div>
					 	<br>
					 	<br>

					 	<label for="examType" class="col-md-3 control-label">Тип испытания</label>
					 	<div class="col-md-6">
					 		<select name="examType" id="examType">
					 			<?php 
					 			if ($row['exam_type'] == 'Зачёт') {
					 				echo "
					 				<option value='Зачёт'>Зачёт</option>
					 				<option value='Экзамен'>Экзамен</option>
					 				";
					 			} else {
					 				echo "
					 				<option value='Экзамен'>Экзамен</option>
					 				<option value='Зачёт'>Зачёт</option>
					 				";
					 			}
					 			
					 			?>
					 		</select>

					 	</div>
					 	<br>
					 	<br>
					 	<label for="examTeacher" class="col-md-3 control-label">Перподаватель</label>
					 	<div class="col-md-6">
					 		<input type="text" class="form-control" name="examTeacher" id="examTeacher" placeholder="Введите ФИО преподавателя" value= <?= $row['exam_teacher']?> >
					 	</div>
					 	<br>
					 	<br>
					 	<label for="examDate" class="col-md-3 control-label">Дата экзамена</label>
					 	<div class="col-md-6">
					 		<input type="date" class="form-control" name="examDate" id="examDate" required  value= <?= $row['exam_date']?> >
					 	</div>
					 	<br>
					 	<br>
					 	<br>
					 	<div class="col-md-10 col-md-offset-2">
					 		<a href="edit_exam.php?del_exam=.'$tecExId'.">Удалить<span class="glyphicon glyphicon-trash"></span></a>
					 		<button type="reset" class="btn btn-default">Отмена</button>
					 		<button type="submit" class="btn btn-primary">Отредактировать экзамен</button>
					 	</div>
					 </div>
					 
					</form>
					<?php   

				//обновление экзамена
					if(isset($_POST['examName']) && isset($_POST['examType'])&& isset($_POST['examDate']) && isset($_POST['examTeacher'])){

					$exam_title = $_POST['examName'];//Новое название экзамена
					//echo $exam_title;
					$exam_type = $_POST['examType'];//новый тип экзамена
					//echo $exam_type;
					$exam_teacher = $_POST['examTeacher'];//Новый препод
					//echo $exam_teacher;
					$exam_date = $_POST['examDate'];//Новая дата 2016-03-02
					//echo $exam_date;
					$ExId = $_COOKIE['exid'];//в куках текущий id экзамена

					$result = mysql_query ("UPDATE exams SET exam_title='$exam_title', exam_type='$exam_type',exam_date='$exam_date',exam_teacher='$exam_teacher' WHERE id='$ExId'"); 

					header('Location:/exams.php');						
				}

				if(isset($_GET["del_exam"])){
					$exForDelete = $_COOKIE['exid'];
			 		//если проставлена хотя бы одна оценка по данному экзамену, то не удаляем его, а выводим предупреждение
					$count_evals = mysql_query("SELECT COUNT(`exam_id`) FROM `exams_eval` WHERE `exam_id`=$exForDelete");
			 		$cou=mysql_fetch_array($count_evals);//$cou[0]
			 		$exams_count = $cou[0];

			 		if ($exams_count > 0) {
			 			echo "Нельзя удалить экзамен. Есть проставленные оценки";
			 		}
			 		else{
			 			$del =  mysql_query( "DELETE FROM `exams` WHERE `id`='$exForDelete'");
			 			header('Location:/exams.php');			 			
			 		}

			 	}

			 	?>

			 </div>	
			</div>

		</body>
		</html>