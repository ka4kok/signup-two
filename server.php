<?php

session_start();
require_once 'conf.php';

$toReturn = [
    'status' => 1,
    'errors' => [],
    'data' => ''
];

require_once 'checkUser.php';

$userName = isset($_SESSION['name']) ? $_SESSION['name'] : '';
$userPassword = isset($_SESSION['password']) ? $_SESSION['password'] : '';

$checkUser = checkAuth($userName, $userPassword);

if ($checkUser) {
    $toReturn['status'];
}else {
    $toReturn['status'] = 0;
    $toReturn['errors'][] = 'Такого имени или пароля нет';
}

echo json_encode($toReturn);

?>