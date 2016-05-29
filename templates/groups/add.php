<legend>Добавить новую группу</legend>
<form action="/group/add" method="POST" class="form-horizontal col-md-12">
<div class="form-group">
    <label for="groupNumber" class="col-md-3 control-label">Номер группы</label>
    <div class="col-md-6">
        <input type="number" class="form-control" name="groupNumber" id="groupNumber" placeholder="Введите номер новой группы">
    </div>
    <br>
    <br>
    <label for="formationDate" class="col-md-3 control-label">Дата формирования</label>
    <div class="col-md-6">
        <input type="date" class="form-control" name="formationDate" id="formationDate" required>
    </div>
    <br>
    <br>
    <br>
    <div class="col-md-10 col-md-offset-2">
        <button type="reset" class="btn btn-default">Отмена</button>
        <button type="submit" class="btn btn-primary">Добавить группу</button>
    </div>
</div>
</form>