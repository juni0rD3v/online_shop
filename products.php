<?php
    $pesos = "\u{20b1}";
	session_start();
	unset($_SESSION['AdminID']);
	unset($_SESSION['CustomerID']);
	require_once('database/connection.php');


?>
<!DOCTYPE html>
<html lang="en">
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
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<link href="css/style.css" rel="stylesheet">

<link href="vendor/sidebar/demo.css" rel="stylesheet">
</head>
<body class="fixed-bottom-padding">
    
<div class="shadow shadow-sm osahan-main-nav">
    <nav class="navbar navbar-expand-lg navbar-light  osahan-header py-0 container">
        <a class="navbar-brand mr-0" href="index"><img class="img-fluid logo-img " src="images/logo_blue.png"> <h4 class="font-weight-bold text-dark" style="float: right; margin-top: 10px;"></h4></a>    
    
</nav>

</div>
<nav aria-label="breadcrumb" class="breadcrumb mb-0">
<div class="container">
<ol class="d-flex align-items-center mb-0 p-0">
<li class="breadcrumb-item active"aria-current="page">Home</li>
<li class="breadcrumb-item active" aria-current="page">All Products</li>
</ol>
</div>
</nav>

<section class="py-4 osahan-main-body">
<div class="container">
<div class="row">
<div class="col-lg-3">
    <div class="osahan-account bg-white rounded shadow-sm overflow-hidden">
        <div class="p-4 profile text-center border-bottom">
            <!-- <img src="img/user.png" class="img-fluid rounded-pill"> -->
            <h6 class="font-weight-bold m-0 mt-2"><a href="signup" class="text-" style="margin-right: 10px"><b>Sign Up</b></a> | <a href="login" style="margin-left: 10px;" class="text"><b>Login</b></a></h6>
            <!-- <p class="small text-muted m-0"><a href="https://askbootstrap.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="432a222e2c30222b222d03242e222a2f6d202c2e">[email&#160;protected]</a></p> -->
        </div>
        <div class="account-sections">
            <ul class="list-group">
                <a href="index" class="text-decoration-none text-dark">
                    <li class="border-bottom bg-white d-flex align-items-center p-3">
                    <i class="icofont-home osahan-icofont bg-info"></i>Home
                    <span class="badge badge-info p-1 badge-pill ml-auto"><i class="icofont-simple-right"></i></span>
                    </li>
                </a>
                <a href="products" class="text-decoration-none text-dark">
                    <li class="border-bottom bg-white d-flex  align-items-center p-3">
                    <i class="icofont-cart osahan-icofont bg-info"></i> All Products
                    </li>
                </a>
                <form action="" method="POST" class="p-2">
            <div class="input-group mr-sm-2 col-lg-12">
                <input type="text" name="searchtxt" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Search for Products..">
                <div class="input-group-prepend">
                <button type="submit" class="btn btn-dark rounded-right"><i class="icofont-search"></i></button>
                </div>
            </div>
            </form>
                <!-- <a href="signup" class="text-decoration-none text-dark">
                    <li class="border-bottom bg-white d-flex  align-items-center p-3">
                    <i class="icofont-lock osahan-icofont bg-danger"></i> Sign Up
                    </li>
                </a>
                <a href="login" class="text-decoration-none text-dark">
                    <li class="border-bottom bg-white d-flex  align-items-center p-3">
                    <i class="icofont-lock osahan-icofont bg-danger"></i>Log In
                    </li>
                </a> -->
            </ul>
        </div>
    </div>
</div>
<div class="col-lg-9 p-4 bg-white rounded shadow-sm">
<div class="osahan-promos">
<h4 class="mb-4 profile-title">All Products</h4>
<div class="pick_today">
    <div class="row">
        <?php
            if (isset($_POST['searchtxt']))
            {
                $searchtxt = mysqli_real_escape_string($dbc, $_POST['searchtxt']);
                $q = @mysqli_query($dbc, "SELECT * FROM tbl_products WHERE clm_desc LIKE '%$searchtxt%' AND clm_quantity != 0 ");
            }
            else
            {
                $q = @mysqli_query($dbc, "SELECT * FROM tbl_products WHERE clm_quantity != 0");
            }

            if (mysqli_num_rows($q) == 0)
            {
                echo '<h6 style="margin-top: 100px;">No products found!</h6>';
            }
            else
            {
            while ($row = mysqli_fetch_array($q))
            {
                
        ?>

        <div class="col-6 col-md-3 mb-3">
            <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                <div class="list-card-image">
                    <div class="p-3">
                        <div class="text-center">
                        <img src="img/listing/<?php echo $row['clm_image'];?>" class="img-fluid item-img w-50 mb-3">
            </div>
                        <h6><?php echo $row['clm_desc'];?></h6>
                        Available Stock:  <b><?php echo $row['clm_quantity'];?> </b>
                        <div class="d-flex align-items-center">
                        
                        <h6 class="price m-0 text-dark"><b><?php echo $pesos.' '.number_format($row['clm_price'], 2);?></b></h6>
                        <a href="login" class="btn btn-dark text-dark btn-sm ml-auto edit_product"><i class="fa fa-cart-plus" ></i></a>       
                        </div>                     
                    </div>
                </div>
            </div>
        </div>
        <?php
            
            }// while
            }// else
        ?>

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
<style>