<?php

echo '<nav class="navbar fixed-top bg-body-tertiary">
      <div class="container">
        <a class="navbar-brand" href="https://demo.bytestech.xyz/" style="display: flex; align-items: center; justify-content: flex-start;">
            <img src="https://demo.bytestech.xyz/assets/logo.webp" height="40px" width="40px" style="border: 2px solid #6e99df; border-radius: 40px;">
            <b class="ms-2">BeEducated</b>
        </a>
        <div id="nav-pc">
            <a href="#" class="me-3"><b>Home</b></a>
            <a href="#" class="me-3"><b>About</b></a>
            <a href="#" class="me-3"><b>Contact</b></a>
            
            <button class="btn btn-main"><b>Subscribe</b></button>
          </div>
          <div id="nav-mobile"><button class="btn btn-main" style="padding: 10px 15px !important; border-radius: 50px !important;"><b><i class="bi bi-list"></i></b></button></div>
      </div>
    </nav>';

echo '<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>';

echo '<script>
        $(document).ready(function(){
            window.onscroll = function () {
                if (document.body.scrollTop >= 200 || document.documentElement.scrollTop >= 200) {
                    $(".navbar").css({boxShadow: "1px 1px 10px rgba(0,0,0,0.2)"});
                } 
                else {
                    $(".navbar").css({boxShadow: "none"});
                }
            };
        });  
    </script>';

?>