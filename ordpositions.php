<?php
    require 'init.php';

    include $root.'/header.php';

    $cfk = $_POST['cust-info']; 
    $oname = $_POST['ord-name'];
    $odate = $_POST['ord-date'];
    $firsum = 0;
/*
    $query = "INSERT INTO zakaz (name, date, customer, sum) VALUES ('$oname', '$odate', '$cfk', '$firsum')"; //uniqueness check of name needed!!!!!
    $result = mysqli_query($link, $query);
    mysqli_free_result($result);

    $query = "SELECT id FROM zakaz WHERE name = '$oname'";
    $result = mysqli_query($link, $query);
    $pfk = $result;
    mysqli_free_result($result);
    */
    $query = "SELECT name FROM customers WHERE id = '$cfk'";
    $result = mysqli_query($link, $query);
    $cname = mysqli_fetch_assoc($result);
    //print_r($cname);
    mysqli_free_result($result);
    mysqli_close($link);
?>

					  <!-- Datatable Intended -->
                        Customer:<?php echo $cname['name']?> <!--assumed string while is actulally array-->
                        Name: <?php echo $oname?>
                        Date: <?php echo $odate?>
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
                        <tr>
                          <td>1</td>
                          <td>Enter existing position from tables: materials.name OR road_signs_catalog.name OR add brand new position</td>
                          <td>Here goes materials.price OR road_signs.catalog.price depending on Name choice</td>
                          <td>Enter it manually</td>
                          <td>= Price*Quantity</td>
                          <td>Checkbox?</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>SQUARE BLUE SIGN</td>
                          <td>1000</td>
                          <td>10</td>
                          <td>10 0000</td>
                          <td>Checkbox?</td>
                        </tr>
                      </tbody>
                    </table>


<?php
include $root.'/footer.php';
?>