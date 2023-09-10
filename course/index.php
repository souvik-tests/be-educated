<?php
if(isset($_GET['alias'])){
    include '../_config/_conn.php';
    
    $alias = $_GET['alias'];
    $result = mysqli_query($conn, "SELECT * FROM `course_lists` WHERE `alias` = '$alias'");
    $result_array = mysqli_fetch_array($result);
    
    $this_course_id = $result_array['course_id'];
    
    $update_views = mysqli_query($conn, "UPDATE `course_lists` SET `views` = `views` + 1 WHERE `course_id` = '$this_course_id'");
}else{
    header("Location: ../");
}

if($_SERVER['QUERY_STRING'] == "alias="){
    header("Location: ../");
}

function get_yt_id($url){
    $link = $url;
    $video_id = explode("?v=", $link); // For videos like http://www.youtube.com/watch?v=...
    if (empty($video_id[1]))
        $video_id = explode("/v/", $link); // For videos like http://www.youtube.com/watch/v/..

    $video_id = explode("&", $video_id[1]); // Deleting any other params
    $video_id = $video_id[0];
    
    return $video_id;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $result_array['title']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- flickity -->
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="../css/styles.css?ref=<?php echo time(); ?>">
  </head>
  <body>
    
    <!-- navbar area -->
    <?php include '../_ui/_header.php'; ?>
      
    <!-- main area -->
    <div class="container mb-4" style="margin-top: 100px">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="w-100"><span style="background: #497CCF; border-radius: 30px; color: #ffffff; font-size: 14px; padding: 5px 10px;"><b>
                    <?php 
                        if($result_array['category_id'] != "none" && $result_array['category_id'] != "" && $result_array['category_id'] != null){
                            $category_id = $result_array['category_id'];
                            $category_array = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `category_lists` WHERE `c_id` = '$category_id'"));
                            echo $category_array['title'];
                        }else{
                            echo "Other";
                        }
                    ?>
                    </b></span></div>
                <h3 class="mt-4"><b><?php echo $result_array['title']; ?></b></h3>
                <div class="w-100 mt-2" style="display: flex; align-items: center;">
                    <img src="../_data/_images/<?php echo $result_array['course_id']; ?>-company_logo.webp" height="30px" width="30px" style="border-radius: 30px; padding: 2px;">
                    <span style="font-size: 12px;" class="ms-1">Offered by <b><?php echo $result_array['offered_by']; ?></b></span>
                </div>

                <p class="mt-4 mb-3"><b>Course Details</b></p>
                <p class="text-muted"><?php echo $result_array['description']; ?></p>
            </div>  
            <div class="col-md-6 mb-3">
                <div class="w-100" style="display: flex; justify-content: center;">
                    <div class="card course-apply-card">
                        <div class="card-body">
                            <div class="course-apply-video" style="background-image: url(../_data/_images/<?php echo $result_array['course_id']; ?>-thumbnail.webp);"><?php if($result_array['yt_url'] != ""){ echo '<div class="apply-video-play" onclick="play_yt()"><i class="bi bi-play-fill"></i></div>'; } ?></div>
                            
                            <div class="course-apply-yt"><?php if($result_array['yt_url'] != ""){ echo '<iframe id="app_yt" width="100%" height="200" src="https://www.youtube.com/embed/'.get_yt_id($result_array['yt_url']).'" style="background: #eee; border-radius: 10px;"></iframe>'; } ?></div>

                            <div id="apply-details-area">
                                <div class="mb-3 mt-3">
                                    <label class="form-label"><b>Mobile No.</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><img src="../assets/in-flag.webp" height="30px"></span>
                                        <input type="number" class="form-control" id="apply_number" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><b>Name</b></label>
                                    <input class="form-control" type="text" id="apply_name">
                                </div>
                                <button class="btn btn-main w-100" id="apply_btn"><b>Apply Now</b></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
    
    <!-- popular courses area -->
    <div class="container"><p class="mt-5 mb-3"><b>Recommended Courses</b></p></div>
    <div class="w-100 mb-3 pt-4 pb-5" style="background: #edf7ff;">
        <div class="container">
            <div class="popular-carousel">
                <?php
                
                $popular = mysqli_query($conn, "SELECT * FROM `course_lists` ORDER BY `created_at` DESC LIMIT 8");
                while($popular_row = mysqli_fetch_assoc($popular)){
                    if($popular_row['course_id'] != $result_array['course_id']){
                        echo '<div class="carousel-cell me-3">
                            <div class="card course-card h-100" onclick="location.href=&apos;./'.$popular_row['alias'].'&apos;" style="cursor: pointer;">
                                <div class="card-thumb" style="background-image: url(../_data/_images/'.$popular_row['course_id'].'-thumbnail.webp)"></div>
                                <div class="card-body p-2">
                                    <div class="w-100"><b class="text-deco-1">'.$popular_row['title'].'</b></div>
                                    <div class="w-100 mt-1" style="font-size: 12px; color: #666;"><i class="bi bi-stopwatch" style="color: #F6635C;"></i>&nbsp;&nbsp;'.$popular_row['time_to_complete'].'</div>
                                    <div class="w-100 mt-2" style="display: flex; align-items: center;">
                                        <img src="../_data/_images/'.$popular_row['course_id'].'-company_logo.webp" height="30px" width="30px" style="border-radius: 30px; padding: 2px;">
                                        <span style="font-size: 12px;" class="ms-1">'.$popular_row['offered_by'].'</span>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    }
                }
                
                ?>
            </div>
        </div>  
    </div>
      
    <!-- newsletter area -->
    <?php include '../_ui/_newsletter.php'; ?>
      
    <!-- footer area -->
    <?php include '../_ui/_footer.php'; ?>
      
    <!-- credit area -->
    <?php include '../_ui/_credit.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
      
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js" integrity="sha512-zP5W8791v1A6FToy+viyoyUUyjCzx+4K8XZCKzW28AnCoepPNIXecxh9mvGuy3Rt78OzEsU+VCvcObwAMvBAww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      
    <!-- flickity -->
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script>
        
        const page_course_id = "<?php echo $result_array['course_id']; ?>";
        
        $(document).ready(function(){
            if(localStorage.getItem('apply_name') != undefined && localStorage.getItem('apply_mobile') != undefined){
                $("#apply_name").val(localStorage.getItem('apply_name'));
                $("#apply_number").val(localStorage.getItem('apply_mobile'));
            }
        });
        
        $('.popular-carousel').flickity({
          // options
          cellAlign: 'left',
          contain: true
        });
        
        function play_yt(){
            $(".course-apply-video").css({display: 'none'});
            $(".course-apply-yt").css({display: 'block'});
        }
        
        $("#apply_btn").click(function(){
            let mobile = $("#apply_number").val(); 
            let name = $("#apply_name").val(); 
            
            if(mobile != "" && name != ""){
                if(/^\d{10}$/.test(mobile)){
                    
                    $("#apply_btn").prop('disabled', true);
                    $("#apply_btn").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span class="visually-hidden" role="status">Loading...</span>');
                    
                    $.ajax({
                        type: "POST",
                        url: '../_req_to/_apply.php',
                        data: {name: name, mobile: mobile, applied_for: page_course_id},
                        success: function(data){
                            //console.log(data);
                            if(data == "success"){
                                $("#apply-details-area").html('<div class="w-100 mt-3 mb-3 text-center"><p class="text-center"><i class="bi bi-check-circle-fill" style="font-size: 50px; color: #46b860;"></i></p><b>Your application submitted successfully!</b><br><span class="text-muted" style="font-size: 12px;">Please wait, we will contact you soon.</span></div>');
                                
                                localStorage.setItem('apply_name', name);
                                localStorage.setItem('apply_mobile', mobile);
                            }
                        }
                    });
                }else{
                    $.alert({
                        type: 'red',
                        title: 'Invalid number',
                        content: 'Please, submit with a valid mobile number.',
                        icon: 'bi bi-x-circle-fill'
                    });
                }
            }else{
                $.alert({
                    type: 'red',
                    title: 'Empty details',
                    content: 'Please, enter your mobile no. & name to submit application.',
                    icon: 'bi bi-x-circle-fill'
                });
            }
        });
    </script>
  </body>
</html>