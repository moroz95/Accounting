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
	$stud_group_numb = $_GET['group_number'];
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

			<legend>Добавить нового студента</legend>	
			<?php echo 
			"<form action='/add_student.php?stud_group_numb=".
			$_GET['group_number']
			."' method='POST' class='form-horizontal col-md-12'>";
			?>
			
			<?php   
				//Добавление студента в определенную группу
			if(
				isset($_POST['studName']) &&
				isset($_POST['studSname']) &&
				isset($_POST['studOname']) &&
				isset($_POST['studGradebook']) &&
				isset($_POST['studBirth'])
				){
				$stud_name = $_POST['studName'];
			$stud_sname = $_POST['studSname'];
			$stud_oname = $_POST['studOname'];
			$stud_gradebook = $_POST['studGradebook'];
			$stud_birth = $_POST['studBirth'];
			$stud_group_numb = $_GET['stud_group_numb'];

						/*
						echo $stud_name . " " .
							$stud_sname . " " .
							$stud_oname . " " .
							$stud_gradebook . " " .
							$stud_birth . " " .
							$stud_group_numb
							;
							*/
							

					//Делаем запрос к базе на год формирования группы в которую добавляем студента
							$studs =  mysql_query("SELECT * FROM `groups` WHERE `group_number`= $stud_group_numb");
							if ($row = mysql_fetch_array($studs)) {		
					 	$stud_income_year = $row[1];//$row[1] - дата формирования группы

					 	//Узнав эту дату записываем её как год поступления этого студента в таблицу students
					 	$result = mysql_query ("INSERT INTO `students`(`name`, `sname`, `oname`, `birthday`, `gradebook_number`, `income_year`) VALUES ('$stud_name','$stud_sname','$stud_oname','$stud_birth','$stud_gradebook','$stud_income_year')"); 

					 	//Связываем сдудента с группой (таблица students_groups)
					 	//Находим в таблице students только что добвленного предыдущей командой студента
					 	$query = mysql_query ("SELECT * FROM `students` WHERE `name`='$stud_name' AND `sname`='$stud_sname' AND `oname`='$stud_oname' AND`gradebook_number`='$stud_gradebook'");

					 	//Связываем студента и его группу
					 	$r = mysql_fetch_array($query);
					 	$std_id = $r[0];// id студента в таблице students
					 	//группа в которую добавили студента $stud_group_numb;
					 	$result_std_gr = mysql_query("INSERT INTO `students_groups`(`student`, `student_group`) VALUES ('$std_id','$stud_group_numb')");


					 	header('Location:/');						
					 } 
					 
					}


					?>
					<div class="form-group">
						<label for="studSname" class="col-md-3 control-label">Фамилия</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="studSname" id="studSname" placeholder="Введите фамилию студента">
						</div>
						<br>
						<br>
						<label for="studName" class="col-md-3 control-label">Имя</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="studName" id="studName" placeholder="Введите имя студента">
						</div>
						<br>
						<br>

						<label for="studOname" class="col-md-3 control-label">Отчество</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="studOname" id="studOname" placeholder="Введите отчетво студента">
						</div>
						<br>
						<br>
						<label for="studGradebook" class="col-md-3 control-label">Номер зачётной книжки</label>
						<div class="col-md-6">
							<input type="number" class="form-control" name="studGradebook" id="studGradebook" placeholder="Введите номер новой группы">
						</div>
						<br>
						<br>
						<label for="studBirth" class="col-md-3 control-label">Дата рождкения</label>
						<div class="col-md-6">
							<input type="date" class="form-control" name="studBirth" id="studBirth" required>
						</div>
						<br>
						<br>
						<br>
						<div class="col-md-10 col-md-offset-2">
							<button type="reset" class="btn btn-default">Отмена</button>
							<button type="submit" class="btn btn-primary">Добавить студента в группу</button>
						</div>
					</div>
					
				</form>


			</div>	
		</div>

	</body>
	</html>