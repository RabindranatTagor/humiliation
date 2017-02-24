<?php
    require 'init.php';

    include $root.'/header.php';

    $query = "SELECT * FROM road_signs.materials WHERE name LIKE '% MASK'";
   
    $result = mysqli_query($link, $query);

    while ($mask = mysqli_fetch_array($result, MYSQLI_NUM)) {
         $masks[] = $mask;
         }
    mysqli_free_result($result);
    mysqli_close($link);
?>

                      <div class="ln_solid"></div>
                        <form name = "new-position" class="form-horizontal form-label-left" action="pos_processing.php" method="post" target="_blank">
                            <h2>Or add a new one:</h2>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Type:<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <p>
                                    Road Signs:
                                    <input type="radio" class="goods flat" name="type" id="ttype1" value="road_signs_catalog" required /> Other:
                                    <input type="radio" class="goods flat" name="type" id="ttype2" value="materials" />
                                </p>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Name:<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text"  class="form-control col-md-7 col-xs-12" id="tov-name" name="naimen" required="required">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Price:
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" class="form-control col-md-7 col-xs-12" required pattern="[0-9]" id="tov-price" name="cena" required="required">
                            </div>
                          </div>
                          <div class="div-hid" id="for-mats">
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">In stock:
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="number" class="form-control col-md-7 col-xs-12" id="tov-qnty" name="kolvo" value ="100">
                            </div>
                          </div>
                          </div>
                          <div class="div-hid" id="for-rsc">
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Mask:
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <select class="form-control input-pos" name="mask" id="tov-mask"> <!-- square baracket magick for arrays in post request -->
                              <option></option>
                              <?php foreach($masks as $mask){?>
                              <option value=<?php echo $mask[0]?>><?php echo $mask[1] ?></option>
                              <?php }?>  
                              </select>
                            </div>
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
