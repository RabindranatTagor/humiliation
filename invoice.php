<?php
  require 'init.php';

  include $root.'/header.php';
?>

<iframe id="invoiceframe" src="/invoicegen.php?id=<?php echo $_GET['id']?>"></iframe>

<?php
  include $root.'\footer.php';
?>
