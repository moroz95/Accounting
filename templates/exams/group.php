<fieldset>
    <legend><h2>Выберите группу для проведения испытания: <b><?= $exam_title?></b></h2></legend>
</fieldset>

<?php foreach ($rows as $row): ?>
<?php echo '<a class="btn btn-info col-md-3" href="/exam/group/'.$row['group_number'].'/'.(int)$exam_id.'">'.$row['group_number'].'</a>'; ?>
<?php endforeach; ?>