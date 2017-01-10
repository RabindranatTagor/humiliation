<?php
    require 'init.php';

    include $root.'/header.php';
?>

                      <div class="ln_solid"></div>
                        <form name = "new-customer" class="form-horizontal form-label-left" action="customer_processing.php" method="post" target="_blank">
                            <h2>Or add a new one:</h2>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Customer name<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" name="custname" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">INN:<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text"  class="form-control col-md-7 col-xs-12" required pattern="^[ 0-9]+$" id="last-name" name="custinn" required="required">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">KPP (9 digits):
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" class="form-control col-md-7 col-xs-12" required pattern="[0-9]{9}" id="last-name" name="custkpp">
                            </div>
                          </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                          <button type="reset" class="btn btn-primary">Cancel</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>                          
                        </form>   
<?php
include $root.'/footer.php';
?>
