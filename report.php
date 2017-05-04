<?php
  require 'init.php';

  include $root.'/header.php';
?>

<iframe id="reportframe" src="/reportgen.php"></iframe>

                      <div class="row no-print">
                        <div class="col-xs-12">
                          <button class="btn btn-default" id="printgen"><i class="fa fa-print"></i> Print</button>
                        </div>
                      </div>
<?php
    include $root.'\footer.php';
?>
