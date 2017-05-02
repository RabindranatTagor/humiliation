<?php
  require 'init.php';

  include $root.'/header.php';
?>

<iframe id="invoiceframe" src="/invoicegen.php?id=<?php echo $_GET['id']?>"></iframe>

                      <div class="row no-print">
                        <div class="col-xs-12">
                          <button class="btn btn-default" id="printgen"><i class="fa fa-print"></i> Print</button>
                        </div>
                      </div>
<?php
    include $root.'\footer.php';
?>
