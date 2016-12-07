<?php
    require 'init.php';

        if(!empty($_REQUEST['name'])){
            $zakaz_name = $_REQUEST['name'];
            $totalcost = 0; //итоговая сумма 
            $query = "SELECT zakaz.zakaz_name, zakaz_contents.zakaz_contents_quantity*materials.materials_price as stoimost from zakaz, zakaz_contents, materials where zakaz.idzakaz=zakaz_contents.zakaz_contents_idzakaza and zakaz_contents.zakaz_contents_id_materials = materials.idmaterials and zakaz.zakaz_name='$zakaz_name'
                      UNION ALL
                      SELECT zakaz.zakaz_name, zakaz_contents.zakaz_contents_quantity*road_signs_catalog.road_signs_catalog_price as stoimost from zakaz, zakaz_contents, road_signs_catalog where zakaz.idzakaz=zakaz_contents.zakaz_contents_idzakaza and zakaz_contents.zakaz_contents_id_road_signs = road_signs_catalog.idroad_signs_catalog and zakaz.zakaz_name='$zakaz_name';"; // запрос высчитывает общую стоимость каждой позиции в заказе
            $result = mysqli_query($link, $query);
            while ($row = mysqli_fetch_row($result)) {
                $totalcost+=$row[1];
            }
            mysqli_free_result($result);

           $query = "UPDATE zakaz SET zakaz_sum = '$totalcost' WHERE zakaz_name = '$zakaz_name'"; //Обновляем значение ячейки
           $result = mysqli_query($link, $query);
           mysqli_free_result($result);

           $query = "SELECT zakaz_name, zakaz_sum FROM zakaz WHERE zakaz_name = '$zakaz_name'"; //чек изменений
           $result = mysqli_query($link, $query);
            while ($row = mysqli_fetch_row($result)) {
                echo $row[0]." ".$row[1];
                }
           mysqli_free_result($result);
        }
    else echo mysqli_error($link)

   
?>