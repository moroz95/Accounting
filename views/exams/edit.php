<legend>Редактировать информацию о экзамене</legend>
<form action="/exam/update/<?= $exam_id ?>" method="POST" class="form-horizontal col-md-12">
    <div class="form-group">
        <label for="examName" class="col-md-3 control-label">Название экзамена</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="examName" id="examName"  value= <?= $row['exam_title']?> >
        </div>
        <br>
        <br>
        <label for="examType" class="col-md-3 control-label">Тип испытания</label>
        <div class="col-md-6">
            <select name="examType" id="examType">
                <?php
                if ($row['exam_type'] == 'Зачёт') {
                    echo "
					 				<option value='Зачёт'>Зачёт</option>
					 				<option value='Экзамен'>Экзамен</option>
					 				";
                } else {
                    echo "
					 				<option value='Экзамен'>Экзамен</option>
					 				<option value='Зачёт'>Зачёт</option>
					 				";
                }

                ?>
            </select>

        </div>
        <br>
        <br>
        <label for="examTeacher" class="col-md-3 control-label">Перподаватель</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="examTeacher" id="examTeacher" placeholder="Введите ФИО преподавателя" value= <?= $row['exam_teacher']?> >
        </div>
        <br>
        <br>
        <label for="examDate" class="col-md-3 control-label">Дата экзамена</label>
        <div class="col-md-6">
            <input type="date" class="form-control" name="examDate" id="examDate" required  value= <?= $row['exam_date']?> >
        </div>
        <br>
        <br>
        <br>
        <div class="col-md-10 col-md-offset-2">
            <a href="/exam/delete/<?= $exam_id ?>">Удалить<span class="glyphicon glyphicon-trash"></span></a>
            <button type="reset" class="btn btn-default">Отмена</button>
            <button type="submit" class="btn btn-primary">Отредактировать экзамен</button>
        </div>
    </div>

</form>
</div>	