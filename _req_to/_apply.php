<?php

include '../_config/_conn.php';

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

if(isset($_POST['mobile']) && isset($_POST['name']) && isset($_POST['applied_for'])){
    $apply_id = generateRandomString(24);
    
    $mobile = $_POST['mobile'];
    $name = $_POST['name'];
    $applied_for = $_POST['applied_for'];
    
    $result = mysqli_query($conn, "INSERT INTO `application_lists` (`apply_id`, `name`, `mobile`, `applied_for`) VALUES ('$apply_id', '$name', '$mobile', '$applied_for')");
    if($result){
        echo 'success';
    }else{
        echo 'failed';
    }
}

?>