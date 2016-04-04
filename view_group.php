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
					<legend><h2>
						<?php 
						if ($_GET['group_number'] == 0) {
							echo "Студенты без группы";
						}
						else{
							echo "Группа № ".$_GET['group_number']; 
						}
						?>
					</h2></legend>
				</fieldset>
				<div class="btn-toolbar">
					<div class="btn-group" role="group">
			<?php echo "
			<form action=/add_student.php?group_number=".$group_numb." method='post'>";?>
				<button class='button btn btn-warning' name='add_student'>Добавить студента</button>
			</form>
			
			
			<br>
		</div>
	</div>
	<table class="table table-hover">
		<tr>
			<th>Фамилия</th>
			<th>Имя</th>
			<th>Отчество</th>
			<th>Дата рожения</th>
			<th>Номер зачётной книжки</th>
			<th>Когда поступил(а)</th>
			<th>Редактировать</th>
		</tr>
		<?php   

						$gr_num = $_GET['group_number'];
						$studs =  mysql_query("SELECT * FROM `students` INNER JOIN `students_groups` ON(`students`.`id` = `students_groups`.`student`) WHERE `students_groups`.`student_group` = $gr_num");

						while($row=mysql_fetch_array($studs)){
							echo '<tr>'.
							'<td>'.$row['sname'].'</td>'.
							'<td>'.$row['name'].'</td>'.
							'<td>'.$row['oname'].'</td>'.
							'<td>'.$row['birthday'].'</td>'.
							'<td>'.$row['gradebook_number'].'</td>'.
							'<td>'.$row['income_year'].'</td>'.
							'<td><a href="edit_stud.php?stud_id='.$row[0].' ">Редактировать <span class="glyphicon glyphicon-edit">	             
						</span></a></td>'.
						'</tr>';
					}
					//}

					while($row=mysql_fetch_array($studs))
					{
						echo '<tr>'.
						'<td>'.$row['sname'].'</td>'.
						'<td>'.$row['name'].'</td>'.
						'<td>'.$row['oname'].'</td>'.
						'<td>'.$row['birthday'].'</td>'.
						'<td>'.$row['gradebook_number'].'</td>'.
						'<td>'.$row['income_year'].'</td>'.
						'<td><a href="edit_stud.php?stud_id='.$row[0].' ">Редактировать <span class="glyphicon glyphicon-edit">	             
					</span></a></td>'.
					'</tr>';
				}
				
					/*
					SELECT * FROM `students` INNER JOIN `students_groups` ON(`students`.`id` = `students_groups`.`student`) WHERE `students_groups`.`student_group` = 1
					*/   
					?>
				</table>
			</div>	
		</div>

	</body>
	</html>