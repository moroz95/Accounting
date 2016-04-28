<legend>Редактировать информацию о студенте</legend>
<form action="/student/update/<?=$student_id?>" method="POST" class="form-horizontal col-md-12">
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
                <?php if ($similar_groups): ?>
                    <?php foreach ($similar_groups as $value): ?>
                        <option <?php ($value['group_number'] == $current_group) AND print 'selected' ?> value="<?=$value['group_number']?>"><?=$value['group_number']?></option>
                    <?php endforeach ?>
                <?php endif ?>
            </select>
        </div>
        <br>
        <br>
        <div class="col-md-10 col-md-offset-2">
            <a href="/student/delete/<?=$student_id?>">Удалить<span class="glyphicon glyphicon-trash"></span></a>
            <button type="reset" class="btn btn-default">Отмена</button>
            <button type="submit" class="btn btn-primary">Изменить информацию о студенте</button>
        </div>
    </div>
</form>

