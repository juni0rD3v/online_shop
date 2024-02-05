
<?php
    session_start();
    unset($_SESSION['AdminID']);
	unset($_SESSION['CustomerID']);
    require_once('database/connection.php');

    if (isset($_POST['signupBtn']))
    {
        $fname = mysqli_real_escape_string($dbc, $_POST['fname']);
        $lname = mysqli_real_escape_string($dbc, $_POST['lname']);
        // $email = mysqli_real_escape_string($dbc, $_POST['email']);
        $address = mysqli_real_escape_string($dbc, $_POST['address']);
        $contact = mysqli_real_escape_string($dbc, $_POST['contact']);
        $user = mysqli_real_escape_string($dbc, $_POST['user']);
        $pass = mysqli_real_escape_string($dbc, $_POST['pass']);
        $conpass = mysqli_real_escape_string($dbc, $_POST['conpass']);
        // check email or username if already exist
        $q = @mysqli_query($dbc, "SELECT * FROM tbl_customers WHERE clm_username = '$user' ");
        if (mysqli_num_rows($q) == 0)
        {
            // check if same password with confirm pass
            if ($pass == $conpass)
            {
                // customer code
                $custid = 'CUS'.date('ydmhi');
                $q = @mysqli_query($dbc, "INSERT INTO tbl_customers 
                (clm_customerid,clm_fname,clm_lname,clm_address,clm_contact,clm_username,clm_password) VALUES 
                ('$custid','$fname','$lname','$address','$contact','$user',md5('$pass')) ");
                if ($q)
                {
                    $_SESSION['dark_registration'] = 'true';                    
                    echo '<script>location.replace("login");</script>';
                }
                else
                {
                    $_SESSION['error_query'] = $q;
                }				
            }
            else
            {
                $_SESSION['error_pass'] = 'true';
            }
        }
        // else
        // {
        //     $_SESSION['error_email'] = 'true';
        // }

    }
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
<li class="breadcrumb-item active" aria-current="page">Sign in</li>
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
    
<div class="col-lg-12 pl-lg-5">
                    <div class="osahan-signin shadow-sm bg-white p-4 rounded">
                    <div class="p-3">
                    <h2 class="my-0">Let's get started</h2>
                    <p class="small mb-4">Create account to start shopping.</p>
                    <?php
                        // if (!empty($_SESSION['error_email']))
                        // {
                        //     echo'
                        //     <div class="alert alert-danger alert-dismissible">
                        //         Email address or Username already in use.
                        //     </div>';
                        //     unset($_SESSION['error_email']);
                        // }
                        if (!empty($_SESSION['error_pass']))
                        {
                            echo'
                            <div class="alert alert-danger alert-dismissible">
                                Passwords not match.
                            </div>';
                            unset($_SESSION['error_pass']);
                        }
                        if (!empty($_SESSION['error_query']))
                        {
                            echo'
                            <div class="alert alert-danger alert-dismissible">
                                '.mysqli_error($dbc).'<br>'.$_SESSION['error_query'].'
                            </div>';
                            unset($_SESSION['error_query']);
                        }
                    ?>
                    <form action="" method="POST">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>First Name</label>
                                <input required name="fname" placeholder="Enter First Name" type="text" class="form-control">
                            </div>                       
                            <div class="form-group col-md-6">
                                <label>Last Name</label>
                                <input required name="lname" placeholder="Enter Last Name" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <!-- <div class="form-group col-md-6">
                                <label>Email</label>
                                <input name="email" placeholder="Enter Email" type="email" class="form-control">
                            </div> -->
                            <div class="form-group col-md-12">
                                    <label>Address</label>
                                    <input required name="address" placeholder="Enter Address" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Username</label>
                                <input required name="user" placeholder="Enter Username" type="text" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Phone Number</label>
                                <input required name="contact" placeholder="Enter Phone Number" limit="11" type="number" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Password</label>
                                <input required name="pass" placeholder="Enter Password" type="password" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Confirm Password</label>
                                <input required name="conpass" placeholder="Confirm Password" type="password" class="form-control">
                            </div>   
                        </div>                 
                        <button type="submit" name="signupBtn" class="btn btn-dark btn-lg rounded btn-block">Sign Up</button>
                    </form>                    
                    <p class="text-center mt-3 mb-0"><a href="login" class="text-dark">Already have an account! Log in</a></p>
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