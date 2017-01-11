<?php
    require 'init.php';

    include $root.'/header.php';

    $query = "SELECT id, name FROM customers ORDER BY id";
    $result = mysqli_query($link, $query);
    
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) { 
         $rows[] = $row;
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
                          <option value=<?php $row[0]?>><?php echo $row[1]?></option>
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
                          <input id="birthday" class="date-picker form-control col-md-7 col-xs-12 name="ord-date" required="required" type="text">
                        </div>
                      </div>
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