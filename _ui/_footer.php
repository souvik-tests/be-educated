<?php

echo '<div class="w-100 pt-4 pb-4" style="background: #ffffff;">
        <div class="container" id="footer-area">
            <div class="row">
                <div class="col-md-4">
                    <img src="https://demo.bytestech.xyz/assets/logo.webp" height="50px" width="50px" style="border: 2px solid #6e99df; border-radius: 50px;">
                    <h5 class="mt-3"><b>BeEducated</b></h5>
                    <p class="text-muted" style="font-size: 14px;">Be educated so that you can<br>change the world.</p>
                </div>
                <div class="col-md-4">
                    <p style="color: #09548c;"><b>Important Links</b></p>
                    <p>
                        <a href="#">Home</a><br>
                        <a href="#">About</a><br>
                        <a href="#">Contact</a><br>
                        <a href="#">Browse Courses</a><br>
                        <a href="#">Browse Category</a><br>
                        <a href="#">Sitemap</a><br>
                    </p>
                </div>
                <div class="col-md-4">
                    <p style="color: #09548c;"><b>Other Links</b></p>
                    <p>
                        <a href="#">Privacy Policy</a><br>
                        <a href="#">Disclaimer</a><br>
                        <a href="#">Terms &amp; Conditions</a><br>
                    </p>
                </div>
            </div>
        </div>  
    </div>';

echo '<script>let current_url=location.href;$.ajax({type:"GET",url:"https://demo.bytestech.xyz/_req_to/_track_visitor.php?url="+current_url,success:function(data){console.log(data);}});</script>';

?>