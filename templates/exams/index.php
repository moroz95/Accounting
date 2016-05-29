<fieldset>
    <legend><h2>Экзамены</h2></legend>
</fieldset>
<div class="btn-toolbar">
    <div class="btn-group" role="group">

        <a href="/exam/index/DESC">
            <button class="button btn btn-primary" name="desc_sort"> Сортировка по убыванию DESC</button>
        </a>
        <a href="/exam/index/ASC">
            <button class="button btn btn-primary" name="asc_sort">Сортировка по возрастанию
                ASC
            </button>
        </a>
        <a href="/exam/add">
            <button class="button btn btn-warning" name="add_group">Добавить</button>
        </a>
        <br>
    </div>
</div>
<table class="table table-hover">
    <tr>
        <th>Название экзамена</th>
        <th>Тип испытания</th>
        <th>Дата</th>
        <th>Перподаватель</th>
        <th>Редактировать</th>
    </tr>
    <?php foreach ($exams as $row): ?>
        <?php
        echo '<tr>
                    <td><a href="/exam/view/' . $row['id'] . '">' . $row['exam_title'] . '</a></td>';
        echo "<td>{$row['exam_type']}</td>
                    <td>{$row['exam_date']}</td>
                    <td>{$row['exam_teacher']}</td>";
        echo '<td><a href="/exam/edit/' . $row['id'] . '">Редактировать<span class="glyphicon glyphicon-edit"></span></a></td>
                    </tr>';
        ?>
    <?php endforeach; ?>
</table>