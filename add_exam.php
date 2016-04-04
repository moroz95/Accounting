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

           <legend>Добавить новый экзамен</legend>	
           <form action="/add_exam.php" method="POST" class="form-horizontal col-md-12">
            

            <div class="form-group">
               <label for="examName" class="col-md-3 control-label">Название экзамена</label>
               <div class="col-md-6">
                <input type="text" class="form-control" name="examName" id="examName" placeholder="Введите название экзамена">
            </div>
            <br>
            <br>

            <label for="examType" class="col-md-3 control-label">Тип испытания</label>
            <div class="col-md-6">
                <select name="examType" id="examType">
                   <option value="Экзамен">Экзамен</option>
                   <option value="Зачёт">Зачёт</option>
               </select>

           </div>
           <br>
           <br>
           <label for="examTeacher" class="col-md-3 control-label">Перподаватель</label>
           <div class="col-md-6">
            <input type="text" class="form-control" name="examTeacher" id="examTeacher" placeholder="Введите ФИО преподавателя">
        </div>
        <br>
        <br>
        <label for="examDate" class="col-md-3 control-label">Дата экзамена</label>
        <div class="col-md-6">
            <input type="date" class="form-control" name="examDate" id="examDate" required>
        </div>
        <br>
        <br>
        <br>
        <div class="col-md-10 col-md-offset-2">
            <button type="reset" class="btn btn-default">Отмена</button>
            <button type="submit" class="btn btn-primary">Добавить экзамен</button>
        </div>
    </div>
    
</form>
<?php   
					//Добавление экзамена
if(isset($_POST['examName']) && isset($_POST['examType'])&& isset($_POST['examDate']) && isset($_POST['examTeacher'])){

   $exam_id = mt_rand(0, 100000);
   $exam_title = $_POST['examName'];
   $exam_type = $_POST['examType'];
   $exam_date = $_POST['examDate'];
   $exam_teacher = $_POST['examTeacher'];

   $ins =  mysql_query("INSERT INTO `exams`(`id`, `exam_title`, `exam_type`, `exam_date`, `exam_teacher`) VALUES ('$exam_id','$exam_title','$exam_type','$exam_date','$exam_teacher')");

   header('Location:/exams.php');	
}	
?>

</div>	
</div>

</body>
</html>