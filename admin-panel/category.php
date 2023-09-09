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
    <title>Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css?ref=<?php echo time(); ?>">
  </head>
  <body>
      
    <nav class="navbar bg-body-tertiary" style="box-shadow: 1px 1px 10px rgba(0,0,0,0.1);">
      <div class="container">
        <div class="navbar-brand" style="display: flex; align-items: center;">
            <button class="btn btn-dark btn-sm" style="border-radius: 50px;" onclick="location.href='./'"><i class="bi bi-arrow-left"></i></button>
            <b class="ms-2">Categories</b>
        </div>
      </div>
    </nav>
      
    <div class="container mt-3">
        <div class="w-100" style="display: flex; align-items: center; justify-content: space-between;"><div><b>All Categories</b></div><button class="btn btn-main btn-sm" id="start-new-cat"><b>New Category</b></button></div>  
        <div class="row mt-3">
            <?php
            
            $apps = mysqli_query($conn, "SELECT * FROM `category_lists` ORDER BY `created_at` DESC");
            if(mysqli_num_rows($apps) > 0){
                while($a_row = mysqli_fetch_assoc($apps)){
                    echo '<div class="col-md-3 mb-3">
                        <div class="category-card" style="position: relative;">
                            
                            <div style="position: absolute; top: 0; right: 0; margin-top: 7px; margin-right: 7px;">
                                <button class="btn btn-sm btn-primary btn-mini"><i class="bi bi-pencil-fill" onclick="update_this_category(&apos;'.$a_row['c_id'].'&apos;)"></i></button>
                                <!--<button class="btn btn-sm btn-danger btn-mini ms-1"><i class="bi bi-trash-fill"></i></button>-->
                            </div>
                            
                            <div class="category-image" style="background-image: url(../_data/_images/'.$a_row['c_id'].'-category_banner.webp);"></div>
                            <div class="ms-2"><span><b>'.$a_row['title'].'</b><br></span><!--<span style="font-size: 12px; color: #E4433B;">35 courses</span>--></div>
                        </div>
                    </div>';
                }
            }else{
                echo '<div class="p-2 mt-5 text-center"><img src="https://img.icons8.com/external-topaz-kerismaker/96/external-Empty-empty-state-topaz-kerismaker.png" height="80px"><div class="w-100 mt-3">No categories found :(</div></div>';
            }
            
            ?>
        </div>
    </div>
      
    <!-- createNewModal -->
    <form method="post" action="./_submit/_new_category.php" enctype="multipart/form-data"><div class="modal animate__animated animate__slideInUp" id="newCat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="newCatLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="newCatLabel">New Category</h1>
            <button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal" style="border-radius: 50px;"><i class="bi bi-x-lg"></i></button>
          </div>
          <div class="modal-body">
              <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="mb-3"><label class="form-label"><b>Category Title</b></label><input type="text" class="form-control" name="title" id="category_title" required></div>
                        
                        <div class="w-100 mb-3">
                            <div class="row" style="align-items: center;">
                                <div class="col-5"><div class="app-logo mb-2"></div></div>
                                <div class="col-7"><label class="form-label"><b>Category Thumbnail</b></label><input type="file" class="form-control" name="category_banner" id="category_banner" accept="image/png, image/webp, image/jpeg" required></div>
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
      
    <!-- updateNewModal -->
    <form method="post" action="./_submit/_update_category.php" enctype="multipart/form-data"><div class="modal animate__animated animate__slideInUp" id="updateCat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateCatLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="updateCatLabel">Rename Category</h1>
            <button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal" style="border-radius: 50px;"><i class="bi bi-x-lg"></i></button>
          </div>
          <div class="modal-body">
              <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        
                        <input type="hidden" name="c_id" id="update_cat_id">
                        
                        <div class="mb-3"><label class="form-label"><b>Category Title</b></label><input type="text" class="form-control" name="title" id="update_category_title" required></div>
                        
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
        }
    </style>
      
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js" integrity="sha512-zP5W8791v1A6FToy+viyoyUUyjCzx+4K8XZCKzW28AnCoepPNIXecxh9mvGuy3Rt78OzEsU+VCvcObwAMvBAww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script src="js/app.js?ref=<?php echo time(); ?>"></script>
    <script>
        $(document).ready(function(){
            category_banner.onchange = evt => {
              const [file] = category_banner.files
              if (file) {
                $(".app-logo").css({backgroundImage: "url("+URL.createObjectURL(file)+")"});
              }
            }
        }) 
    </script>
  </body>
</html>