<?
    $db_host = "localhost";
    $db_name = "guitartist";
    $db_user  = "root";
    $db_pass = "root";

    // 不要有空格
    $dsn = "mysql:host={$db_host};dbname={$db_name}";

    $pdo_options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8 COLLATE utf8_unicode_ci"
    ];

    try{
        $pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);
    }
    catch(PDOException $ex){
        echo 'Connect failed: '. $ex->getMassage();
    }
    
    if( !isset($_SESSION) ){
        session_start();
    }
?>