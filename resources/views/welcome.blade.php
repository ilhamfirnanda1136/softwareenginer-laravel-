<!DOCTYPE html>
<html>
<head>
    <title>LARAVEL</title>
</head>
<link rel="icon" href="https://smkmita.sch.id/wp-content/uploads/2017/10/favicon.png" sizes="32x32" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="{{asset('css/welcome.css')}}">
<style type="text/css">


</style>
<body>
<p>LARAVEL</p>
    <div id="app_cover">
        <a href="{{route('login.owner')}}" target="_blank" class="block">
            <div class="card" id="c_fb">
                <div class="c_brand_logo"></div>
                <div class="c_share_link">OWNER</div>
            </div>
            <div class="c_c_card">
                <div class="card cc_card" id="c_o_fb">
                    <div class="c_brand_logo"></div>
                    <div class="c_share_link">OWNER</div>
                </div>
            </div>
        </a>
        <a href="{{route('login.admin')}}" target="_blank" class="block">
            <div class="card" id="c_gl">
                <div class="c_brand_logo"></div>
  
                <div class="c_share_link">ADMIN</div>
            </div>
            <div class="c_c_card">
                <div class="card cc_card" id="c_o_gl">
                    <div class="c_brand_logo"></div>
                
                    <div class="c_share_link">ADMIN</div>
                </div>
            </div>
        </a>
        <a href="{{route('login.staff')}}" target="_blank" class="block" >
            <div class="card" id="c_tw">
                <div class="c_brand_logo"></div>
             
                <div class="c_share_link">STAFF</div>
            </div>
            <div class="c_c_card">
                <div class="card cc_card" id="c_o_tw">
                    <div class="c_brand_logo"></div>
                 
                    <div class="c_share_link">STAFF</div>
                </div>
            </div>
        </a>
    </div>
</body>
</html>





