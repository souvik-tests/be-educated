<?php

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');

include '../../_config/_conn.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM `category_lists` WHERE `c_id` = '$id'";
}else{
    $sql = "SELECT * FROM `category_lists` ORDER BY `title` ASC";
}

$result = mysqli_query($conn, $sql);

$json_array = array();
while($row = mysqli_fetch_assoc($result)){
    $json_array[] = $row;
}
echo json_encode($json_array, JSON_PRETTY_PRINT);

?>