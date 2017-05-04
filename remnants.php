<?php
    require 'init.php';

    include $root.'/header.php';
    $query = "SELECT * FROM materials";
    $result = mysqli_query($link, $query);

    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
         $rows[] = $row;
         }
    mysqli_free_result($result);

    mysqli_close($link);

?>


					  <!-- Datatable Intended -->
					 <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>№</th>
                          <th>Наименование</th>
                          <th>Количество</th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php foreach($rows as $row){?>
                        <tr>
                          <td><?php echo $row[0]?></td>
                          <td><?php echo $row[1]?></td>
                          <td><?php echo $row[3]?></td>
                        </tr>
                         <?php }?>
                      </tbody>
                    </table>

                    <form id="demo-form2" name="remn-change" data-parsley-validate class="form-horizontal form-label-left" action="remn-count.php" method="post">
                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Наименование:</label>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <select class="form-control" name="mname" id="remn-name" required="required">
                            <option></option>
                            <?php foreach($rows as $row){?>
                            <option value=<?php echo $row[0]?>><?php echo $row[1] ?></option>
                            <?php }?>
                          </select>
                         </div>
                          <a href="newtovar.php"><button type="button" class="btn btn-success btn-sm">Добавить</button></a>
                       </div>
                       <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Количество:</label>
                          <div class="col-md-5 col-sm-5 col-xs-12">
                            <input type="number" name="remn-qnty" required="required" class="input-qnty form-control col-md-7 col-xs-12">
                       </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-primary">Cancel</button>
                          <button type="submit" id="subm" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>

<?php
include $root.'\footer.php';
?>
