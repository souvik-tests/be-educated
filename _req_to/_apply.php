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

if(isset($_POST['mobile']) && isset($_POST['name'])){
    $apply_id = generateRandomString(24);
    
    $mobile = $_POST['mobile'];
    $name = $_POST['name'];
    
    $result = mysqli_query($conn, "INSERT INTO `application_lists` (`apply_id`, `name`, `mobile`) VALUES ('$apply_id', '$name', '$mobile')");
    if($result){
        echo 'success';
    }else{
        echo 'failed';
    }
}

?>