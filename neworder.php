<?php
    require 'init.php';

    include $root.'/header.php';

    $query = "SELECT id, name FROM customers ORDER BY id";

    $result = mysqli_query($link, $query);

    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
         $rows[] = $row;
         }

    mysqli_free_result($result);

        $query = "SELECT idroad_signs_catalog, name, price FROM road_signs_catalog ORDER BY idroad_signs_catalog";

    $result = mysqli_query($link, $query);

    while ($sign = mysqli_fetch_array($result, MYSQLI_NUM)) {
         $signs[] = $sign;
         }

    mysqli_free_result($result);

    $query = "SELECT idmaterials, name, price FROM materials ORDER BY idmaterials";

    $result = mysqli_query($link, $query);

    while ($mat = mysqli_fetch_array($result, MYSQLI_NUM)) {
         $mats[] = $mat;
         }
    mysqli_free_result($result);
    mysqli_close($link);

?>

                    <form id="demo-form2" name="order-info" data-parsley-validate class="form-horizontal form-label-left" action="ordpositions.php" method="post">
                      <div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Select customer:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="cust-info">
                            <option></option>
                         <?php foreach($rows as $row){?>
                          <option value=<?php echo $row[0]?>><?php echo $row[1] ?></option>
                           <?php }?>
                          </select>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <a href="newcustomer.php"><button type="button" class="btn btn-success btn-sm">Add new</button></a>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Enter name: <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="last-name" name="ord-name"  placeholder="e.g. Т-1-16" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Enter date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="birthday" class="date-picker form-control col-md-7 col-xs-12" name="ord-date" required="required" type="text">
                        </div>
                      </div>
                        <!-- Datatable Intended -->
					 <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Price</th>
                          <th>Quantity</th>
                          <th>Sum</th>
                          <th>Remove</th>
                        </tr>
                      </thead>

                      <tbody>
                        <tr>
                          <td>
                            <select class="form-control input-pos" name="pos-name[]"> <!-- square baracket magick for arrays in post request -->
                              <option></option>
                              <?php foreach($signs as $sign){?>
                                <option value=<?php echo $sign[0]?> data-type="road_signs_catalog"><?php echo $sign[1] ?></option>
                              <?php }?>
                              <?php foreach($mats as $mat){?>
                                <option value=<?php echo $mat[0]?> data-type="materials"><?php echo $mat[1] ?></option>
                              <?php }?>
                            </select>
                            <a href="newtovar.php"><button type="button" class="btn btn-success btn-sm">Add new</button></a> <!--add new (later!)-->
                          </td>
                          <td>
                            <input type="text" name="pos-price[]" placeholder="here goes price" required="required" class="input-price form-control col-md-7 col-xs-12" readonly="true">
                          </td>
                          <td>
                            <input type="number" name="pos-quantity[]"  placeholder="numbers only" required="required" class="input-qnty form-control col-md-7 col-xs-12">
                          </td>
                          <td>
                            <input type="text" name="pos-sum[]"  placeholder="=Qnty*price" required="required" class="input-sum form-control col-md-7 col-xs-12" readonly="true">
                          </td>
                          <td><button class="remove">&times;</button></td>
                        </tr>
                      </tbody>
                    </table>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-primary">Cancel</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>


<?php
include $root.'/footer.php';
?>
