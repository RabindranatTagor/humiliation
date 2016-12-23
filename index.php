<?php
    require 'init.php';

    include $root.'/header.php';
    $query = "SELECT zakaz.idzakaz, zakaz.name, zakaz.date, customers.name, zakaz.sum FROM zakaz, customers where customers.id=zakaz.customer";
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
                          <td><a href="/invoice/?id=<?php echo $row[0]?>"><button type="button" class="btn btn-primary btn-xs">Create invoice</button></a></td>
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
                    <h3>Regression Statistics <small>Intended here</small></h3>
                  </div>
                  <div class="col-md-6">
                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                      <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                      <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                    </div>
                  </div>
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">
                  <div id="placeholder33" style="height: 260px; display: none" class="demo-placeholder"></div>
                  <div style="width: 100%;">
                    <div id="canvas_dahs" class="demo-placeholder" style="width: 100%; height:270px;"></div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
                  <div class="x_title">
                    <h2>Top Campaign Performance</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <div>
                      <p>Facebook Campaign</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80"></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <p>Twitter Campaign</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <div>
                      <p>Conventional Media</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="40"></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <p>Bill boards</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                        </div>
                      </div>
                    </div>
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

