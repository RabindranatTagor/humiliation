<?php
    require 'init.php';

    include $root.'/header.php';

    print_r($_POST);
    //order info
    $customer = $_POST['cust-info'];
    $oname = $_POST ['ord-name'];
    $odate = $_POST['ord-date'];
    $sum = $_POST['sum-tot'];

    //order input
    $query = "INSERT INTO zakaz (name, date, customer, sum)VALUES ('$oname', STR_TO_DATE('$odate', '%m/%d/%Y'), '$customer', '$sum'";
    $result = mysqli_query($link, $query);
    mysqli_free_result($result);
    

    $query = "SELECT * FROM zakaz WHERE name = '$oname'";
    $result = mysqli_query($link, $query);
    $info = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    
    //order_positions info
    $zid = $info['id'];
    $pname = $_POST['pos-name[]'];
    $ptype = $_POST['pos-type[]'];
    $pqnty = $_POST['pos-quantity[]'];

    for ($i = 0; $i <count($pname); $i++){
        if ($ptype[$i] == "materials"){
            $query = "INSERT INTO zakaz_contents (idzakaza, id_road_signs, id_materials, quantity) VALUES('$zid', NULL, '$pname[$i]', $pqnty[$i])";
            $result = mysqli_query($link, $query);
            mysqli_free_result($result);
        }
        elseif($ptype[$i] == "road_signs_catalog"){
            $query = "INSERT INTO zakaz_contents (idzakaza, id_road_signs, id_materials, quantity) VALUES('$zid', '$pname[$i]', NULL, $pqnty[$i])";
            $result = mysqli_query($link, $query);
            mysqli_free_result($result);            
        }
    }
    

//    $redirect = isset($_SERVER['HTTP_REFERER'])? 'neworder.php':'neworder.php'; 
//    header("Location: $redirect"); 
//    exit();

?>

ADD NEW BUTTON HERE -> goes to a new form, returns after to this page            
SUMBIT BUTTON HERE ->goes to a pdf

<?php
include $root.'/footer.php';
?>
