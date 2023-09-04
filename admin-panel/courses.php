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
    <title>Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css?ref=<?php echo time(); ?>">
  </head>
  <body>
      
    <nav class="navbar bg-body-tertiary" style="box-shadow: 1px 1px 10px rgba(0,0,0,0.1);">
      <div class="container">
        <a class="navbar-brand" style="display: flex; align-items: center;">
            <img src="../assets/logo2.webp" width="40" height="40">
            <b class="ms-2">Courses</b>
        </a>
      </div>
    </nav>
      
    <div class="container mt-3">
        <div class="w-100" style="display: flex; align-items: center; justify-content: space-between;"><div><b>All Courses</b></div><button class="btn btn-main btn-sm" id="start-new-project"><b>New Course</b></button></div>  
        <div class="row mt-3">
            <?php
            
            $apps = mysqli_query($conn, "SELECT * FROM `course_lists` ORDER BY `created_at` DESC");
            if(mysqli_num_rows($apps) > 0){
                while($a_row = mysqli_fetch_assoc($apps)){
                    echo '<div class="col-md-3 mb-3">
                    <div class="card app-card" style="position: relative;">
                        <div class="p-2 m-2" style="position: absolute; top: 0; right: 0; background: #F6635C; border-radius: 5px; box-shadow: 1px 1px 10px rgba(0,0,0,0.2);"><button class="btn btn-light btn-sm"><i class="bi bi-pencil-fill"></i></button><button class="btn btn-light btn-sm ms-2"><i class="bi bi-trash-fill"></i></button></div>
                        <div class="card-thumb" style="background-image: url(../_data/_images/'.$a_row['course_id'].'-thumbnail.webp)"></div>
                        <div class="card-body p-3">
                            <div class="row" style="align-items: center;">
                                <div class="col-2"><img src="../_data/_images/'.$a_row['course_id'].'-company_logo.webp" height="40px" width="40px" style="border-radius: 40px;"></div>
                                <div class="col-10"><div class="ms-1" style="font-weight: 500; font-size: 14px;">'.$a_row['title'].'</div></div>
                            </div>
                            
                            <div class="w-100 mt-2"><span style="font-size: 12px; color: #666;">Created '.time_elapsed_string($a_row['created_at']).'</span></div>
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
      
    <!-- createNewModal -->
    <form method="post" action="./_submit/_new.php"><div class="modal fade" id="createNew" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createNewLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="createNewLabel">Publish Listing</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="container">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        
                        <input type="hidden" name="app_created_by" value="<?php echo $_SESSION['u_id']; ?>">
                        
                        <div class="mb-3"><label class="form-label"><b>Title</b></label><input type="text" class="form-control" name="app_name" required></div>
                        
                        <div class="app-logo mb-2"></div>
                        
                        <div class="mb-3"><label class="form-label"><b>App Logo (URL)</b></label><input type="text" class="form-control" name="app_logo" id="app_logo" required></div>
                        
                        <div class="app-banner mb-2"></div>
                        
                        <div class="mb-3"><label class="form-label"><b>Thumbnail (URL)</b></label><input type="text" class="form-control" name="app_banner" id="app_banner" required></div>
                        
                        <div class="mb-3">
                            <label class="form-label"><b>App Description</b></label>
                            <textarea class="form-control" style="height: 200px;" name="app_desc" required></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label"><b>App Category</b></label>
                            <select class="form-select" name="app_category" style="width: 250px;" required>
                                <option value="Other" selected>-- No Select --</option>
                                <option value="Finance">Finance</option>
                                <option value="Technology">Technology</option>
                                <option value="E-commerce">E-commerce</option>
                                <option value="Food Delivery">Food Delivery</option>
                                <option value="SAAS">SAAS</option>
                                <option value="News & Media">News & Media</option>
                            </select>
                        </div>
                        
                        <div class="mb-3"><label class="form-label"><b>YouTube URL</b></label><input type="text" class="form-control" name="yt_url" id="yt_url"></div>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="w-100" style="display: flex; justify-content: center;">
                            <div>
                                <p><b>Preview</b></p>
                                <div class="card app-card" style="position: relative; width: 300px">
                                    <div class="card-image" id="preview_banner"></div>
                                    <div class="card-body p-2">
                                        <div class="row" style="align-items: center;">
                                            <div class="col-2"><img src="https://dummyimage.com/512x512" id="preview_logo" height="40px" width="40px" style="border-radius: 40px;"></div>
                                            <div class="col-10"><b>App Name</b></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-3">
                                    <p><b>YouTube Preview</b></p><iframe id="preview_yt" width="300" height="200" src="https://www.youtube.com/embed/"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
          </div>
        </div>
      </div>
    </div></form>
      
    <style>
        .form-control{
            border-radius: 0px;
        }  
    </style>
      
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="js/app.js?ref=<?php echo time(); ?>"></script>
    <script>
        
        function youtube_parser(url){
            var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;
            var match = url.match(regExp);
            return (match&&match[7].length==11)? match[7] : false;
        }
        
        $(document).ready(function(){
            
            $("#app_logo").change(function(){
                let app_logo = $("#app_logo").val();
                
                $(".app-logo").css({backgroundImage: "url("+app_logo+")"});
                $("#preview_logo").attr('src', app_logo);
            });
            
            $("#app_banner").change(function(){
                let app_banner = $("#app_banner").val();
                
                $(".app-banner").css({backgroundImage: "url("+app_banner+")"});
                $("#preview_banner").css({backgroundImage: "url("+app_banner+")"});
            });
            
            $("#yt_url").change(function(){
                let yt_url = $("#yt_url").val();
                
                $('#preview_yt').attr('src', 'https://www.youtube.com/embed/'+youtube_parser(yt_url));
            });
        }) 
    </script>
  </body>
</html>