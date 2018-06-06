<?php

function checkAuth($nameUser, $passUser) {
    $host = "localhost";
    $name = 'root';
    $password = '';
    $db = 'test';

    $query = "SELECT * FROM users
              WHERE name='$nameUser'";
    $connect = mysqli_connect($host, $name, $password, $db);

    if (!$connect) {
        die('Ошибка соединения: ' . mysqli_error());
    }
    $result = mysqli_query($connect, $query);

    $searchUser = mysqli_fetch_assoc($result);
    mysqli_close($connect);

    if ($nameUser == isset($searchUser['name']) ? $searchUser['name'] : '' &&
    $passUser == isset($searchUser['password']) ? $searchUser['password'] : '') {
        return true;
    } else {
        return false;
    }
}

function getName($nameUser) {
    $host = "localhost";
    $name = 'root';
    $password = '';
    $db = 'test';

    $query = "SELECT * FROM users
              WHERE name='$nameUser'";
    $connect = mysqli_connect($host, $name, $password, $db);

    if (!$connect) {
        die('Ошибка соединения: ' . mysqli_error());
    }
    $result = mysqli_query($connect, $query);

    $searchUser = mysqli_fetch_assoc($result);
    mysqli_close($connect);

    if ($nameUser == isset($searchUser['name']) ? $searchUser['name'] : '') {
        return $searchUser['name'];
    } else {
        return '';
    }
}

function getAge($nameUser) {
    $host = "localhost";
    $name = 'root';
    $password = '';
    $db = 'test';

    $query = "SELECT * FROM users
              WHERE name='$nameUser'";
    $connect = mysqli_connect($host, $name, $password, $db);

    if (!$connect) {
        die('Ошибка соединения: ' . mysqli_error());
    }
    $result = mysqli_query($connect, $query);

    $searchUser = mysqli_fetch_assoc($result);
    mysqli_close($connect);

    if ($nameUser == isset($searchUser['name']) ? $searchUser['name'] : '') {
        return $searchUser['age'];
    } else {
        return '';
    }
}