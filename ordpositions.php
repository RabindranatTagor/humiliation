<?php
    require 'init.php';

    include $root.'/header.php';

    echo '<br><br>';
    print_r($_POST);
    echo '<br><br>';

    //order info
    $customer = $_POST['cust-info'];
    $oname = $_POST['ord-name'];
    $odate = $_POST['ord-date'];
    $sum = $_POST['sum-tot'];

    //order input
    $query = "INSERT INTO zakaz (name, date, customer, sum) VALUES ('$oname', STR_TO_DATE('$odate', '%m/%d/%Y'), '$customer', '$sum')"; //ебучая закрывающая скобка я проебал пол часа или час

    if ($result = mysqli_query($link, $query)) mysqli_free_result($result);
    else echo '<br>MySQLi error: '.mysqli_error($link);


    $query = "SELECT * FROM zakaz WHERE name = '$oname'";
    if ($result = mysqli_query($link, $query)) {
        $info = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        echo $info['idzakaz']'<br>';
        echo $info ['name'];
    }
    else echo '<br>:26 MySQLi error: '.mysqli_error($link);

    //order_positions info
    $zid = $info['idzakaz'];
    $pname = $_POST['pos-name'];
    $ptype = $_POST['pos-type'];
    $pqnty = $_POST['pos-quantity'];

    //echoes
    for ($i = 0; $i <count($pname); $i++){
        if ($ptype[$i] == "materials"){
            $query = "INSERT INTO zakaz_contents (idzakaza, id_road_signs, id_materials, quantity) VALUES('$zid', NULL, '$pname[$i]', $pqnty[$i])";
            echo '<br>'.$query.'<br>';
            if ($result = mysqli_query($link, $query)) mysqli_free_result($result);
            else echo '<br> MySQLi error: '.mysqli_error($link);
            $query = "UPDATE materials SET quantity = quantity - '$pqnty[$i]' WHERE idmaterials = '$pname[$i]'";
            echo '<br>'.$query.'<br>';
            if ($result = mysqli_query($link, $query)) mysqli_free_result($result);
            else echo '<br> MySQLi error: '.mysqli_error($link);
        }
        elseif($ptype[$i] == "road_signs_catalog"){
            $query = "INSERT INTO zakaz_contents (idzakaza, id_road_signs, id_materials, quantity) VALUES('$zid', '$pname[$i]', NULL, $pqnty[$i])";
            if ($result = mysqli_query($link, $query)) mysqli_free_result($result);
            else echo '<br>:41 MySQLi error: '.mysqli_error($link);
            $query = "SELECT masks FROM road_signs_catalog WHERE idroad_signs_catalog = '$pname[$i]'";
            if ($result = mysqli_query($link, $query)) {
                $m = mysqli_fetch_assoc($result);
                $mask = $m['masks'];
                mysqli_free_result($result);
                if(!is_null($mask)){
                    $query = "UPDATE materials SET quantity = quantity - '$pqnty[$i]' WHERE idmaterials = '$mask'";
                    echo '<br>'.$query.'<br>';
                    if ($result = mysqli_query($link, $query)) mysqli_free_result($result);
                    else echo '<br> MySQLi error: '.mysqli_error($link);
                }
            }
            else echo '<br>:41 MySQLi error: '.mysqli_error($link);
        }
    }

    $redirect = isset($_SERVER['HTTP_REFERER'])? "/invoice.php/?id=$zid":"/invoice.php/?id=$zid";
    header("Location: $redirect");
    exit();

?>


<?php
include $root.'/footer.php';
?>
