<?php

include '../../_config/_conn.php';

if(isset($_POST['course_id']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['category']) && isset($_POST['time_to_complete']) && isset($_POST['offered_by']) && isset($_POST['yt_url'])){
    $course_id = $_POST['course_id'];
    
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $time_to_complete = $_POST['time_to_complete'];
    $offered_by = $_POST['offered_by'];
    $yt_url = $_POST['yt_url'];
    
    $result = mysqli_query($conn, "UPDATE `course_lists` SET `title` = '$title', `description` = '$description', `category_id` = '$category', `time_to_complete` = '$time_to_complete', `offered_by` = '$offered_by', `yt_url` = '$yt_url' WHERE `course_id` = '$course_id'");
    
    if($result){
        header('Location: ../courses.php');
    }else{
        echo 'Something went wrong :(';
    }
}else{
    echo 'Invalid request';
}

?>