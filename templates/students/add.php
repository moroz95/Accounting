<legend>Добавить нового студента</legend>
<form action="/student/add/<?= (int)$group_number ?>" method='POST' class='form-horizontal col-md-12'>
<div class="form-group">
    <label for="studSname" class="col-md-3 control-label">Фамилия</label>
    <div class="col-md-6">
        <input type="text" class="form-control" name="studSname" id="studSname" placeholder="Введите фамилию студента">
    </div>
    <br>
    <br>
    <label for="studName" class="col-md-3 control-label">Имя</label>
    <div class="col-md-6">
        <input type="text" class="form-control" name="studName" id="studName" placeholder="Введите имя студента">
    </div>
    <br>
    <br>

    <label for="studOname" class="col-md-3 control-label">Отчество</label>
    <div class="col-md-6">
        <input type="text" class="form-control" name="studOname" id="studOname" placeholder="Введите отчетво студента">
    </div>
    <br>
    <br>
    <label for="studGradebook" class="col-md-3 control-label">Номер зачётной книжки</label>
    <div class="col-md-6">
        <input type="number" class="form-control" name="studGradebook" id="studGradebook" placeholder="Введите номер новой группы">
    </div>
    <br>
    <br>
    <label for="studBirth" class="col-md-3 control-label">Дата рождкения</label>
    <div class="col-md-6">
        <input type="date" class="form-control" name="studBirth" id="studBirth" required>
    </div>
    <br>
    <br>
    <br>
    <div class="col-md-10 col-md-offset-2">
        <button type="reset" class="btn btn-default">Отмена</button>
        <button type="submit" class="btn btn-primary" name="submit">Добавить студента в группу</button>
    </div>
</div>

</form>

