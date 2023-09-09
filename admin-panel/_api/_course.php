<?php

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');

include '../../_config/_conn.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM `course_lists` WHERE `course_id` = '$id'";
}else{
    $sql = "SELECT * FROM `course_lists` ORDER BY `created_at` DESC";
}

$result = mysqli_query($conn, $sql);

$json_array = array();
while($row = mysqli_fetch_assoc($result)){
    $json_array[] = $row;
}
echo json_encode($json_array, JSON_PRETTY_PRINT);

?>