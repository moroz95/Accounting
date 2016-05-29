<fieldset>
    <legend><h2> <?php ($group_number == 0) ? print "Студенты без группы" : print "Группа № ".$group_number; ?></h2></legend>
</fieldset>
<div class="btn-toolbar">
    <div class="btn-group" role="group">
        <a href="/student/add/<?= (int)$group_number ?>">
            <button class='button btn btn-warning' name='add_student'>Добавить студента</button>
        </a>
        <br>
    </div>
</div>
<table class="table table-hover">
    <tr>
        <th>Фамилия</th>
        <th>Имя</th>
        <th>Отчество</th>
        <th>Дата рождения</th>
        <th>Номер зачётной книжки</th>
        <th>Когда поступил(а)</th>
        <th>Редактировать</th>
    </tr>
    <?php foreach ($rows as $row){
        echo "<tr>
        <td>{$row['sname']}</td>
        <td>{$row['name']}</td>
        <td>{$row['oname']}</td>
        <td>{$row['birthday']}</td>
        <td>{$row['gradebook_number']}</td>
        <td>{$row['income_year']}</td>";
        echo '<td><a href="/student/edit/'.$row[0].'">Редактировать<span class="glyphicon glyphicon-edit"></span></a></td></tr>';
    }
    ?>
</table>