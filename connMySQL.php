<?php
    //資料庫主機設定
$db_host = "localhost";
$db_userName = "root";
$db_passWord = "";
$db_name = "forum";

//資料庫連線
$db_link = @new mysqli($db_host, $db_userName, $db_passWord, $db_name);

//連線錯誤處理
if($db_link->connect_errno !=""){
    die('資料庫連線失敗!');
}else{//連線成功 設定字元集編碼
    $db_link->query("SET NAMES 'utf8'");
}
?>