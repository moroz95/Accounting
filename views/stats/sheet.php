<fieldset>
    <legend><h2>Ведомость испытания "<?= $exam_data['exam_title'] ?>" группы №<?= $_GET['group_select']?></h2></legend>
</fieldset>

<h3>Вид испытания "<?= $exam_data['exam_type'] ?>"</h3>
<table class="table table-hover">
    <tr>
        <th>Фамилия</th>
        <th>Имя</th>
        <th>Отчество</th>
        <th>Номер зачётной книжки</th>
        <th>Оценка</th>
    </tr>
    <?php foreach ($students as $row): ?>
    <?php
        echo '<tr>'.
            '<td>'.$row['sname'].'</td>'.
            '<td>'.$row['name'].'</td>'.
            '<td>'.$row['oname'].'</td>'.
            '<td>'.$row['gradebook_number'].'</td>';

        //Получаем оценку студента за экзамен
        $student_mark = $this->model->getStudentMark($row['id'],$exam_data['exam_title']);
        $marks = ['0' => 'Незачет', '1' => 'Зачет', '2' =>'Неудовлетворительно', '3' => 'Удовлетворительно', '4' => 'Хорошо', '5' => 'Отлично'];
        echo "<td><i>$marks[$student_mark]</i></td>";
        echo '</tr>';
    ?>
    <?php endforeach;?>
</table>
