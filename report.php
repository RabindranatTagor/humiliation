<?php
  require 'init.php';

  include $root.'/header.php';

  // echo "<pre>";
  // print_r($_REQUEST);
  // echo "</pre>";

  $rmonth = $_REQUEST['rmonth'];
  $ryear = $_REQUEST['ryear'];

?>


<iframe id="reportframe" src="/reportgen.php?rmonth=<?php echo $rmonth ?>&ryear=<?php echo $ryear ?>"></iframe>

                      <div class="row no-print">
                        <div class="col-xs-12">
                          <button class="btn btn-default" id="printgen"><i class="fa fa-print"></i> Print</button>
                        </div>
                      </div>
<?php
    include $root.'\footer.php';
?>
