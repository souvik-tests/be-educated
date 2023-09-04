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
    <title>BeEducated Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css?ref=<?php echo time(); ?>">
  </head>
  <body>
    
    <nav class="navbar bg-body-tertiary" style="box-shadow: 1px 1px 10px rgba(0,0,0,0.1);">
      <div class="container">
        <a class="navbar-brand" style="display: flex; align-items: center;">
            <img src="../assets/logo2.webp" width="40" height="40">
            <b class="ms-2">Admin Panel</b>
        </a>
      </div>
    </nav>
      
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4 mb-3"><div class="card h-100"><div class="card-body"><p class="-text-muted">Total Visitors</p><h4><b><?php echo number_format(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `traffic_track`"))); ?></b></h4><div class="w-100" style="text-align: right;"><a href="./analytics.php" style="text-decoration: none;">View Analytics</a></div></div></div></div>
            
            <div class="col-md-4 mb-3"><div class="card h-100"><div class="card-body"><p class="-text-muted">Total Courses</p><h4><b><?php echo number_format(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `course_lists`"))); ?></b></h4><div class="w-100" style="text-align: right;"><a href="./courses.php" style="text-decoration: none;">View Courses</a></div></div></div></div>
            
            <div class="col-md-4 mb-3"><div class="card h-100"><div class="card-body"><p class="-text-muted">Total Applications</p><h4><b><?php //echo number_format(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `uttirna_admission`"))); ?></b></h4><div class="w-100" style="text-align: right;"><a href="./admission.php" style="text-decoration: none;">View Applications</a></div></div></div></div>
        </div>
        
        <!--<h5 class="mt-3"><b>Job Applications</b></h5>-->
    </div>
      
    <style>
        body{
            font-family: 'Poppins', sans-serif !important;
        }.card{
            border-radius: 15px !important;
            border: 0px solid !important;
            background: #F0F3F8;
        }
    </style>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>