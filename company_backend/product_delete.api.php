<? require_once __DIR__ . "/__admin_required.php"; ?> 
<?
    require_once __DIR__ . "/__connect_db.php";
    

    $productId = isset($_GET['product_id'])? intval( $_GET['product_id']) : 0;
    // echo $productId;

    if(!empty($productId)){
    $sql_delete = "DELETE FROM `product` WHERE `product_id` = $productId";

    $stmt_delete = $pdo->query($sql_delete);

        // if($stmt_delete->rowCount()){
            
        //     echo "delete done";
        // }

        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
?>