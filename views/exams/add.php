<legend>Добавить новый экзамен</legend>
<form action="/exam/add" method="POST" class="form-horizontal col-md-12">


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
