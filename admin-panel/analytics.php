<?php

date_default_timezone_set("Asia/Kolkata");
include('../_config/_conn.php');

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <title>Uttirna Analytics</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css?ref=<?php echo time(); ?>">
  </head>
  <body>
    
    <nav class="navbar bg-body-tertiary" style="background: var(--main) !important;">
      <div class="container">
        <a class="navbar-brand" href="#" style="display: flex; align-items: center;">
            <img src="../assets/uttirna-logo.webp" class="ms-3" alt="Bootstrap" width="30" height="30" style="border-radius: 30px;">
            <b class="ms-2" style="color: #ffffff;">Analitycs</b>
        </a>
      </div>
    </nav>
      
    <div class="container mt-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Traffic Analytics</li>
          </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card"><div class="card-body"><div class="w-100"><canvas id="myChart" style="height: 300px; width: 100%;"></canvas></div></div></div>
            </div>
        </div>
        
        <div class="row">
            <?php
                $t_day = date('Y-m-d');
                $y_day = date('Y-m-d', strtotime('-1 day'));
                $w_day = date('Y-m-d', strtotime('-7 day'));
                $m_day = date('Y-m-d', strtotime('-30 day'));
            
                $today = mysqli_num_rows(mysqli_query($conn, "SELECT *, DATE_FORMAT(visited_at, 'Y-m-d') FROM traffic_track WHERE DATE(visited_at) = '$t_day'"));
                $yesterday = mysqli_num_rows(mysqli_query($conn, "SELECT *, DATE_FORMAT(visited_at, 'Y-m-d') FROM traffic_track WHERE DATE(visited_at) = '$y_day'"));
                $week = mysqli_num_rows(mysqli_query($conn, "SELECT *, DATE_FORMAT(visited_at, 'Y-m-d') FROM traffic_track WHERE DATE(visited_at) >= '$w_day'"));
                $month = mysqli_num_rows(mysqli_query($conn, "SELECT *, DATE_FORMAT(visited_at, 'Y-m-d') FROM traffic_track WHERE DATE(visited_at) >= '$m_day'"));
            ?>
            
            <div class="col-md-3 mb-3">
                <div class="row">
                    <div class="col-6"><div class="card"><div class="card-body"><span class="text-muted" style="font-size: 14px">Today</span><h5><b><?php echo $today; ?></b></h5></div></div></div>
                    
                    <div class="col-6"><div class="card"><div class="card-body"><span class="text-muted" style="font-size: 14px">Yesterday</span><h5><b><?php echo $yesterday; ?></b></h5></div></div></div>
                </div>
            </div>
            
            <div class="col-md-3 mb-3"><div class="card h-100"><div class="card-body"><span class="text-muted" style="font-size: 14px">This Week</span><h5><b><?php echo $week; ?></b></h5></div></div></div>
            
            <div class="col-md-3 mb-3"><div class="card h-100"><div class="card-body"><span class="text-muted" style="font-size: 14px">This Month</span><h5><b><?php echo $month; ?></b></h5></div></div></div>
            
            <div class="col-md-3 mb-3"><div class="card h-100" style="background-color: rgba(52, 235, 85, 0.3)"><div class="card-body"><span class="text-muted" style="font-size: 14px">Total</span><h5><b><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `traffic_track`")); ?></b></h5></div></div></div>
        </div>
    </div>
      
    <style>
        body{
            font-family: 'Poppins', sans-serif !important;
            background: #dedede !important;
        }.card{
            border-radius: 10px !important;
            border: 0px solid !important;
        }
    </style>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      
    <?php
    
    $count_sql = "SELECT DATE(`visited_at`) AS 'day', COUNT(*) AS 'number_of_users' FROM `traffic_track` GROUP BY DATE(`visited_at`)";
    $count_result = mysqli_query($conn, $count_sql);
    $chart_day = "";
    $chart_number = "";
    while($count_row = mysqli_fetch_assoc($count_result)){
        /*echo $count_row['day'].' - '.$count_row['number_of_users'];
        echo '<br>';*/
        $chart_day = $chart_day.'"'.date_format(date_create($count_row['day']), "d/m/Y").'"'.',';
        $chart_number = $chart_number.(int)$count_row['number_of_users'].',';
    }
    
    ?>
      
    <script>
        $(document).ready(function(){
           const ctx = document.getElementById('myChart');

              new Chart(ctx, {
                type: 'line',
                data: {
                  labels: [<?php echo $chart_day; ?>],
                  datasets: [{
                    label: 'No. of Visitors',
                    data: [<?php echo $chart_number; ?>],
                    borderWidth: 1
                  }]
                },
                options: {
                  scales: {
                    y: {
                      beginAtZero: true,
                      ticks: {
                          precision:0,
                      }
                    },
                    x: {
                      beginAtZero: true,
                      ticks: {
                          precision:0,
                          display: false,
                      }
                    }
                  }
                }
              }); 
        });
    </script>
  </body>
</html>