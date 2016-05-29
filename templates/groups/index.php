<fieldset>
    <legend><h2>Группы</h2></legend>
</fieldset>
<div class="btn-toolbar">
    <div class="btn-group" role="group">
        <a href="/group/index/DESC">
            <button class="button btn btn-primary" name="desc_sort"> Сортировка по убыванию DESC</button>
        </a>

        <a href="/group/index/ASC">
            <button href="/group/index/ASC" class="button btn btn-primary" name="asc_sort">Сортировка по возрастанию
                ASC
            </button>
        </a>

        <a href="/group/add">
            <button href="/group/index/add" class="button btn btn-warning" name="add_group">Добавить</button>
        </a>
        <br>
    </div>
</div>
<table class="table table-hover">
    <tr>
        <th>Номер группы</th>
        <th>Редактировать</th>
    </tr>
    <?php
    foreach ($group_numbers as $row) {
        echo "<tr><td><a href='/group/view/{$row['group_number']}'> {$row['group_number']}</a></td>";
        echo "<td><a href='/group/edit/{$row['group_number']}''>Редактировать <span class='glyphicon glyphicon-edit'></span></a></td></tr>";
    }
    ?>
</table>
