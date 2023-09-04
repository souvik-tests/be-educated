<?php

include '../../_config/_conn.php';

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

if(isset($_POST['app_name']) && isset($_POST['app_logo']) && isset($_POST['app_banner']) && isset($_POST['app_desc']) && isset($_POST['app_category']) && isset($_POST['yt_url'])){
    $app_id = generateRandomString(24);
    $app_created_by = $_POST['app_created_by'];
    $app_name = $_POST['app_name'];
    $app_logo = $_POST['app_logo'];
    $app_banner = $_POST['app_banner'];
    $app_desc = mysqli_real_escape_string($conn, $_POST['app_desc']);
    $app_category = $_POST['app_category'];
    $yt_url= $_POST['yt_url'];
    
    $result = mysqli_query($conn, "INSERT INTO `miniapps_listings` (`app_id`, `app_created_by`, `app_name`, `app_logo`, `app_banner`, `app_desc`, `app_category`, `yt_url`, `veriff_status`) VALUES ('$app_id', '$app_created_by', '$app_name', '$app_logo', '$app_banner', '$app_desc', '$app_category', '$yt_url', 'not_verified')");
    
    if($result){
        header('Location: ../');
    }else{
        echo 'Something went wrong :(';
    }
}else{
    echo 'Invalid request';
}

?>