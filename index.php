<?php
include './_config/_conn.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BeEducated</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- flickity -->
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="./css/styles.css?ref=<?php echo time(); ?>">
  </head>
  <body>
    
    <!-- navbar area -->
    <?php include './_ui/_header.php'; ?>
      
    <!-- hero area -->
    <div class="container" style="margin-top: 100px;">
        <div class="row" style="align-items: center;">
            <div class="col-md-6" style="padding: 0px 30px;"><h1><b>Be educated so that <span style="color: #F6635C;">you </span> can <span style="color: #F6635C;">change</span> the world.</b></h1>
            <button class="btn btn-main mt-3"><b><i class="bi bi-rocket-takeoff"></i>&nbsp;&nbsp;Explore Courses</b></button>
            </div>
            <div class="col-md-6"><div class="w-100" style="display: flex; align-items: center; justify-content: center;"><img src="./assets/g1.webp" width="80%"></div></div>
        </div>
    </div>
      
    <!-- popular courses area -->
    <div class="w-100 mt-5 mb-3 pt-5 pb-5" style="background: #E8FFF9;">
        <h3 class="text-center mb-4" style="color: #0B7259;"><b>Popular Courses</b></h3>
        <div class="container">
            <div class="popular-carousel">
                <?php
                
                $popular = mysqli_query($conn, "SELECT * FROM `course_lists` ORDER BY `created_at` DESC LIMIT 8");
                while($popular_row = mysqli_fetch_assoc($popular)){
                    echo '<div class="carousel-cell me-3">
                    <div class="card course-card h-100" onclick="location.href=&apos;./course?id='.$popular_row['course_id'].'&apos;" style="cursor: pointer;">
                        <div class="card-thumb" style="background-image: url(./_data/_images/'.$popular_row['course_id'].'-thumbnail.webp)"></div>
                        <div class="card-body p-2">
                            <div class="w-100"><b class="text-deco-1">'.$popular_row['title'].'</b></div>
                            <div class="w-100 mt-1" style="font-size: 12px; color: #666;"><i class="bi bi-stopwatch" style="color: #F6635C;"></i>&nbsp;&nbsp;'.$popular_row['time_to_complete'].'</div>
                            <div class="w-100 mt-2" style="display: flex; align-items: center;">
                                <img src="./_data/_images/'.$popular_row['course_id'].'-company_logo.webp" height="30px" width="30px" style="border-radius: 30px; padding: 2px;">
                                <span style="font-size: 12px;" class="ms-1">'.$popular_row['offered_by'].'</span>
                            </div>
                        </div>
                    </div>
                </div>';
                }
                
                ?>
            </div>
        </div>  
    </div>
      
      
    <!-- about area -->
    <div class="container mt-5 mb-5">
        <div class="row" style="align-items: center;">
            <div class="col-md-6">
                <div class="w-100" style="display: flex; justify-content: center;"><img src="assets/g2.webp" width="50%"></div>
            </div>  
            <div class="col-md-6">
                <div class="w-100">
                    <h1><b>Who Are We?</b></h1>
                    <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen boo k. It has survived not only five centuries.</p>
                    <button class="btn btn-main"><b>Learn More</b></button>
                </div>
            </div> 
        </div>
    </div>  
      
      
    <!-- category area -->
    <div class="w-100 mt-5 pt-5 pb-5" style="background: #FFE2DE;">
    <div class="container">
        <div class="row" style="align-items: center;">  
            <div class="col-md-6 mb-3">
                <div class="w-100">
                    <h1><b>Browse<br>By Category</b></h1>
                    <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    <button class="btn btn-main"><b>Browse Categories</b></button>
                </div>
            </div> 
            <div class="col-md-6">
                <div class="row">
                    <?php
                    
                    $cat_lists = mysqli_query($conn, "SELECT DISTINCT cat.c_id, cat.title, COUNT(c.course_id) as courses, cat.created_at FROM category_lists as cat, course_lists as c WHERE cat.c_id = c.category_id GROUP BY cat.c_id ORDER BY cat.created_at DESC");
                    while($ct_lst = mysqli_fetch_assoc($cat_lists)){
                        echo '<div class="col-md-6 mb-3">
                                <div class="category-card">
                                    <div class="category-image" style="background-image: url(./_data/_images/'.$ct_lst['c_id'].'-category_banner.webp);"></div>
                                    <div class="ms-2"><span><b style="font-size: 14px;">'.$ct_lst['title'].'</b><br></span><span style="font-size: 12px; color: #E4433B;">'.$ct_lst['courses'].' courses</span></div>
                                </div>
                            </div>';
                    }
                    
                    ?>
                </div>
            </div>
        </div> 
    </div>
    </div>
      
    <!-- newsletter area -->
    <?php include './_ui/_newsletter.php'; ?>
      
    <!-- footer area -->
    <?php include './_ui/_footer.php'; ?>
      
    <!-- credit area -->
    <?php include './_ui/_credit.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- flickity -->
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script>
        $('.popular-carousel').flickity({
          // options
          cellAlign: 'left',
          contain: true
        });  
    </script>
  </body>
</html>