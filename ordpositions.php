<?php
    require 'init.php';

    include $root.'/header.php';

    $cfk = $_POST['cust-info']; 
    $oname = $_POST['ord-name'];
    $odate = $_POST['ord-date'];

    $query = "INSERT INTO zakaz (name, date, customer, sum) VALUES ('$oname', '$odate', '$cfk', 0)"; //uniqueness check of name needed!!!!!
    $result = mysqli_query($link, $query);
    mysqli_free_result($result);

    $query = "SELECT id FROM zakaz WHERE name = '$oname'";
    $result = mysqli_query($link, $query);
    $pfk = $result;
    mysqli_free_result($result);

    $query = "SELECT name FROM customers WHERE id = '$cfk'";
    $result = mysqli_query($link, $query);
    $cname = $result;
    mysqli_free_result($result);
    mysqli_close($link);
?>



<?php
include $root.'/footer.php';
?>