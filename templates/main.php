<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Учёт успеваемости</title>
	<!-- Bootstrap -->
	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<link href="/css/main.css" rel="stylesheet">
</head>
<body>
<div class="container col-md-12">
	<div class="menu col-md-3">
		<h2>Учёт успеваемости</h2>
		<ul>
			<li><a href="/group">Группы</a></li>
			<li><a href="/exam">Экзамены</a></li>
			<li><a href="/stat">Статистика</a></li>
		</ul>
	</div>
	<div class="content col-md-9">
		<?php if($error) echo "<div class='alert alert-danger' role='alert'>$error</div>" ?>
		<?= $content ?>
	</div>
</div>

</body>
</html>