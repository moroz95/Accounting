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

			<legend>Добавить новую группу</legend>	
			<form action="/add_group.php" method="POST" class="form-horizontal col-md-12">
				
				<?php   
				//Добавление группы
				if(isset($_POST['groupNumber']) && isset($_POST['formationDate'])){
					$group_n = $_POST['groupNumber'];
					$group_d = $_POST['formationDate'];

						//Есть ли уже такая группа? 

					$group = mysql_query("select COUNT(`group_number`) from `groups` WHERE `group_number` = $group_n");
					$group_g = mysql_fetch_array($group);

					if ($group_g[0] > 0) {
						echo "Группа с таким номером уже есть, введите другой номер";
					}
					else{
						$ins =  mysql_query("INSERT INTO `accounting_performance`.`groups` (`group_number`, `formation_date`, `is_delete`) VALUES ('$group_n', '$group_d', '')");

						header('Location:/');
					}

				}
				
				?>
				<div class="form-group">
					<label for="groupNumber" class="col-md-3 control-label">Номер группы</label>
					<div class="col-md-6">
						<input type="number" class="form-control" name="groupNumber" id="groupNumber" placeholder="Введите номер новой группы">
					</div>
					<br>
					<br>
					<label for="formationDate" class="col-md-3 control-label">Дата формирования</label>
					<div class="col-md-6">
						<input type="date" class="form-control" name="formationDate" id="formationDate" required>
					</div>
					<br>
					<br>
					<br>
					<div class="col-md-10 col-md-offset-2">
						<button type="reset" class="btn btn-default">Отмена</button>
						<button type="submit" class="btn btn-primary">Добавить группу</button>
					</div>
				</div>
				
			</form>


		</div>	
	</div>

</body>
</html>