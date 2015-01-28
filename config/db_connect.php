<?php
$host = "localhost";
$port = "3306";
$db_name = "sendlove_item";
$username = "root";
$password = "root";

try {
    $con = new PDO("mysql:host={$host};port={$port};dbname={$db_name}", $username, $password);
    $con->exec("set names utf8");   //重要，連接資料庫設定讀取為utf8才不會讀取中文為亂碼
    //設定exception 模式
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

}
//to handle connection error
catch(PDOException $exception){
    echo "連結DB發生錯誤: " . $exception->getMessage();
}
?>