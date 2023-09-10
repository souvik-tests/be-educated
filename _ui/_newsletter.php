<?php

echo '<div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h3 class="text-center"><b>Subscribe to our Newsletter</b></h3>
                <p class="text-center text-muted" style="font-size: 14px;">Stay updated to lates course update directly to your email. Join us now!</p>
                
                <div class="newsletter-area">
                    <div class="mb-3"><input type="email" placeholder="e.g. yourname@mail.io" class="form-control newsletter-input"></div>
                    <div class="w-100 text-center"><button class="btn btn-main w-100 newsletter-submit"><b>Subscribe</b></button></div>
                </div>
                
            </div>
            <div class="col-md-4"></div>
        </div>  
    </div>';

echo '<script>
        $(".newsletter-submit").click(function(){
            let email = $(".newsletter-input").val();
            if(email != ""){
                $(".newsletter-submit").prop("disabled", true);
                $(".newsletter-submit").html(\'<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span class="visually-hidden" role="status">Loading...</span>\');
                $.ajax({
                    type: "POST",
                    url: "https://demo.bytestech.xyz/_req_to/_subscribe.php",
                    data: {email: email},
                    success: function(data){
                        if(data == "success"){
                            $(".newsletter-area").html(\'<div class="w-100 mt-3 mb-3 text-center"><p class="text-center"><i class="bi bi-check-circle-fill" style="font-size: 50px; color: #46b860;"></i></p><b>Newsletter subscribed successfully!</b></div>\');
                        }else{
                            alert("Something went wrong!");
                        }
                    }
                });
            }else{
                alert("Enter your email to subscribe newsletter!");
            }
        });
    </script>';

?>