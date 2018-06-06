<?php

session_start();
require_once 'conf.php';
$data = $_POST;

if (!empty($data)) {
    $errors = array();

    if (empty($data['name'])) {
        $errors[] = 'Введите имя';
    } if (empty($data['password'])) {
        $errors[] = 'Введите пароль';
    } if (empty($errors)) {

        $userName = $data['name'];
        $userPassword = md5($data['password'] . $salt);

        require_once 'checkUser.php';
        $checkUser = checkAuth($userName, $userPassword);

        if ($checkUser) {
            $_SESSION['name'] = $userName;
            $_SESSION['password'] = $userPassword;
        }else {
            echo '<div style="color: red; text-align: center">Такого пользавателя нет</div>';
        }
    }
}

?>

<html>
<head>
    <script src="jquery.min.js"></script>
</head>
<body>

<div class="box" style="display: flex; justify-content: center">
    <div>

        <?php

        if(isset($_SESSION['name'])) { ?>
            <a href="/logout.php">Выйти</a>
         <?php } else { ?>

        <form action="index.php" method="post">
            Ваше имя: <input type="text" name="name"  value="<?= isset($data['name']) ? trim($data['name']) : ''?>"> <br><br>
            Ваш пароль: <input type="text" name="password"  value="<?= isset($data['password']) ? trim($data['password']) : null?>"> <br><br>
            <input type="submit" value="Войти">
            <a href="/signup.php">Зарегистрироваться</a>
        </form>

            <?php } ?>

        <button class="btn-data">Показать базу данных если авторизованы</button>

        <div class="data-base" style="border: 1px solid black; padding: 10px; display: none" >
            <?php

            $choice = isset($_SESSION['name']) ? 'modify.php' : 'signup.php';

            $query ='SELECT * FROM users';
            require_once 'connectDB.php';
            while ($row = mysqli_fetch_assoc($result)) {
                echo  '<a href="'.$choice.'">' .
                    $row['id'] . ' ' .
                    $row['name'] . ' ' .
                    $row['age'] . ' ' .
                    '</a><br>';
            }
            mysqli_close($connect);

            ?>
        </div>
    </div>
</div>

<script src="common.js"></script>
</body>
</html>



