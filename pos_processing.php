<?php
    require 'init.php';

    $tabtype = $_POST['type']; 
    $name = $_POST['naimen'];
    $price = $_POST['cena'];
    $qnty = $_POST['kolvo'];
    $mask = $_POST['mask'];

    if($tabtype == 'materials'){
        $query = "INSERT INTO $tabtype (name, price, quantity) VALUES ('$name', '$price', '$qnty')";
    }
    elseif($tabtype == 'road_signs_catalog'){
        $mask = !empty($mask)? "'$mask'":"NULL";
        $query = "INSERT INTO $tabtype (name, price, masks) VALUES ('$name', '$price', $mask)";
    }
    $result = mysqli_query($link, $query);

    $redirect = isset($_SERVER['HTTP_REFERER'])? 'neworder.php':'neworder.php'; 
    header("Location: $redirect"); 
    exit();
?>
