<?php
session_start();

$data = $_POST;

if ( !empty($data) ) {
    $errors = array();

    if (empty($data['name'])) {
        $errors[] = 'Введите имя';
    } if (empty($data['age'])) {
        $errors[] = 'Введите возраст';
    } if (empty($errors)) {
        $userName = isset($_SESSION['name']) ? $_SESSION['name'] : '';
        $formName = isset($data['name']) ? $data['name'] : '';
        $formAge = isset($data['age']) ? $data['age'] : '';

        $query = "UPDATE `users` 
              SET name='$formName', age='$formAge'
              WHERE name='$userName'
              ";
        require_once 'connectDB.php';

        $result = mysqli_query($connect, $query);

        if ($result) {
            echo '<div style="color: green; text-align: center">Изменения прошли успешно</div>';
        } else {
            echo '<div style="color: red; text-align: center">Ошибка изменений</div>';
        }
        mysqli_close($connect);
    }
}

?>

<html>
<head>

</head>
<body>

<div class="box" style="display: flex; justify-content: center">
    <div>

        <?php if ( isset($errors) ) {?>
            <span style="color: red">
            <?= array_shift($errors) ?>
        </span>
        <?php } ?>



        <form action="/modify.php" method="post">
            <?php

            require_once 'checkUser.php';
            $userName = isset($_SESSION['name']) ? $_SESSION['name'] : '';
            $defName = getName($userName);
            $defAge = getAge($userName)

            ?>
            Изменить имя: <input type="text" name="name"  value="<?= isset($defName) ? $defName: ''?>"> <br><br>
            Изменить возраст: <input type="number" name="age"  value="<?=  isset($defAge) ? $defAge: '' ?>"> <br><br>
            <input type="submit"value="Редактировать">
            <a href="/index.php">На главную</a>
        </form>
    </div>
</div>

</body>
</html>