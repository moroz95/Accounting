<h2>Испытание "<?= $exam_title ?>" группы №<?= (int)$group_number ?></h2>
<form action="/exam/group/<?= $group_number."/{$exam_id}" ?>" method="POST" class="col-md-12">
    <table class="table table-hover">
        <tr>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
            <th>Оценка</th>
        </tr>

        <?php foreach ($rows as $row){
           echo "<tr><td>{$row['sname']}</td><td>{$row['name']}</td><td>{$row['oname']}</td>";
            if ($exam_type[0] == 'Зачёт') {
                $array = ["ноль" => '---', '0' => "Незачет", '1' => "Зачет"];
                echo "<td><select name='$row[0]'>";
                foreach ($array as $key => $value) {
                    if ($key == $row['mark']) {
                        echo "<option selected value='$key'>$value</option>";
                    } else {
                        echo "<option value='$key'>$value</option>";
                    }
                }
                echo "</select></td>";
            }
            else {
                $array = ["ноль" => '---', '2' => "Неудовлетворительно", '3' => "Удовлетворительно", '4' => "Хорошо", '5' => "Отлично"];
                echo "<td><select name='$row[0]'>";
                foreach ($array as $key => $value) {
                    if ($key == $row['mark']) {
                        echo "<option selected value='$key'>$value</option>";
                    } else {
                        echo "<option value='$key'>$value</option>";
                    }
                }
                echo "</select></td>";
            }

            echo "</tr>";
        }

            ?>
    </table>
    <div class="col-md-10 col-md-offset-2">
        <button type="reset" class="btn btn-default">Отмена</button>
        <button type="submit" class="btn btn-primary" name="submit">ok</button>
    </div>

</form>
