<?php
    require 'init.php';

    $mid = $_POST['mname']; 
    $mqnty = $_POST['remn-qnty'];

    $query = "UPDATE materials SET quantity = '$mqnty' WHERE idmaterials='$mid'";
    $result = mysqli_query($link, $query);

    $redirect = isset($_SERVER['HTTP_REFERER'])? 'remnants.php':'remnants.php'; 
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
