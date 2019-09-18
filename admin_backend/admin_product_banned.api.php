
<?php
    require_once __DIR__ . "/init.php";

    $result = [
        'success' => false,
        'code' => 400,
        'info' => '',
        'get' => $_GET,
    ];
    

    $productId = isset($_GET['product_id'])? intval( $_GET['product_id']) : 0;
    $value = isset($_GET['value'])? intval( $_GET['value']) : 0;
    // echo $productId;

    if(!empty($productId)){

        $sql_out = "UPDATE  `product` SET `product_banned` = $value  WHERE `product_id` = $productId";

        $stmt =  $pdo->query($sql_out);

        if ($stmt->rowCount() == 1) {
            $result['success'] = true;
            $result['code'] = 200;
            $result['info'] = '已禁售';
        } else {
            $result['code'] = 420;
            $result['info'] = '禁售失敗';
        }
        
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        // header("Location: " . $_SERVER['HTTP_REFERER']);
    }

?>