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
				<fieldset>
					<legend><h2>Экзамены</h2></legend>
				</fieldset>
				<div class="btn-toolbar">
					<div class="btn-group" role="group">

						<form action="/exams.php" method="post">
							<button class="button btn btn-primary" name="desc_sort">Сортировка по убыванию DESC</button>
						</form>
						<form action="/exams.php" method="post">
							<button class="button btn btn-primary" name="asc_sort">Сортировка по возрастанию ASC</button>
						</form>
						<form action="/add_exam.php" method="post">
							<button class="button btn btn-warning" name="add_group">Добавить</button>
						</form>
						<br>
					</div>
				</div>
				<table class="table table-hover">
					<tr>
						<th>Название экзамена</th>
						<th>Тип испытания</th>
						<th>Дата</th>
						<th>Перподаватель</th>
						<th>Редактировать</th>
					</tr>
					<?php   

				        if (isset($_POST['desc_sort']) || isset($_POST['asc_sort'])) {
				        	if (isset($_POST['desc_sort'])) {
				        		$exams =  mysql_query("select * from `exams`  order by exam_date DESC");

				        		while($row=mysql_fetch_array($exams)){
				        			echo '<tr>'.
				        			'<td><a href=view_exam.php?exam_title='.$row['exam_title'].'>'
				        			.$row['exam_title'].'</a>'.
				        			'</td>'.
				        			'<td>'.$row['exam_type'].'</td>'.
				        			'<td>'.$row['exam_date'].'</td>'.
				        			'<td>'.$row['exam_teacher'].'</td>'.
				        			'<td><a href="edit_exam.php?exam_id='.$row['id'].' ">Редактировать <span class="glyphicon glyphicon-edit">					
				        		</span></a>
				        	</td>'.
				        	'</tr>';
				        }
				    }
				    else {
				    	$exams =  mysql_query("select * from `exams`  order by exam_date ASC");

				    	while($row=mysql_fetch_array($exams)){
				    		echo '<tr>'.
				    		'<td><a href=view_exam.php?exam_title='.$row['exam_title'].'>'
				    		.$row['exam_title'].'</a>'.
				    		'</td>'.
				    		'<td>'.$row['exam_type'].'</td>'.
				    		'<td>'.$row['exam_date'].'</td>'.
				    		'<td>'.$row['exam_teacher'].'</td>'.
				    		'<td><a href="edit_exam.php?exam_id='.$row['id'].' ">Редактировать <span class="glyphicon glyphicon-edit">					
				    	</span></a>
				    </td>'.
				    '</tr>';
				}
			} 
		}

		else{
			$exams =  mysql_query("select * from `exams` ");
		    // $row=mysql_fetch_array($exams);
		    // var_dump($row);
			
			while($row=mysql_fetch_array($exams)){
				echo '<tr>'.
				'<td><a href=view_exam.php?exam_title='.$row['exam_title'].'>'
				.$row['exam_title'].'</a>'.
				'</td>'.
				'<td>'.$row['exam_type'].'</td>'.
				'<td>'.$row['exam_date'].'</td>'.
				'<td>'.$row['exam_teacher'].'</td>'.
				'<td><a href="edit_exam.php?exam_id='.$row['id'].' ">Редактировать <span class="glyphicon glyphicon-edit">					
			</span></a>
		</td>'.
		'</tr>';
	}
	
}

while($row=mysql_fetch_array($exams))
{
	echo '<tr>'.
	'<td><a href=view_exam.php?exam_title='.$row['exam_title'].'>'
	.$row['exam_title'].'</a>'.
	'</td>'.
	'<td>'.$row['exam_type'].'</td>'.
	'<td>'.$row['exam_date'].'</td>'.
	'<td>'.$row['exam_teacher'].'</td>'.
	'<td><a href="edit_exam.php?exam_id='.$row['id'].' ">Редактировать <span class="glyphicon glyphicon-edit">					
</span></a>
</td>'.
'</tr>';
}        
?>
</table>
</div>	
</div>

</body>
</html>