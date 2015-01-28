<?php
// 啟動 session
// http://tw1.php.net/manual/zh/function.session-start.php
session_start();
include 'config/db_connect.php';
//設置頁面標題
// $page_title="Products";

// to prevent undefined index notice
$last_id = $_GET['last_id'];
$limit = $_GET['limit'];

$query = 'SELECT name, id FROM products WHERE id > '.$last_id.' ORDER BY id ASC LIMIT 0, '.$limit.'';

$stmt = $con->prepare( $query );
// $query->bindParam(':last_id', $last_id, PDO::PARAM_INT);
// $query->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->execute();
$num = $stmt->rowCount();
$get_item_str = "";

if($num>0){
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $get_item_str = $get_item_str . "{'id':'{$id}' , 'name':'{$name}' },";
        $last_id = "{$id}";
    }
    $get_item_str = rtrim($get_item_str,',');
    $get_item_str = str_replace("'",'"',$get_item_str);
    echo '{"last_id":"'.$last_id.'", "data":['.$get_item_str.']}';
}
// tell the user if there's no products in the database
else{
    echo 'No';
}
sleep(1);
?>