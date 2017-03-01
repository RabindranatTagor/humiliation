<?php
    require 'init.php';

    $ckey = $_POST['custname']; 
    $inn = $_POST['custinn'];
    $kpp = $_POST['custkpp'];

    $query = "INSERT INTO customers (name, INN, KPP) VALUES ('$name', '$inn', '$kpp')";
    $result = mysqli_query($link, $query);

    $redirect = isset($_SERVER['HTTP_REFERER'])? 'neworder.php':'neworder.php'; 
    header("Location: $redirect"); 
    exit();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        <p>FFFUUUUU</p>
    </body>
</html>
