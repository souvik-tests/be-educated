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

if(isset($_POST['email'])){
    $sub_id = generateRandomString(24);
    
    $sub_email = $_POST['email'];
    
    $result = mysqli_query($conn, "INSERT INTO `subscriber_lists` (`sub_id`, `sub_email`) VALUES ('$sub_id', '$sub_email')");
    if($result){
        echo 'success';
    }else{
        echo 'failed';
    }
}

?>