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

if(isset($_FILES['category_banner']) && isset($_POST['title'])){
    $c_id = generateRandomString(24);
    
    $title = $_POST['title'];
    
    $category_banner = $_FILES['category_banner']['tmp_name'];
    
    $cat_b = imagecreatefromstring(file_get_contents($category_banner));
    imagepalettetotruecolor($cat_b);
    $cat_b_ok = imagewebp($cat_b, '../../_data/_images/'.$c_id.'-category_banner.webp', 50);
    imagedestroy($cat_b);
    
    if($cat_b_ok){
        $result = mysqli_query($conn, "INSERT INTO `category_lists` (`c_id`, `title`) VALUES ('$c_id', '$title')");
        if($result){
            header("Location: ../category.php");
        }else{
            echo 'Something went wrong :(';
        }
    }
}else{
    echo 'Invalid request :(';
}

?>