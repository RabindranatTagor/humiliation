<?php
    require 'init.php';

    $query = "SELECT * FROM materials ORDER by idmaterials";

if ($result = mysqli_query($link, $query)) {

    /* fetch associative array */
    while ($row = mysqli_fetch_row($result)) {
        printf ("%s %s %s %s \n", $row[0], $row[1], $row[2], $row[3]);
    }

    /* free result set */
    mysqli_free_result($result);
}

    //считает общую сумму заказа и добавляет в соотв. столбец

    $query = "SELECT zakaz.zakaz_name, zakaz_contents.zakaz_contents_quantity*materials.materials_price as stoimost from zakaz, zakaz_contents, materials where zakaz.idzakaz=zakaz_contents.zakaz_contents_idzakaza and  zakaz_contents.zakaz_contents_id_materials = materials.idmaterials
UNION ALL
SELECT zakaz.zakaz_name, zakaz_contents.zakaz_contents_quantity*road_signs_catalog.road_signs_catalog_price as stoimost from zakaz, zakaz_contents, road_signs_catalog where zakaz.idzakaz=zakaz_contents.zakaz_contents_idzakaza and zakaz_contents.zakaz_contents_id_road_signs = road_signs_catalog.idroad_signs_catalog;"; // запрос высчитывает общую стоимость каждой позиции в заказе
    $totalcost = 0; //переменная для стоимости
    $zakaz_name = ''; //переменная для имени заказа

    $result = mysqli_query($link, $query);
    while($row = mysqli_fetch_array($result, MYSQLI_NUM)){ //заюзан массив
        $rows[]=$row;
    }
    mysqli_free_result($result);

    foreach($rows as $row){
        echo $row[0]." ".$row[1];
        $zakaz_name = $row[0]; //принимает значение имени
        $totalcost = $row[1]; //получает стоимость
        $query = "UPDATE zakaz SET zakaz_sum = zakaz_sum +'$totalcost' WHERE zakaz_name='$zakaz_name'"; //обновляет значение общей суммы заказа. при каждом прогоне ожидаемо удваивает итоговую сумму( впрочем теоретически это дело должно проходить единожды для каждого нового заказа, и блокироваться. а лучше как-то обнуляться, в расчете на то что придется вносить правки. 
        mysqli_query($link, $query);
        mysqli_free_result($result);
    }
    //просто проверка того что получилось
    $query = "SELECT * FROM zakaz ORDER BY idzakaz";
if ($result = mysqli_query($link, $query)) {

    /* fetch associative array */
    while ($row = mysqli_fetch_row($result)) {
        printf ("%s %s %s %s %s \n", $row[0], $row[1], $row[2], $row[3], $row[4]);
    }

    /* free result set */
    mysqli_free_result($result);
}


mysqli_close($link);
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
