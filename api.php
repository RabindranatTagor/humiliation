<?php
    require 'init.php';

    include $root.'/header.php';
    $pname = $_REQUEST['pos-name'];
    $tname = $_REQUEST['data-type'];
    $query = "SELECT price FROM '$tname' WHERE name = '$pname'";

    $result = mysqli_query($link, $query);
    
    $price = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    mysqli_close($link);

    echo $price[price];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        
    </body>
</html>

<?php
include $root.'/footer.php';
?>