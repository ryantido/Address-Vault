<?php 

    $headTitle = 'AddressVault Error';
    ob_start();

?>

    

<?php 

    $content = ob_get_clean();
    require 'views/template/template.view.php';

?>