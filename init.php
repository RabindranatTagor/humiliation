+<?php

$link = mysqli_connect("127.0.0.1", "root", "Haegtessa", "road_signs");  //connect check - okay

if (!$link) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . '<br>';
    echo "Код ошибки errno: " . mysqli_connect_errno() . '<br>';
    echo "Текст ошибки error: " . mysqli_connect_error() . '<br>';
    exit;
}

$root = $_SERVER["DOCUMENT_ROOT"];
?>