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
    <link rel="stylesheet" href="../css/styles.css?ref=<?php echo time(); ?>">
  </head>
  <body>
    
    <!-- navbar area -->
    <?php include '../_ui/_header.php'; ?>
      
    <!-- main area -->
    <div class="container mb-4" style="margin-top: 100px">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="w-100"><span style="background: #F6635C; border-radius: 30px; color: #ffffff; font-size: 14px; padding: 5px 10px;"><b>Course Category</b></span></div>
                <h3 class="mt-4"><b>Professional Content Writing</b></h3>
                <div class="w-100 mt-2" style="display: flex; align-items: center;">
                    <img src="https://dummyimage.com/512x512" height="30px" width="30px" style="border-radius: 30px; padding: 2px;">
                    <span style="font-size: 12px;" class="ms-1">Offered by <b>Company Inc.</b></span>
                </div>

                <p class="mt-4 mb-3"><b>Course Details</b></p>
                <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen boo k. It has survived not only five centuries.</p>
            </div>  
            <div class="col-md-6 mb-3">
                <div class="w-100" style="display: flex; justify-content: center;">
                    <div class="card course-apply-card">
                        <div class="card-body">
                            <div class="course-apply-video"><div class="apply-video-play"><i class="bi bi-play-fill"></i></div></div>
                            <div class="course-apply-yt"></div>

                            <div class="mb-3 mt-3">
                                <label class="form-label"><b>Mobile No.</b></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><img src="../assets/in-flag.webp" height="30px"></span>
                                    <input type="number" class="form-control" id="a_number" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><b>Name</b></label>
                                <input class="form-control" type="text">
                            </div>
                            <button class="btn btn-main w-100"><b>Apply Now</b></button>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
    
    <!-- popular courses area -->
    <div class="container"><p class="mt-5 mb-3"><b>Recommended Courses</b></p></div>
    <div class="w-100 mb-3 pt-4 pb-5" style="background: #E8FFF9;">
        <div class="container">
            <div class="popular-carousel">
                <div class="carousel-cell me-3">
                    <div class="card course-card">
                        <div class="card-thumb"></div>
                        <div class="card-body p-2">
                            <div class="w-100"><b>Title of course</b></div>
                            <div class="w-100" style="font-size: 12px; color: #666;"><i class="bi bi-stopwatch" style="color: #F6635C;"></i>&nbsp;&nbsp;3 weeks</div>
                            <div class="w-100 mt-2" style="display: flex; align-items: center;">
                                <img src="https://dummyimage.com/512x512" height="30px" width="30px" style="border-radius: 30px; padding: 2px;">
                                <span style="font-size: 12px;" class="ms-1">Company Inc.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-cell me-3">
                    <div class="card course-card">
                        <div class="card-thumb"></div>
                        <div class="card-body p-2">
                            <div class="w-100"><b>Title of course</b></div>
                            <div class="w-100" style="font-size: 12px; color: #666;"><i class="bi bi-stopwatch" style="color: #F6635C;"></i>&nbsp;&nbsp;3 weeks</div>
                            <div class="w-100 mt-2" style="display: flex; align-items: center;">
                                <img src="https://dummyimage.com/512x512" height="30px" width="30px" style="border-radius: 30px; padding: 2px;">
                                <span style="font-size: 12px;" class="ms-1">Company Inc.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-cell me-3">
                    <div class="card course-card">
                        <div class="card-thumb"></div>
                        <div class="card-body p-2">
                            <div class="w-100"><b>Title of course</b></div>
                            <div class="w-100" style="font-size: 12px; color: #666;"><i class="bi bi-stopwatch" style="color: #F6635C;"></i>&nbsp;&nbsp;3 weeks</div>
                            <div class="w-100 mt-2" style="display: flex; align-items: center;">
                                <img src="https://dummyimage.com/512x512" height="30px" width="30px" style="border-radius: 30px; padding: 2px;">
                                <span style="font-size: 12px;" class="ms-1">Company Inc.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-cell me-3">
                    <div class="card course-card">
                        <div class="card-thumb"></div>
                        <div class="card-body p-2">
                            <div class="w-100"><b>Title of course</b></div>
                            <div class="w-100" style="font-size: 12px; color: #666;"><i class="bi bi-stopwatch" style="color: #F6635C;"></i>&nbsp;&nbsp;3 weeks</div>
                            <div class="w-100 mt-2" style="display: flex; align-items: center;">
                                <img src="https://dummyimage.com/512x512" height="30px" width="30px" style="border-radius: 30px; padding: 2px;">
                                <span style="font-size: 12px;" class="ms-1">Company Inc.</span>
                            </div>
                        </div>
                    </div>
                </div>
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