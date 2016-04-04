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
			</div>
			<div class="content col-md-9">
				<?php 
				$groupNumb = $_GET['group_number'];
				$groups =  mysql_query("SELECT * FROM `groups` WHERE `group_number`= $groupNumb ");
				$row=mysql_fetch_array($groups);
		 //var_dump($row);
				?>

				<legend>Редактировать группу</legend>	
				<form action="/edit_group.php" method="POST" class="form-horizontal col-md-12">
					<?php 
					//Записываем текущий номер группы
					SetCookie("gn",$_GET['group_number']);
					 $tecGn = $_COOKIE['gn'];//в куках текущий номер группы
					 ?>
					 <div class="form-group">
					 	<label for="groupNumber" class="col-md-3 control-label">Номер группы</label>
					 	<div class="col-md-6">
					 		<input type="number" class="form-control" name="groupNumber" id="groupNumber" placeholder="Введите номер новой группы" value= <?= $row['group_number']?>>
					 	</div>
					 	<br>
					 	<br>
					 	<label for="formationDate" class="col-md-3 control-label">Дата формирования</label>
					 	<div class="col-md-6">
					 		<input type="date" class="form-control" name="formationDate" id="formationDate" required  value= <?= $row['formation_date']?>>
					 	</div>
					 	<br>
					 	
					 	<br>
					 	<br>
					 	<div class="col-md-10 col-md-offset-2">
					 		<a href="edit_group.php?del_group=.'$tecGn'.">Удалить<span class="glyphicon glyphicon-trash"></span></a>
					 		<button type="reset" class="btn btn-default">Отмена изменений</button>
					 		<button type="submit" class="btn btn-primary">Отредактировать группу</button>
					 	</div>
					 </div>
					 
					</form>
					<?php   
			//обновление группы
					if(isset($_POST['groupNumber']) && isset($_POST['formationDate']) ){
					$group_n = $_POST['groupNumber'];//новый номер
					$group_d = $_POST['formationDate'];//новая дата
					$gn = $_COOKIE['gn'];//в куках текущий номер группы
					$result = mysql_query ("UPDATE groups SET group_number='$group_n', formation_date='$group_d' WHERE group_number='$gn'"); 

					header('Location:/');						
				}

				if(isset($_GET["del_group"])){
					$grForDelete = $_COOKIE['gn'];

					$count_studs = mysql_query("SELECT COUNT(`student`) FROM `students_groups` WHERE `student_group`=$grForDelete");
			 		$cou=mysql_fetch_array($count_studs);//$cou[0]
			 		$students_count = $cou[0];


			 		if ($students_count > 0) {
			 			//для всех студентов, которые обучались в этой группе меняем группу на Нулевую(0) она же Без группы (update запрос к таблице students_groups)
			 			$upd_group_to_zero = mysql_query("UPDATE `students_groups` SET `student_group`='0' WHERE `student_group`=$grForDelete");
				 		//Удаляем группу
			 			$del =  mysql_query( "DELETE FROM `groups` WHERE `group_number`='$grForDelete'");
			 			header('Location:/');
			 		}
			 		else{
			 			$del =  mysql_query( "DELETE FROM `groups` WHERE `group_number`='$grForDelete'");
			 			header('Location:/');		 			
			 		}

			 		
			 	}

			 	?>

			 </div>	
			</div>

		</body>
		</html>