<?php
$link = mysqli_connect("127.0.0.1", "root", "champl00", "road_signs");  //connect check - okay

if (!$link) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . '<br>';
    echo "Код ошибки errno: " . mysqli_connect_errno() . '<br>';
    echo "Текст ошибки error: " . mysqli_connect_error() . '<br>';
    exit;
}

echo "Соединение с MySQL установлено!" . '<br>';
echo "Информация о сервере: " . mysqli_get_host_info($link) . '<br>';
?>