<?php
    require 'init.php';

    include $root.'/header.php';

    $name = $_POST['custname']; 
    $inn = $_POST['custinn'];
    $kpp = $_POST['custkpp'];

    $query = "INSERT INTO customers (name, INN, KPP) VALUES ('$name', '$inn', '$kpp')";
    $result = mysqli_query($link, $query);
    mysqli_free_result($result);

    mysqli_close($link);
?>



<?php
include $root.'/footer.php';
?>