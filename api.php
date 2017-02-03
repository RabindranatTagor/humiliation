<?php
    require 'init.php';

   if ($_REQUEST['pos-name']) {
       $pname = $_REQUEST['pos-name'];
       $tname = $_REQUEST['type'];
       $query = "SELECT price FROM $tname WHERE name = '$pname'";
       
       if(!($result = mysqli_query($link, $query))){
           echo '<br>MySQLi error: '.mysqli_error($link);    
          } else {
            $price = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
            mysqli_close($link);
            echo $price['price'];
            $mnoj = $price['price'];            
         }                
    }

    if($_REQUEST['pos-quantity']){
        $qnty = $_REQUEST['pos-quantity'];
        $sum = $mnoj*$qnty;
        echo $sum;
    }

?>
