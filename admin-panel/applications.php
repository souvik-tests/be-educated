<?php
include '../_config/_conn.php';

date_default_timezone_set("Asia/Kolkata");
$t = time();

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
    <title>Applications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css?ref=<?php echo time(); ?>">
  </head>
  <body>
      
    <nav class="navbar bg-body-tertiary" style="box-shadow: 1px 1px 10px rgba(0,0,0,0.1);">
      <div class="container">
        <div class="navbar-brand" style="display: flex; align-items: center;">
            <button class="btn btn-dark btn-sm" style="border-radius: 50px;" onclick="location.href='./'"><i class="bi bi-arrow-left"></i></button>
            <b class="ms-2">Applications</b>
        </div>
      </div>
    </nav>
      
    <div class="container mt-3">
        <div class="w-100" style="display: flex; align-items: center; justify-content: space-between;"><div><b>All Applications</b></div></div>  
        <div class="row mt-3">
            <?php
            
            $apps = mysqli_query($conn, "SELECT * FROM `application_lists` as a LEFT JOIN `course_lists` as c ON a.applied_for = c.course_id ORDER BY a.applied_at DESC");
            if(mysqli_num_rows($apps) > 0){
                $pos = 0;
                while($a_row = mysqli_fetch_assoc($apps)){
                    echo '<div class="col-md-3 mb-3">
                        <div class="card app-card" style="position: relative;">';
                        
                            if($pos == 0){
                                echo '<span class="badge rounded-pill text-bg-danger" style="position: absolute; top: 0; right: 0; margin-top: 10px; margin-right: 10px;">NEW</span>';
                            }
                        
                            echo '<div class="card-body"><h5 style="color: #09548c;"><b>'.$a_row['name'].'</b></h5>
                            <div><b><span style="font-size: 14px; color: #666;"><i class="bi bi-telephone-fill"></i>&nbsp;'.$a_row['mobile'].'</span></b>
                            
                            <div class="w-100 mt-2 mb-2 p-1" style="border: 1px solid #ccc; border-radius: 7px;">
                                <table><tr><td><div class="course_logo" style="background-image: url(../_data/_images/'.$a_row['course_id'].'-thumbnail.webp)"></div></td><td class="ps-1"><span style="font-size: 14px;" class="text-deco-2"><a href="../course/'.$a_row['alias'].'" target="_blank">'.$a_row['title'].'</a></span></td></tr></table>
                            </div>
                            
                            <span style="font-size: 12px; color: #666;">'.time_elapsed_string($a_row['applied_at']).'</span></div>
                            
                            <div class="w-100 mt-2"><a href="tel:'.$a_row['mobile'].'"><button class="btn btn-main btn-sm"><b><i class="bi bi-telephone-fill"></i>&nbsp;&nbsp;Direct Dial</b></button></a><a href="https://wa.me/91'.$a_row['mobile'].'" target="_blank"><button class="btn btn-light btn-sm ms-2"><b style="color: #30B643;"><i class="bi bi-whatsapp"></i></b></button></a></div>
                            </div>
                        </div>
                    </div>';
                    
                    $pos++;
                }
            }else{
                echo '<div class="p-2 mt-5 text-center"><img src="https://img.icons8.com/external-topaz-kerismaker/96/external-Empty-empty-state-topaz-kerismaker.png" height="80px"><div class="w-100 mt-3">No applications found :(</div></div>';
            }
            
            ?>
        </div>
    </div>
      
    <style>
        .form-control{
            border-radius: 0px;
        }.form-select{
            border-radius: 0px;
        }  
        .app-logo{
            height: 100px;
            width: 100px;
            border: 1px solid #ccc;
            background: #ddd;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            border-radius: 7px;
        }.app-banner{
            width: 250px;
            border: 1px solid #ccc;
            aspect-ratio: 16 / 9;
            background: #ddd;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            border-radius: 7px;
        }.app-card{
            border-radius: 0px;
            border: 0px solid;
            box-shadow: 1px 1px 10px rgba(0,0,0,0.2);
        }a{
            color: #000000;
            text-decoration: none;
        }a:hover{
            color: #09548c;
        }
        
        .course_logo{
            height: 50px;
            width: 50px;
            border-radius: 5px;
            background: #ddd;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>
      
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js" integrity="sha512-zP5W8791v1A6FToy+viyoyUUyjCzx+4K8XZCKzW28AnCoepPNIXecxh9mvGuy3Rt78OzEsU+VCvcObwAMvBAww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script src="js/app.js?ref=<?php echo time(); ?>"></script>
  </body>
</html>