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
			<fieldset>
				<legend><h2>Группы</h2></legend>
			</fieldset>
			<div class="btn-toolbar">
				<div class="btn-group" role="group">

					<form action="/" method="post">
						<button class="button btn btn-primary" name="desc_sort">Сортировка по убыванию DESC</button>
					</form>
					<form action="/" method="post">
						<button class="button btn btn-primary" name="asc_sort">Сортировка по возрастанию ASC</button>
					</form>
					<form action="/add_group.php" method="post">
						<button class="button btn btn-warning" name="add_group">Добавить</button>
					</form>
					<br>
				</div>
			</div>
			<table class="table table-hover">
				<tr>
					<th>Номер группы</th>
					<th>Редактировать</th>
				</tr>
				<?php   
				if (isset($_POST['desc_sort']) || isset($_POST['asc_sort'])) {
					if (isset($_POST['desc_sort'])) {
						$groups =  mysql_query("select * from `groups` order by group_number DESC");

						while($row=mysql_fetch_array($groups)){
							echo '<tr>'.
							'<td><a href=view_group.php?group_number='.$row['group_number'].'>'
							.$row['group_number'].'</a>'.
							'</td>'.
							'<td><a href="edit_group.php?group_number='.$row['group_number'].' ">Редактировать <span class="glyphicon glyphicon-edit">					              
						</span></a></td>'.
						'</tr>';
					}
				}
				else {
					$groups =  mysql_query("select * from `groups` order by group_number ASC");

					while($row=mysql_fetch_array($groups)){
						echo '<tr>'.
						'<td><a href=view_group.php?group_number='.$row['group_number'].'>'
						.$row['group_number'].'</a>'.
						'</td>'.
						'<td><a href="edit_group.php?group_number='.$row['group_number'].' ">Редактировать <span class="glyphicon glyphicon-edit">					              
					</span></a></td>'.
					'</tr>';
				}
			} 
		}

		else{
			$groups =  mysql_query("select * from `groups`");

			while($row=mysql_fetch_array($groups)){
				echo '<tr>'.
				'<td><a href=view_group.php?group_number='.$row['group_number'].'>'
				.$row['group_number'].'</a>'.
				'</td>'.
				'<td><a href="edit_group.php?group_number='.$row['group_number'].' ">Редактировать <span class="glyphicon glyphicon-edit">					              
			</span></a></td>'.
			'</tr>';
		}
	}

	while($row=mysql_fetch_array($groups))
	{
		echo '<tr>'.
		'<td><a href=view_group.php?group_number='.$row['group_number'].'>'
		.$row['group_number'].'</a>'.
		'</td>'.
		'<td><a href="edit_group.php?group_number='.$row['group_number'].' ">Редактировать <span class="glyphicon glyphicon-edit">					              
	</span></a></td>'.
	'</tr>';
}

?>
</table>
</div>	
</div>

</body>
</html>