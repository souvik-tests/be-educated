<?php

include('../_config/_conn.php');

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <title>Analytics</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css?ref=<?php echo time(); ?>">
  </head>
  <body>
    
    <nav class="navbar bg-body-tertiary fixed-top" style="box-shadow: 1px 1px 10px rgba(0,0,0,0.1);">
      <div class="container">
        <div class="navbar-brand" style="display: flex; align-items: center;">
            <img src="../assets/logo2.webp" width="35" height="35">
            <b class="ms-2">Admin Panel</b>
        </div>
      </div>
    </nav>
      
    <div class="container" style="margin-top: 85px;">
        <div class="row">
            <div class="col-md-4 mb-3"><div class="card h-100 feat_card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <p class="-text-muted">Traffic</p><h4><b><?php echo number_format(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `traffic_track`"))); ?></b></h4>
                        </div>
                        <div class="col-6">
                            <p class="-text-muted">Subscribers</p><h4><b><?php echo number_format(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `subscriber_lists`"))); ?></b></h4>
                        </div>
                    </div>
                    
                    <div class="w-100">
                        <div class="row">
                            <div class="col-6">
                                <a href="./analytics.php" style="text-decoration: none;"><button class="btn btn-sm btn-main w-100"><b><i class="bi bi-bar-chart-fill"></i>&nbsp;&nbsp;Analytics</b></button></a>
                            </div>
                            <div class="col-6">
                                <a href="./subscribers.php" style="text-decoration: none;"><button class="btn btn-sm btn-main w-100"><b><i class="bi bi-envelope-fill"></i>&nbsp;&nbsp;Subscribers</b></button></a>
                            </div>
                        </div>
                    </div>
                </div></div></div>
            
            <div class="col-md-4 mb-3"><div class="card h-100 feat_card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <p class="-text-muted">Courses</p><h4><b><?php echo number_format(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `course_lists`"))); ?></b></h4>
                        </div>
                        <div class="col-6">
                            <p class="-text-muted">Categories</p><h4><b><?php echo number_format(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `category_lists`"))); ?></b></h4>
                        </div>
                    </div>
                    
                    <div class="w-100">
                        <div class="row">
                            <div class="col-6">
                                <a href="./courses.php" style="text-decoration: none;"><button class="btn btn-sm btn-main w-100"><b><i class="bi bi-file-earmark-text-fill"></i>&nbsp;&nbsp;Courses</b></button></a>
                            </div>
                            <div class="col-6">
                                <a href="./category.php" style="text-decoration: none;"><button class="btn btn-sm btn-main w-100"><b><i class="bi bi-tags-fill"></i>&nbsp;&nbsp;Categories</b></button></a>
                            </div>
                        </div>
                    </div>
                </div></div></div>
            
            <div class="col-md-4 mb-3"><div class="card h-100 feat_card"><div class="card-body"><p class="-text-muted">Total Applications</p><h4><b><?php echo number_format(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `application_lists`"))); ?></b></h4><div class="w-100" style="text-align: right;"><a href="./applications.php" style="text-decoration: none;"><button class="btn btn-main btn-sm"><b><i class="bi bi-people-fill"></i>&nbsp;&nbsp;Applications</b></button></a></div></div></div></div>
        </div>
    </div>
      
    <hr>
      
    <div class="container mt-3">
        <div class="w-100" style="display: flex; align-items: center; justify-content: space-between;"><div><b>Latest Categories</b></div><button class="btn btn-main btn-sm" onclick="location.href='./category.php'"><b>Show All&nbsp;<i class="bi bi-caret-right-fill"></i></b></button></div>  
        <div class="row mt-3">
            <?php
            
            $course = mysqli_query($conn, "SELECT * FROM `category_lists` ORDER BY `created_at` DESC LIMIT 4");
            if(mysqli_num_rows($course) > 0){
                while($c_row = mysqli_fetch_assoc($course)){
                    echo '<div class="col-md-3 mb-3">
                        <div class="category-card" style="position: relative;">
                            <div class="category-image" style="background-image: url(../_data/_images/'.$c_row['c_id'].'-category_banner.webp);"></div>
                            <div class="ms-2"><span><b>'.$c_row['title'].'</b><br></span><!--<span style="font-size: 12px; color: #E4433B;">35 courses</span>--></div>
                        </div>
                    </div>';
                }
            }else{
                echo '<div class="p-2 mt-5 text-center"><img src="https://img.icons8.com/external-topaz-kerismaker/96/external-Empty-empty-state-topaz-kerismaker.png" height="80px"><div class="w-100 mt-3">No courses found :(</div></div>';
            }
            
            ?>
        </div>
    </div>
      
    <hr>
      
    <div class="container mt-3">
        <div class="w-100" style="display: flex; align-items: center; justify-content: space-between;"><div><b>Latest Courses</b></div><button class="btn btn-main btn-sm" onclick="location.href='./courses.php'"><b>Show All&nbsp;<i class="bi bi-caret-right-fill"></i></b></button></div>  
        <div class="row mt-3">
            <?php
            
            $cats = mysqli_query($conn, "SELECT * FROM `course_lists` ORDER BY `created_at` DESC LIMIT 4");
            if(mysqli_num_rows($cats) > 0){
                while($cat_row = mysqli_fetch_assoc($cats)){
                    echo '<div class="col-md-3 mb-3">
                    <div class="card app-card" style="position: relative;">
                        <div class="card-thumb" style="background-image: url(../_data/_images/'.$cat_row['course_id'].'-thumbnail.webp)"></div>
                        <div class="card-body p-3">
                            <div class="row" style="align-items: center;">
                                <div class="col-2"><img src="../_data/_images/'.$cat_row['course_id'].'-company_logo.webp" height="40px" width="40px" style="border-radius: 40px;"></div>
                                <div class="col-10"><div class="ms-1" style="font-weight: 500; font-size: 14px;">'.$cat_row['title'].'</div></div>
                            </div>
                        </div>
                    </div>
                </div>';
                }
            }else{
                echo '<div class="p-2 mt-5 text-center"><img src="https://img.icons8.com/external-topaz-kerismaker/96/external-Empty-empty-state-topaz-kerismaker.png" height="80px"><div class="w-100 mt-3">No courses found :(</div></div>';
            }
            
            ?>
        </div>
    </div>
      
    <div class="w-100 mt-4 mb-5 text-center text-muted" style="font-size: 12px;">
        <span>All Rights Reserved © BeEducated <?php echo date('Y'); ?></span><br>
        <span>Developed by ZeroBizz</span>
    </div>
      
    <style>
        body{
            font-family: 'Poppins', sans-serif !important;
        }.feat_card{
            border-radius: 15px !important;
            border: 0px solid !important;
            background: #F0F3F8;
        }
    </style>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>