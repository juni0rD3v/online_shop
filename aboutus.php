<?php
    require_once('database/connection.php');

    $q = @mysqli_query($dbc, "SELECT * FROM tbl_setup");
    $row = mysqli_fetch_array($q);
    $clm_about_us = htmlspecialchars($row['clm_about_us'], ENT_QUOTES);


?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from askbootstrap.com/preview/vegishop/home.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 23 Sep 2021 08:33:44 GMT -->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/png" href="img/kimson_logo.png">
<title>Kimson Online Grocery</title>

<link rel="stylesheet" type="text/css" href="vendor/slick/slick.min.css" />
<link rel="stylesheet" type="text/css" href="vendor/slick/slick-theme.min.css" />

<link href="vendor/icons/icofont.min.css" rel="stylesheet" type="text/css">

<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<link href="css/style.css" rel="stylesheet">

<link href="vendor/sidebar/demo.css" rel="stylesheet">
</head>
<body class="fixed-bottom-padding">

<!-- MOBILE VIEW-->
<div class="border-bottom p-3 d-none mobile-nav">
    <div class="title d-flex align-items-center">
        <a href="home.html" class="text-decoration-none text-dark d-flex align-items-center">
            <img class="osahan-logo mr-2" src="img/kimson_logo.png">
            <h4 class="font-weight-bold text-success m-0">Kimson</h4>
        </a>
    </div>
    <a href="" class="text-decoration-none">
        <div class="input-group mt-3 rounded shadow-sm overflow-hidden bg-white">
            <div class="input-group-prepend">
                <button class="border-0 btn btn-outline-secondary text-success bg-white"><i class="icofont-search"></i></button>
            </div>
            <input type="text" class="shadow-none border-0 form-control pl-0" placeholder="Search for Products.." aria-label="" aria-describedby="basic-addon1">
        </div>
    </a>
</div>

<div class="bg-white shadow-sm osahan-main-nav">
    <nav class="navbar navbar-expand-lg navbar-light bg-white osahan-header py-0 container">
        <a class="navbar-brand mr-0" href="index"><img class="img-fluid logo-img " src="img/kimson_logo.png"> <h4 class="font-weight-bold text-success" style="float: right; margin-top: 10px;">Kimson</h4></a>    
    
        <div class="ml-4 d-flex align-items-center">
            <div class="dropdown mr-3">
               
                
            </div>

            <div class="input-group mr-sm-2 col-lg-12">
                <input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Search for Products..">
                <div class="input-group-prepend">
                <div class="btn btn-success rounded-right"><i class="icofont-search"></i></div>
                </div>
            </div>
        </div>
        <div class="ml-auto d-flex align-items-center">
            <a href="signup" class="text-success" style="margin-right: 10px"><b>Sign Up</b></a> | <a href="login" style="margin-left: 10px;" class="text-success"><b>Login</b></a>

        <div class="dropdown">

        <div class="dropdown-menu dropdown-menu-right p-0 osahan-notifications-main" aria-labelledby="dropdownMenuNotification">



<a href="cart.html" class="ml-2 text-dark bg-light rounded-pill p-2 icofont-size border shadow-sm">
<i class="icofont-shopping-cart"></i>
</a>
</div>
</nav>

    <div class="bg-color-head">
        <div class="container menu-bar d-flex align-items-center">
            <ul class="list-unstyled form-inline mb-0">
                <li class="nav-item active">
                    <a class="nav-link text-white pl-0" href="index">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link text-white pl-0" href="products">All Products</a>
                </li>
            </ul>
        </div>
    </div>

</div>


<section class="py-4 osahan-main-body">
<div class="container">
<div class="row">
<div class="col-lg-12">

<div class="osahan-home-page">

<div class="osahan-body">


</div>
</div>



<div class="title d-flex align-items-center py-3">
<h5 class="m-0">About Us</h5>
</div> 
<div style="min-height: 200px;">
<?php
    echo str_replace(array("\r\n", "\n"), array("<br />", "<br />"), $clm_about_us);
?>

    
</div>
 
</div>
</div>
</a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>

<?php include 'customer/include/footer.php'; ?>

<script src="vendor/jquery/jquery.min.js" type="e10e8c727bde489a17f3de45-text/javascript"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js" type="e10e8c727bde489a17f3de45-text/javascript"></script>

<script type="e10e8c727bde489a17f3de45-text/javascript" src="vendor/slick/slick.min.js"></script>

<script type="e10e8c727bde489a17f3de45-text/javascript" src="vendor/sidebar/hc-offcanvas-nav.js"></script>

<script src="js/osahan.js" type="e10e8c727bde489a17f3de45-text/javascript"></script>
<script src="../../cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="e10e8c727bde489a17f3de45-|49" defer=""></script><script defer src="../../../static.cloudflareinsights.com/beacon.min.js" data-cf-beacon='{"rayId":"69326dfe18453517","version":"2021.8.1","r":1,"token":"dd471ab1978346bbb991feaa79e6ce5c","si":10}'></script>
</body>

<!-- Mirrored from askbootstrap.com/preview/vegishop/home.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 23 Sep 2021 08:34:08 GMT -->
</html>