<?php

include '../../_config/_conn.php';

if(isset($_POST['c_id']) && isset($_POST['title'])){
    $c_id = $_POST['c_id'];
    
    $title = $_POST['title'];
    
    $result = mysqli_query($conn, "UPDATE `category_lists` SET `title` = '$title' WHERE `c_id` = '$c_id'");
    
    if($result){
        header('Location: ../category.php');
    }else{
        echo 'Something went wrong :(';
    }
}else{
    echo 'Invalid request';
}

?>