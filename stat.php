<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Учёт успеваемости</title>
	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
	<script src="js/jquery-2.2.2.min.js" type="text/javascript"></script>

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
				<fieldset>
					<legend><h2>Статистика</h2></legend>
				</fieldset>
				<h3><b>Создать ведомость</b></h3>
				<!--В качестве параметров передаём например group_select=3&exam_select=0 -->
				<form action="exam_sheet.php" method="GET">
					<p>Выбор группы:
						<select name="group_select">
							<?php 
							$groups =  mysql_query("SELECT * FROM `groups`");
							if ($groups) {
								while($row=mysql_fetch_array($groups)){
									echo "
									<option value='".$row['group_number']."'>".	
										$row['group_number']."
									</option> ";
								}		   
							}
							?>
						</select>
						<select name="exam_select">
							<?php 
							$exams =  mysql_query("SELECT * FROM `exams`");
							if ($exams) {
								while($row=mysql_fetch_array($exams)){
									echo "
									<option value='".$row['id']."'>".	
										$row['exam_title']."
									</option> ";
								}		   
							}
							?>	
						</select>
						<input type="submit" value="Сформировать" />
					</p>
				</form>
				<!--В качестве параметра передаём например group_select=3 -->
				<h3><b>Успеваемость группы</b></h3>
				<form action="group_progress.php" method="GET">
					<p>Выбор группы:
						<select name="group_select">
							<?php 
							$groups =  mysql_query("SELECT * FROM `groups`");
							if ($groups) {
								while($row=mysql_fetch_array($groups)){
									echo "
									<option value='".$row['group_number']."'>".	
										$row['group_number']."
									</option> ";
								}		   
							}
							?>
						</select>
						<input type="submit" value="Сформировать" />
					</p>
				</form>
				<!--В качестве параметра передаём например group_select=3 -->
				<h3><b>Средняя успеваемость группы</b></h3>
				<form action="avg_group_progress.php" method="GET">
					<p>Выбор группы:
						<select name="group_select">
							<?php 
							$groups =  mysql_query("SELECT * FROM `groups`");
							if ($groups) {
								while($row=mysql_fetch_array($groups)){
									echo "
									<option value='".$row['group_number']."'>".	
										$row['group_number']."
									</option> ";
								}		   
							}
							?>
						</select>
						<input type="submit" value="Сформировать" />
					</p>
				</form>
    			</div>	
    		</div>

    	</body>
    	</html>