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
        <div class="navbar-brand" style="display: flex; align-items: center;">
            <button class="btn btn-dark btn-sm" style="border-radius: 50px;" onclick="location.href='./'"><i class="bi bi-arrow-left"></i></button>
            <b class="ms-2">Courses</b>
        </div>
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
                        <div class="p-2 m-2" style="position: absolute; top: 0; right: 0; background: #ffffff; border-radius: 5px; box-shadow: 1px 1px 10px rgba(0,0,0,0.3);"><button class="btn btn-primary btn-sm"><i class="bi bi-pencil-fill"></i></button><button class="btn btn-danger btn-sm ms-2"><i class="bi bi-trash-fill"></i></button></div>
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
    <form method="post" action="./_submit/_new_course.php" enctype="multipart/form-data"><div class="modal animate__animated animate__slideInUp" id="createNew" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createNewLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="createNewLabel">New Course</h1>
            <button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal" style="border-radius: 50px;"><i class="bi bi-x-lg"></i></button>
          </div>
          <div class="modal-body">
              <div class="container">
                <div class="row">
                    <div class="col-md-6 mb-3" style="height: 400px; overflow-y: scroll;">
                        
                        <div class="mb-3"><label class="form-label"><b>Course Title</b></label><input type="text" class="form-control" name="title" id="course_title" required></div>
                        
                        <div class="mb-3">
                            <label class="form-label"><b>Course Description</b></label>
                            <textarea class="form-control" style="height: 200px;" name="description" id="course_desc" required></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label"><b>Course Category</b></label>
                            <select class="form-select" name="category" id="course_category" style="width: 250px;" required>
                                <option value="Other" selected>-- No Select --</option>
                                <?php
                                    $all_cats = mysqli_query($conn, "SELECT * FROM `category_lists` ORDER BY `title` ASC");
                                    while($a_cat = mysqli_fetch_assoc($all_cats)){
                                        echo '<option value="'.$a_cat['c_id'].'">'.$a_cat['title'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        
                        <div class="mb-3"><label class="form-label"><b>Time to Complete</b></label><input type="text" class="form-control" name="time_to_complete" id="time_to_complete" style="width: 200px;" placeholder="e.g. 3 weeks" required></div>
                        
                        <div class="mb-3"><label class="form-label"><b>Offered by (Company Name)</b></label><input type="text" class="form-control" name="offered_by" id="offered_by" placeholder="e.g. Google Inc." required></div>
                        
                        <div class="w-100 mb-3">
                            <div class="row" style="align-items: center;">
                                <div class="col-6"><div class="app-logo mb-2"></div></div>
                                <div class="col-6"><label class="form-label"><b>Company Logo</b></label><input type="file" class="form-control" name="company_logo" id="company_logo" accept="image/png, image/webp, image/jpeg" required></div>
                            </div>
                        </div>
                        
                        <div class="w-100 mb-3">
                            <div class="row" style="align-items: center;">
                                <div class="col-6"><div class="app-banner mb-2"></div></div>
                                <div class="col-6"><label class="form-label"><b>Course Thumbnail</b></label><input type="file" class="form-control" name="course_banner" accept="image/png, image/webp, image/jpeg" id="course_banner" required></div>
                            </div>
                        </div>
                        
                        <div class="mb-3"><label class="form-label"><b><i class="bi bi-youtube" style="color: red;"></i>&nbsp;YouTube Video URL</b></label><input type="text" class="form-control" name="yt_url" id="yt_url" placeholder="e.g. https://www.youtube.com/watch?v=slFs42ax-Jg"></div>
                        
                    </div>
                    <div class="col-md-6" style="height: 400px; overflow-y: scroll;">
                        <div class="w-100" style="display: flex; justify-content: center;">
                            <div>
                                <p><b>Preview</b></p>
                                <div class="card course-card" style="cursor: pointer;">
                                <div class="card-thumb" id="preview-thumb"></div>
                                <div class="card-body p-2">
                                    <div class="w-100"><b id="preview-title" class="text-deco-1">Course Title</b></div>
                                    <div class="w-100 mt-1" style="font-size: 12px; color: #666;"><i class="bi bi-stopwatch" style="color: #F6635C;"></i>&nbsp;&nbsp;<span id="preview-time">X time</span></div>
                                    <div class="w-100 mt-2" style="display: flex; align-items: center;">
                                        <img id="preview-c-logo" src="https://dummyimage.com/250x250" height="30px" width="30px" style="border-radius: 30px; padding: 2px;">
                                        <span style="font-size: 12px;" class="ms-1" id="preview-c-name">Company Inc.</span>
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
            <button type="submit" class="btn btn-main btn-sm"><b>Submit</b></button>
          </div>
        </div>
      </div>
    </div></form>
      
    <style>
        .form-control{
            border-radius: 0px;
        }
        .form-select{
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
        }
        .app-card{
            border-radius: 0px;
            border: 0px solid;
            box-shadow: 1px 1px 10px rgba(0,0,0,0.2);
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
            
            /*$("#company_logo").change(function(){
                let app_logo = $("#company_logo").val();
                
                $(".app-logo").css({backgroundImage: "url("+app_logo+")"});
                $("#preview-c-logo").attr('src', app_logo);
            });*/
            
            company_logo.onchange = evt => {
              const [file] = company_logo.files
              if (file) {
                $(".app-logo").css({backgroundImage: "url("+URL.createObjectURL(file)+")"});
                $("#preview-c-logo").attr('src', URL.createObjectURL(file));
              }
            }
            
            /*$("#course_banner").change(function(){
                let app_banner = $("#course_banner").val();
                
                $(".app-banner").css({backgroundImage: "url("+app_banner+")"});
                $("#preview-thumb").css({backgroundImage: "url("+app_banner+")"});
            });*/
            
            course_banner.onchange = evt => {
              const [file] = course_banner.files
              if (file) {
                $(".app-banner").css({backgroundImage: "url("+URL.createObjectURL(file)+")"});
                $("#preview-thumb").css({backgroundImage: "url("+URL.createObjectURL(file)+")"});
              }
            }
            
            $("#yt_url").change(function(){
                let yt_url = $("#yt_url").val();
                
                $('#preview_yt').attr('src', 'https://www.youtube.com/embed/'+youtube_parser(yt_url));
            });
            
            $("#course_title").change(function(){
               $("#preview-title").html($("#course_title").val()); 
            });
            
            $("#course_title").keyup(function(){
               $("#preview-title").html($("#course_title").val()); 
            });
            
            $("#offered_by").change(function(){
               $("#preview-c-name").html($("#offered_by").val()); 
            });
            
            $("#offered_by").keyup(function(){
               $("#preview-c-name").html($("#offered_by").val()); 
            });
            
            $("#time_to_complete").change(function(){
               $("#preview-time").html($("#time_to_complete").val()); 
            });
            
            $("#time_to_complete").keyup(function(){
               $("#preview-time").html($("#time_to_complete").val()); 
            });
        }) 
    </script>
  </body>
</html>