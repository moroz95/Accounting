<legend>Редактировать группу</legend>
<form action="/group/edit/<?= $group_number ?>" method="POST" class="form-horizontal col-md-12">
    <div class="form-group">
        <label for="groupNumber" class="col-md-3 control-label">Номер группы</label>
        <div class="col-md-6">
            <input type="number" class="form-control" name="groupNumber" id="groupNumber" placeholder="Введите номер новой группы" value= <?= $group_data['group_number']?>>
        </div>
        <br>
        <br>
        <label for="formationDate" class="col-md-3 control-label">Дата формирования</label>
        <div class="col-md-6">
            <input type="date" class="form-control" name="formationDate" id="formationDate" required  value= <?= $group_data['formation_date']?>>
        </div>
        <br>

        <br>
        <br>
        <div class="col-md-10 col-md-offset-2">
            <a href="/group/delete/<?= $group_number ?>">Удалить<span class="glyphicon glyphicon-trash"></span></a>
            <button type="reset" class="btn btn-default">Отмена изменений</button>
            <button type="submit" class="btn btn-primary">Отредактировать группу</button>
        </div>
    </div>
</form>

