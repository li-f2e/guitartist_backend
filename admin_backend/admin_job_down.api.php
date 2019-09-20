
<?php
    require_once __DIR__ . "/init.php";
    

    $productId = isset($_GET['product_id'])? intval( $_GET['product_id']) : 0;
    // echo $productId;

    if(!empty($productId)){

        $out = '0';
        $sql_out = "UPDATE  `product` SET `product_out` = $out  WHERE `product_id` = $productId";

        $pdo->query($sql_out);

        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
?>