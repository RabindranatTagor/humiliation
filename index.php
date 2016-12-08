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

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Overconfidence is a slow and isidious killer</title>
    </head>
    <body>
        <!--форма для внесения номера заказа-->
         <form id="form1" action="zakaz_processing.php" method="post"> 
           <p>Введите номер заказа</p>
           <p>Номер: <input name="name" placeholder="Например, Т-1-16"></p>
            <p><input type="submit" value="Отправить"></p>
        </form>
    </body>
</html>
