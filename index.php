<?php
    require 'init.php';
        ini_set('display_errors','On');
     error_reporting('E_ALL');
    include $root.'/header.php';
    $query = "SELECT zakaz.idzakaz, zakaz.name, zakaz.date, customers.name, zakaz.sum FROM zakaz, customers where customers.id=zakaz.customer";
    $result = mysqli_query($link, $query);

    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
         $rows[] = $row;
         }
    mysqli_free_result($result);


    foreach($rows as $row){
        $dates[] = substr($row[2], 0, 4);
    }
    $years = array_unique($dates);

    mysqli_close($link);
        // ini_set('display_errors','Off');
?>


					  <!-- Datatable Intended -->
					 <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>№</th>
                          <th>Name</th>
                          <th>Date</th>
                          <th>Customer</th>
                          <th>Sum</th>
                          <th>Create invoice</th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php foreach($rows as $row){?>
                        <tr>
                          <td><?php echo $row[0]?></td>
                          <td><?php echo $row[1]?></td>
                          <td><?php echo $row[2]?></td>
                          <td><?php echo $row[3]?></td>
                          <td><?php echo $row[4]?></td>
                          <td><a href="/invoice.php/?id=<?php echo $row[0]?>"><button type="button" class="btn btn-primary btn-xs">Сформировать счет</button></a></td>
                        </tr>
                         <?php }?>
                      </tbody>
                    </table>
					 <!--Prognose Graph Intended-->
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Количество заказов</h3>
                  </div>
                  </div>
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">
                  <div id="placeholder33" style="height: 260px; display: none" class="demo-placeholder"></div>
                  <div style="width: 100%;">
                    <div id="canvas_dahs-01" class="demo-placeholder" style="width: 100%; height:270px;"></div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
                  <div class="x_title">
                    <h2>Сформировать отчет</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <form id="demo-form2" name="report-info" data-parsley-validate class="form-horizontal form-label-left" action="report.php" method="post">
                      <div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Месяц:</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <select class="form-control" name="rmonth">
                            <option value="01">Январь</option>
                            <option value="02">Февраль</option>
                            <option value="03">Март</option>
                            <option value="04">Апрель</option>
                            <option value="05">Май</option>
                            <option value="06">Июнь</option>
                            <option value="07">Июль</option>
                            <option value="08">Август</option>
                            <option value="09">Сентябрь</option>
                            <option value="10">Октябрь</option>
                            <option value="11">Ноябрь</option>
                            <option value="12">Декабрь</option>
                          </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Год:</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <select class="form-control" name="ryear">
                            <?php foreach($years as $year){?>
                          <option value=<?php echo $year?>><?php echo $year?></option>
                           <?php }?>
                          </select>
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success">Далее</button>
                       </div>
                      </div>
                    </form>
                  </div>


                </div>

                <div class="clearfix"></div>
              </div>
            </div>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Суммарная стоимость</h3>
                  </div>
                  </div>
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">
                  <div id="placeholder33" style="height: 260px; display: none" class="demo-placeholder"></div>
                  <div style="width: 100%;">
                    <div id="canvas_dahs-02" class="demo-placeholder" style="width: 100%; height:270px;"></div>
                  </div>
                </div>

                <div class="clearfix"></div>
              </div>
            </div>

          </div>
          <br />

				  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- /page content -->

<?php
include $root.'\footer.php';
?>
