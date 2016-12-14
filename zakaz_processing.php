<?php
    require 'init.php';

        if(!empty($_REQUEST['name'])){
            $zakaz_name = $_REQUEST['name'];
            //здесь надо вставить проверку, чтобы нейм заказа существовал, если не существует - предложить создать новый.

            /* первая ф-я суммируется заказ */
            $totalcost = 0; //итоговая сумма 
            $query = "SELECT zakaz.name, zakaz_contents.quantity*materials.price as stoimost from zakaz, zakaz_contents, materials where zakaz.idzakaz=zakaz_contents.idzakaza and zakaz_contents.id_materials = materials.idmaterials and zakaz.name='$zakaz_name'
                      UNION ALL
                      SELECT zakaz.name, zakaz_contents.quantity*road_signs_catalog.price as stoimost from zakaz, zakaz_contents, road_signs_catalog where zakaz.idzakaz=zakaz_contents.idzakaza and zakaz_contents.id_road_signs = road_signs_catalog.idroad_signs_catalog and zakaz.name='$zakaz_name';"; // запрос высчитывает общую стоимость каждой позиции в заказе
            $result = mysqli_query($link, $query);
            while ($row = mysqli_fetch_row($result)) {
                $totalcost+=$row[1];
            }
            mysqli_free_result($result);

           $query = "UPDATE zakaz SET sum = '$totalcost' WHERE name = '$zakaz_name'"; //Обновляем значение ячейки
           $result = mysqli_query($link, $query);
           mysqli_free_result($result);

           $query = "SELECT name, sum FROM zakaz WHERE name = '$zakaz_name'"; //чек изменений
           $result = mysqli_query($link, $query);
            while ($row = mysqli_fetch_row($result)) {
                echo $row[0]." ".$row[1];
                }
           mysqli_free_result($result); 

           /*вторая ф-я: перерасчет материалов в заказе*/
           
           $query = "SELECT zakaz.idzakaz, zakaz_contents.id_materials, zakaz_contents.quantity from zakaz_contents, zakaz where zakaz_contents.idzakaza = zakaz.idzakaz and zakaz.name = '$zakaz_name' and zakaz_contents.id_materials is not null";
           $result = mysqli_query($link, $query);
           while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) { //сохраняется результат селекта в массив
                $rows[] = $row;
                }
           mysqli_free_result($result);

           foreach($rows as $row){ //перерасчет
            $query = "UPDATE materials SET quantity = quantity - '$row[2]' WHERE idmaterials = '$row[1]'"; //нужно вставить куда-то уведомление если квонтити <10
            $result = mysqli_query($link, $query);
            mysqli_free_result($result);
           }


           /*третья ф-я: перерасчет материалов через товары в заказе (для некоторых знаков расходуется одна маска, это д.б. отражено)*/
           $query = "select zakaz.name, zakaz_contents.quantity, road_signs_catalog.idroad_signs_catalog, materials.idmaterials FROM zakaz INNER JOIN zakaz_contents ON zakaz.idzakaz = zakaz_contents.idzakaza INNER JOIN road_signs_catalog ON zakaz_contents.id_road_signs = road_signs_catalog.idroad_signs_catalog INNER JOIN materials ON road_signs_catalog.masks = materials.idmaterials WHERE zakaz.name = '$zakaz_name'";
           $result = mysqli_query($link, $query);
           while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) { //сохраняется результат селекта в массив
                $rows[] = $row;
                }
           mysqli_free_result($result);

           foreach($rows as $row){ //перерасчет
            $query = "UPDATE materials SET quantity = quantity - '$row[1]' WHERE idmaterials = '$row[3]'"; //нужно вставить куда-то уведомление если квонтити <10
            $result = mysqli_query($link, $query);
            mysqli_free_result($result);
           }
        }
    else echo mysqli_error($link)

   //здесь нужно закрывать коннект к бд? алсо код можно неплохо оптимизировать, но это все потом. главное что работает
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
