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
	$sid = $_GET['stud_id'];
	SetCookie("std_id",$sid);
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
				<legend>Редактировать информацию о студенте</legend>	
				<form action="/edit_stud.php?stud_id=<?php echo $sid ?>" method="POST" class="form-horizontal col-md-12">
					<?php 

            		//делаем запрос на год, когда студента в первый раз добавили в группу  		
					$stud_id = $_GET['stud_id'];
					$qwe = $stud_id;
					
					$groups =  mysql_query("SELECT * FROM `students` WHERE `id`= $stud_id ");
					//Текущая группа студента с таким id 
					$current_group = mysql_query("SELECT `student_group` FROM `students_groups` WHERE `student`= $stud_id ");
					$row=mysql_fetch_array($groups);
					// var_dump($row);
					$income = $row['income_year'];//Получили дату формирования группы в которой студент числится сейчас
					// echo $income;

					//Ищем все группы у которых какая же дата формирования
					$similiar_groups =  mysql_query("SELECT * FROM `groups` WHERE `formation_date`='$income' ");

					$sim_groups = array();//в этот массив получаем все группы, подходящие условию запроса
					while($ro = mysql_fetch_array($similiar_groups)){
						$sim_groups[] = $ro;
					}
					//print_r($sim_groups);
					$current_g = mysql_fetch_array($current_group);
					//echo $current_g['student_group']; //текущая группа студента
					?>
					<div class="form-group">
						<label for="studSname" class="col-md-3 control-label">Фамилия</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="studSname" id="studSname" placeholder="Введите фамилию студента" value= <?= $row['sname']?> >
						</div>
						<br>
						<br>
						<label for="studName" class="col-md-3 control-label">Имя</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="studName" id="studName" placeholder="Введите имя студента" value= <?= $row['name']?> >
						</div>
						<br>
						<br>

						<label for="studOname" class="col-md-3 control-label">Отчество</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="studOname" id="studOname" placeholder="Введите отчетво студента" value= <?= $row['oname']?> >
						</div>
						<br>
						<br>
						<label for="studGradebook" class="col-md-3 control-label">Номер зачётной книжки</label>
						<div class="col-md-6">
							<input type="number" class="form-control" name="studGradebook" id="studGradebook" placeholder="Введите номер новой группы" value= <?= $row['gradebook_number']?> >
						</div>
						<br>
						<br>
						<label for="studBirth" class="col-md-3 control-label">Дата рождения</label>
						<div class="col-md-6">
							<input type="date" class="form-control" name="studBirth" id="studBirth" required value= <?= $row['birthday']?>>
						</div>
						<br>
						<br>

						<label for="studGroup" class="col-md-3 control-label">Изменить группу</label>
						<div class="col-md-6">
							<select name="studGroup" id="studGroup">
								<?php 
	                        	//Выводи список подходящих групп для перехода студента
								if ($sim_groups) {
									foreach ($sim_groups as $value) {
									    // print_r($value['group_number']);
									    //Выводи как selected группу в которой студент сейчас
										if ($value['group_number'] == $current_g['student_group']) {
											echo "
											<option selected value='".$value['group_number']."'>".	
												$value['group_number']."
											</option> ";									    	
										}
										else{
											echo "
											<option value='".$value['group_number']."'>".	
												$value['group_number']."
											</option> ";
										}
									}
								}
								?>
							</select>
						</div>
						<br>
						<br>
						<div class="col-md-10 col-md-offset-2">
							<a href="edit_stud.php?del_exam=.'$tecExId'.">Удалить<span class="glyphicon glyphicon-trash"></span></a>
							<button type="reset" class="btn btn-default">Отмена</button>
							<button type="submit" class="btn btn-primary">Изменить информацию о студенте</button>
						</div>
					</div>
				</form>
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
						
						header('Location:/');						
					}

					if(isset($_GET["del_exam"])){
						$studForDelete = $_COOKIE['std_id'];
						$del =  mysql_query("DELETE FROM `students` WHERE `id`='$studForDelete'");
						$del_evals =  mysql_query("DELETE FROM `exams_eval` WHERE `student`='$studForDelete'");

						header('Location:/');
					}
					?>

				</div>	
			</div>

		</body>
		</html>