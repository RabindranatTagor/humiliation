<?php
    require 'init.php';

    include $root.'/header.php';

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

                    <form id="demo-form2" name="position-data" data-parsley-validate class="form-horizontal form-label-left" method="post">
                      <div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Select name:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="pos-name" id="posiziya">
                            <option></option>
                         <?php foreach($signs as $sign){?>
                          <option value=<?php echo $sign[0]?> data-type="road_signs_catalog"><?php echo $sign[1] ?></option>
                           <?php }?>
                         <?php foreach($mats as $mat){?>
                          <option value=<?php echo $mat[0]?> data-type="materials"><?php echo $mat[1] ?></option>
                           <?php }?>
                          </select>
                          <div class="col-md-2 col-sm-2 col-xs-12">
                            <a href="newtovar.php"><button type="button" class="btn btn-success btn-sm">Add new</button></a> <!--add new (later)-->
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Price: <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="price" name="pos-price"  placeholder="here goes price" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Quantity: <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="qnty" name="pos-quantity"  placeholder="numbers only" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Sum: <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="sum" name="pos-sum"  placeholder="=Qnty*price" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-primary">Cancel</button>
                          <button type="submit" id="subm" class="btn btn-success">Submit</button> <!--add into zakaz_content and return to ordpositions.php-->
                        </div>
                      </div>

                    </form>

<?php
include $root.'/footer.php';
?>