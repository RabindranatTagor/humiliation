<?php
    require 'init.php';

    $query = "SELECT * FROM materials ORDER by idmaterials"; //here goes nothing

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
        <title></title>
    </head>
    <body>
        
    </body>
</html>
