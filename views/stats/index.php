<fieldset>
    <legend><h2>Статистика</h2></legend>
</fieldset>
<h3><b>Создать ведомость</b></h3>
<!--В качестве параметров передаём например group_select=3&exam_select=0 -->
<form action="/stat/sheet/" method="GET">
    <p>Выбор группы:
        <select name="group_select">
           <?php foreach ($groups as $row): ?>
                    <?php echo "<option value='{$row['group_number']}'> {$row['group_number']}</option> "; ?>
            <?php endforeach; ?>
        </select>
        <select name="exam_select">
            <?php foreach ($exams as $row): ?>
                    <?php echo "<option value='{$row['id']}'>{$row['exam_title']}</option> "; ?>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Сформировать" />
    </p>
</form>
<!--В качестве параметра передаём например group_select=3 -->
<h3><b>Успеваемость группы</b></h3>
<form action="/stat/progress/" method="GET">
    <p>Выбор группы:
        <select name="group_select">
            <?php foreach ($groups as $row): ?>
                <?php echo "<option value='{$row['group_number']}'> {$row['group_number']}</option> "; ?>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Сформировать" />
    </p>
</form>
<!--В качестве параметра передаём например group_select=3 -->
<h3><b>Средняя успеваемость группы</b></h3>
<form action="/stat/average/" method="GET">
    <p>Выбор группы:
        <select name="group_select">
            <?php foreach ($groups as $row): ?>
                <?php echo "<option value='{$row['group_number']}'> {$row['group_number']}</option> "; ?>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Сформировать" />
    </p>
</form>