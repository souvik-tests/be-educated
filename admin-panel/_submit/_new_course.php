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

if(isset($_FILES['company_logo']) && isset($_FILES['course_banner']) && isset($_POST['title']) && isset($_POST['alias']) && isset($_POST['description']) && isset($_POST['category']) && isset($_POST['time_to_complete']) && isset($_POST['offered_by']) && isset($_POST['yt_url'])){
    $course_id = generateRandomString(24);
    
    $title = $_POST['title'];
    $alias = $_POST['alias'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $category = $_POST['category'];
    $time_to_complete = $_POST['time_to_complete'];
    $offered_by = $_POST['offered_by'];
    $yt_url = $_POST['yt_url'];
    
    $company_logo = $_FILES['company_logo']['tmp_name'];
    $course_banner = $_FILES['course_banner']['tmp_name'];
    
    $cl = imagecreatefromstring(file_get_contents($company_logo));
    imagepalettetotruecolor($cl);
    $cl_ok = imagewebp($cl, '../../_data/_images/'.$course_id.'-company_logo.webp', 50);
    imagedestroy($cl);
    
    $cb = imagecreatefromstring(file_get_contents($course_banner));
    imagepalettetotruecolor($cb);
    $cb_ok = imagewebp($cb, '../../_data/_images/'.$course_id.'-thumbnail.webp', 50);
    imagedestroy($cb);
    
    if($cl_ok && $cb_ok){
        $result = mysqli_query($conn, "INSERT INTO `course_lists` (`course_id`, `title`, `alias`, `description`, `category_id`, `time_to_complete`, `offered_by`, `yt_url`, `views`) VALUES ('$course_id', '$title', '$alias', '$description', '$category', '$time_to_complete', '$offered_by', '$yt_url', '0')");
    
        if($result){
            header('Location: ../courses.php');
        }else{
            echo 'Something went wrong :(';
        }
    }
}else{
    echo 'Invalid request';
}

?>