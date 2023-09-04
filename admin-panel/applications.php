<?php

date_default_timezone_set("Asia/Kolkata");
include('../_config/_conn.php');

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <title>Uttirna Applications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css?ref=<?php echo time(); ?>">
  </head>
  <body>
    
    <div id="img-display" class="w-100 h-100 animate__animated animate__fadeIn" style="position: fixed; top: 0; left: 0; background: rgba(0,0,0,0.8); z-index: 999999999999; display: none; align-items: center; justify-content: center; animation-duration: 0.3s;"><i class="bi bi-x-lg animate__animated animate__fadeInTopRight" style="position: absolute; font-size: 30px; color: #dedede; top: 0; right: 0; margin-top: 30px; margin-right: 30px; cursor: pointer; animation-duration: 0.3s;" id="img-close"></i><div class="row"><div class="col-md-3"></div><div class="col-md-6"><img src="" width="100%" id="img-src"></div><div class="col-md-3"></div></div></div>
      
    <nav class="navbar bg-body-tertiary" style="background: var(--main) !important;">
      <div class="container">
        <a class="navbar-brand" href="#" style="display: flex; align-items: center;">
            <img src="../assets/uttirna-logo.webp" class="ms-3" alt="Bootstrap" width="30" height="30" style="border-radius: 30px;">
            <b class="ms-2" style="color: #ffffff;">Admissions</b>
        </a>
      </div>
    </nav>
      
    <div class="container mt-3 mb-5">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Student Admissions</li>
          </ol>
        </nav>
        
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <?php
                
                $sql = "SELECT * FROM `uttirna_admission` ORDER BY `created_at` DESC";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                    $pos = 0;
                    while($row = mysqli_fetch_assoc($result)){
                        
                        if($row['board'] == "icse"){
                            if($row['class'] == 11 || $row['class'] == 12){
                                $board_u =  "ISC";
                            }else{
                                $board_u = strtoupper($row['board']);
                            }
                        }elseif($row['board'] == "wbbse"){
                            if($row['class'] == 11 || $row['class'] == 12){
                                $board_u = "WBCHSE";
                            }else{
                                $board_u = strtoupper($row['board']);
                            }
                        }else{
                            $board_u = strtoupper($row['board']);
                        }

                        if($pos == 0){
                            echo '<div class="card mb-3"><div class="card-body"><div class="row"><div class="col-8"><div class="h-100"><h6>'.$row['name'].' ('.$board_u.')</h6><div class="text-muted"><span style="font-size: 12px;">'.time_elapsed_string($row['created_at']).'</span></div></div></div><div class="col-4"><div class="h-100" style="display: flex; align-items: center; justify-content: flex-end;"><button class="btn btn-success position-relative btn-view" onclick="get_details(&apos;'.$row['student_id'].'&apos;, this)">View Details<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">NEW<span class="visually-hidden">new application</span></span></button></div></div></div></div></div>';
                        }else{
                            echo '<div class="card mb-3"><div class="card-body"><div class="row"><div class="col-8"><div class="h-100"><h6>'.$row['name'].' ('.$board_u.')</h6><div class="text-muted"><span style="font-size: 12px;">'.time_elapsed_string($row['created_at']).'</span></div></div></div><div class="col-4"><div class="h-100" style="display: flex; align-items: center; justify-content: flex-end;"><button class="btn btn-success position-relative btn-view" onclick="get_details(&apos;'.$row['student_id'].'&apos;, this)">View Details</button></div></div></div></div></div>';
                        }
                        $pos++;
                    }
                }else{
                    echo '<p class="text-center">No admission found :(</p>';
                }
                
                ?>
            </div>
            <div class="col-md-3"></div>
        </div>
        
        <!-- Modal -->
        <div class="modal fade" id="detailsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" id="dmodal-content">
              <!-- future builder -->
            </div>
          </div>
        </div>
    </div>
      
    <style>
        body{
            font-family: 'Poppins', sans-serif !important;
            background: #dedede !important;
        }.card{
            border-radius: 10px !important;
            border: 0px solid !important;
        }.app-card{
            background-color: #ccc;
            cursor: pointer;
            transition: background 0.3s ease;
        }.app-card:hover{
            background-color: #eee;
        }
        .btn-view{
            padding: 5px 10px !important;
            font-size: 12px !important;
            font-weight: 600 !important;
        }
    </style>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
      
    <script>
        function get_details(id, item){
            $("#detailsModal").modal('show');
            $("#dmodal-content").html('<div class="p-3 text-center"><div class="spinner-border text-success" role="status"><span class="visually-hidden">Loading...</span></div><br>Loading...</div>');
            $.ajax({
                type: "GET",
                url: './_req_to/_student_details.php?sid='+id,
                success: function(data){
                    $("#dmodal-content").html(data);
                }
            });
        }
    </script>
    <script>
        $("#img-close").click(function(){
            $("#img-display").hide();
        });
        function openImg(img){
            $("#img-src").attr('src', img);
            $("#img-display").css({display: "flex"});
        }
    </script>
  </body>
</html>