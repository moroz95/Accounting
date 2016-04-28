<fieldset>
    <legend><h2>Выберите группу для проведения испытания: <b><?= $_SESSION['exam_title']?></b></h2></legend>
</fieldset>

<?php foreach ($rows as $row): ?>
<?php echo '<a class="btn btn-info col-md-3" href="/exam/group/'.$row['group_number'].'">'.$row['group_number'].'</a>'; ?>
<?php endforeach; ?>