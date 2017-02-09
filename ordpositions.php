<?php
    require 'init.php';

    include $root.'/header.php';

    print_r($_POST);

    $cfk = $_POST['cust-info'];
    $oname = $_POST['ord-name'];
    $odate = $_POST['ord-date'];
    $firsum = 0;

    $query = "INSERT INTO zakaz (name, date, customer, sum) VALUES ('$oname', '$odate', '$cfk', '$firsum')"; //uniqueness check of name needed!!!!!
     if(!($result = mysqli_query($link, $query))){
         echo '<br>MySQLi error: '.mysqli_error($link);
    } else mysqli_free_result($result);
    $query = "SELECT id FROM zakaz WHERE name = '$oname'";
          if(!($result = mysqli_query($link, $query))){
          echo '<br>MySQLi error: '.mysqli_error($link);
      } else {
        $zakid = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
      }

    $query = "SELECT name FROM customers WHERE id = '$cfk'";
      if(!($result = mysqli_query($link, $query))){
          echo '<br>MySQLi error: '.mysqli_error($link);
      } else {
        $cname = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
      }
      /*
    $query = "SELECT materials.name, materials.price, zakaz_contents.quantity, materials.price*zakaz_contents.quantity as stoimost FROM road_signs.zakaz_contents, road_signs.materials  WHERE idzakaza = '$zakid['idzakaz']' AND zakaz_contents.id_materials = materials.idmaterials
                UNION ALL
               SELECT road_signs_catalog.name, road_signs_catalog.price, zakaz_contents.quantity, road_signs_catalog.price*zakaz_contents.quantity as stoimost FROM road_signs.zakaz_contents, road_signs.road_signs_catalog  WHERE idzakaza = '$zakid['idzakaz']' AND zakaz_contents.id_road_signs = road_signs_catalog.idroad_signs_catalog;"
     if(!($result = mysqli_query($link, $query))){
          echo '<br>MySQLi error: '.mysqli_error($link);
      } else {
         while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
         $rows[] = $row;
         }
         mysqli_free_result($result);
         mysqli_close($link);
      }*/
      $i = 0;

?>

					  <!-- Datatable Intended -->
                        <h2>Customer:<?php echo $cname['name']?></h2> <!--assumed string while is actulally array-->
                        <h2>Name: <?php echo $oname?></h2>
                        <h2>Date: <?php echo $odate?></h2>
					 <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>№</th>
                          <th>Name</th>
                          <th>Price</th>
                          <th>Quantity</th>
                          <th>Sum</th>
                          <th>Remove</th>
                        </tr>
                      </thead>

                      <tbody>

                      </tbody>
                    </table>

                    <div class="col-md-2 col-sm-2 col-xs-12">
                       <a href="newpos.php"><button type="button" class="btn btn-success btn-sm">Add new</button></a>
                     </div>
ADD NEW BUTTON HERE -> goes to a new form, returns after to this page            SUMBIT BUTTON HERE ->goes to a pdf


<?php
include $root.'/footer.php';
?>
