<h2>Успеваемость группы №<?= $_GET['group_select']?></h2>

<table class="table table-hover">
    <tr>
        <th>Фамилия</th>
        <th>Имя</th>
        <th>Отчество</th>
        <th>Номер зачётной книжки</th>
        <th>Экзаменов сдано</th>
        <th>Средний балл</th>
    </tr>
    <?php foreach ($students as $row): ?>
    <?php
        echo '<tr>'.
            '<td>'.$row['sname'].'</td>'.
            '<td>'.$row['name'].'</td>'.
            '<td>'.$row['oname'].'</td>'.
            '<td>'.$row['gradebook_number'].'</td>';
        
        echo '<td>'.$this->model->countStudentExams($row['id']).'</td>';
        echo '<td>'.$this->model->getAverageMark($row['id']).'</td>';
        echo '</tr>';
    ?>
    <?php endforeach;?>
</table>