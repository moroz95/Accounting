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
	$exam_title = $_GET['exam_title'];
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
					<legend><h2>Выберите группу для проведения испытания: <b><?= $_GET['exam_title']?></b></h2></legend>
				</fieldset>


				<?php   
					$groups =  mysql_query("select * from `groups`");

					while($row=mysql_fetch_array($groups)){
						echo '<a class="btn btn-info col-md-3" href=view_exam_group.php?group_number='.$row['group_number'].'&'.'exam_title='.$exam_title
						.'>'
						.$row['group_number'].'</a>';
					}


					while($row=mysql_fetch_array($groups))
					{
						echo '<a class="btn btn-info col-md-3" href=view_exam_group.php?group_number='.$row['group_number'].'&'.'exam_title='.$exam_title
						.'>'
						.$row['group_number'].'</a>';
					}
					?>

				</div>	
			</div>

		</body>
		</html>