<?php
    ini_set('display_errors','On');
     error_reporting('E_ALL');
    require 'init.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/TimeHelper.php';

    $mon = $_REQUEST['rmonth'];
    $year = $_REQUEST['ryear'];

    //order query
    $query = "SELECT zakaz.*, customers.name FROM zakaz, customers WHERE YEAR(date)='$year' AND MONTH(date)='$mon' AND customers.id=zakaz.customer ORDER BY idzakaz";
    if ($result = mysqli_query($link, $query)) {
    while ($order = mysqli_fetch_array($result, MYSQLI_NUM)) {
         $orders[] = $order;
         }
    mysqli_free_result($result);
    } else echo "Нет данных за указанный период";
    
    $sumtotal=0;
    //contents query
    foreach($orders as $order){
        $sumtotal+=$order[4];
        $clients[]=$order[5];
        $ids = $order[0];
            $query = "SELECT * FROM zakaz_contents WHERE idzakaza='$ids'";
        if ($result = mysqli_query($link, $query)) {
            while ($content = mysqli_fetch_array($result, MYSQLI_NUM)) {
            $contents[] = $content;
            }
            mysqli_free_result($result);
        } else echo '<br>MySQLi error: '.mysqli_error($link);
    }
    //positions query
    foreach($contents as &$content){
        if(!empty($content[2])){
            $rsid=$content[2];
            $query="SELECT name FROM road_signs_catalog WHERE idroad_signs_catalog='$rsid'";
            if($result=mysqli_query($link, $query)){
                $rsign=mysqli_fetch_assoc($result);
                mysqli_free_result($result);
                $content[2] = $rsign['name'];
                $goods[]=$rsign['name'];
            } else echo '<br>MySQLi error: '.mysqli_error($link);
        }
        elseif(!empty($content[3])){
            $mid=$content[3];
            $query="SELECT name FROM materials WHERE idmaterials='$mid'";
            if($result=mysqli_query($link, $query)){
                $material=mysqli_fetch_assoc($result);
                mysqli_free_result($result);
                $content[3] = $material['name'];
                $goods[]=$material['name'];
            } else echo '<br>MySQLi error: '.mysqli_error($link);
        }
    }
    unset($content);

    ini_set('display_errors','Off');
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="/invoice.css" />

<article id="report">
    <h2>Отчет за <?php echo "$mon.$year"?>г.</h2>
        <?php foreach($orders as $order){?>
            <strong>Заказ №<?php echo $order[1]?> от <?php echo $order[2]?>(<?php echo $order[4]?> р.)/<?php echo $order[5]?></strong><br>
            <?php foreach($contents as $content){
                if($content[1] == $order[0]){?>
                    <ul>
                        <li><?php echo "$content[2] $content[3]"?> - <?php echo $content[4]?> ед.</li>
                    </ul>
                <?php }?>
            <?php }?>
        <?php }?>
    <hr class = "black-line">
    <strong>Всего заказов за месяц:</strong> <?php echo count($orders)?> <br>
    <strong>На сумму:</strong> <?php echo $sumtotal?> р.
    <hr class = "black-line">
    <strong>Активность:</strong><br>
    <?php foreach(array_count_values($clients) as $key => $value){
     echo "Клиент $key - $value заказов" . '<br>';
    }?>
    <hr class = "black-line">
    <strong>Всего продано:</strong><br>
    <?php foreach(array_count_values($goods) as $key => $value){
        echo "$key - $value единиц" . '<br>';
    }?>
</article>