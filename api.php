<?php
    require 'init.php';

    ini_set('html_errors',0);

   //return price
   if ( isset($_REQUEST['pos-name'])) {
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
         }                
    }

    //return sum
    if( isset($_REQUEST['pos-quantity'])) {
        $qnty = $_REQUEST['pos-quantity'];
        $price = $_REQUEST['price'];
        $sum = $price*$qnty;
        echo $sum;
    }

    //insert data
    if(isset($_REQUEST['pos-name1'])){
        $pname = $_REQUEST['pos-name1'];
        $tname = $_REQUEST['pos-type'];
        $qnty = $_REQUEST['pos-quant'];
        $sum = $_REQUEST['pos-sum'];

        $query = "SELECT MAX(idzakaz) FROM zakaz"; //FK for Zakaz
        $result = mysqli_query($link, $query);
        $zid = mysqli_fetch_assoc($result);
        mysqli_free_result($result);

        $query = "UPDATE zakaz SET sum += $sum WHERE idzakaz = $zid['id]";
        $result = mysqli_query($link, $query);
        mysqli_free_result($result);

        if($tname==='materials'){
            $query = "INSERT INTO zakaz_contents (idzakaza, id_materials, quantity) VALUES ($zid['id'], $pname, $qnty";
            $result = mysqli_query($link, $query);

            $redirect = isset($_SERVER['HTTP_REFERER'])? 'ordpositions.php':'ordpositions.php'; 
            header("Location: $redirect"); 
            exit();

        } elseif($tname === 'road_signs_catalog'){
            $query = "INSERT INTO zakaz_contents (idzakaza, id_road_signs, quantity) VALUES ($zid['id'], $pname, $qnty";
            $result = mysqli_query($link, $query);

            $redirect = isset($_SERVER['HTTP_REFERER'])? 'ordpositions.php':'ordpositions.php'; 
            header("Location: $redirect"); 
            exit();
        }
                          
         }                
        }
    }
?>
