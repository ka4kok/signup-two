<?php
require_once 'conf.php';
$data = $_POST;

if (!empty($data)) {
    $errors = array();

    if (empty($data['name'])) {
        $errors[] = 'Введите имя';
    } if (empty($data['age'])) {
        $errors[] = 'Введите возраст';
    } if (empty($data['password'])) {
        $errors[] = 'Введите пароль';
    } if (empty($errors)) {

        $userName = $data['name'];
        $userAge = $data['age'];
        $userPassword = md5($data['password'] . $salt);

        require_once 'checkUser.php';
        $checkUser = checkAuth($userName, $userPassword);

        if ($checkUser) {
            $errors[] = 'Такой пользаватель уже есть';
        } else {
            $query = "INSERT INTO users (name, age, password)
                      VALUES ('$userName','$userAge','$userPassword')";
            require_once 'connectDB.php';
            mysqli_close($connect);
            header('Location: /index.php');
        }
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

        <form action="/signup.php" method="post">
            Введите имя: <input type="text" name="name" value="<?= isset($data['name']) ? trim($data['name']) : ''?>"> <br><br>
            Введите возраст: <input type="number" name="age" value="<?= isset($data['age']) ? trim($data['age']) : ''?>"> <br><br>
            Введите пароль: <input type="text" name="password" value="<?= isset($data['password']) ? trim($data['password']) : ''?>"> <br><br>
            <input type="submit" value="Зарегистрироваться">
        </form>
    </div>
</div>

</body>
</html>
