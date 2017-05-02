<?php
  require 'init.php';

  include $root.'/header.php';
?>

<iframe id="invoiceframe" src="/invoicegen.php?id=<?php echo $_GET['id']?>"></iframe>

                      <div class="row no-print">
                        <div class="col-xs-12">
                          <button class="btn btn-default" id="printgen"><i class="fa fa-print"></i> Print</button>
                          <button class="btn btn-primary pull-right" id="pdfgen"style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
                        </div>
                      </div>
<?php
  include $root.'\footer.php';
?>
