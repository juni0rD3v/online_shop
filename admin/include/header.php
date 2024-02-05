<?php
    session_start();
    require_once('../database/connection.php');
    if (empty($_SESSION['AdminID'])){echo '<script>location.replace("../login");</script>';}
    else
    {
        $AdminID = $_SESSION['AdminID'];
        $q = @mysqli_query($dbc, "SELECT * FROM tbl_admin WHERE clm_adminid = '$AdminID' ");
        $row_admin = mysqli_fetch_array($q);
        $fullname = $row_admin['clm_username'];
        $type = $row_admin['clm_type'];
        $pass = $row_admin['clm_password'];

    }
    $pesos = "\u{20b1}";
    if ($active != 'view_order'){ unset($_SESSION['view_order']); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/png" href="../images/logo_blue.png">
<title>Kimson Online Shopping</title>

<link rel="stylesheet" type="text/css" href="../vendor/slick/slick.min.css" />
<link rel="stylesheet" type="text/css" href="../vendor/slick/slick-theme.min.css" />

<link href="../vendor/icons/icofont.min.css" rel="stylesheet" type="text/css">
<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<link href="../css/syle.css" rel="stylesheet">

<link href="../vendor/sidebar/demo.css" rel="stylesheet">
<link href="../vendor/sidebar/demo.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../vendor/slick/slick.min.css" />
<link rel="stylesheet" type="text/css" href="../vendor/slick/slick-theme.min.css" />

<link href="../vendor/icons/icofont.min.css" rel="stylesheet" type="text/css">
<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<link href="../css/style.css" rel="stylesheet">

<link href="../vendor/sidebar/demo.css" rel="stylesheet">
</head>
<style>
    img#cimg{
            max-height: 20vh;
            max-width: 20vw;
        }
    #product_img{
            max-height: 10vh;
            max-width: 10vw;
        }
    .btn-green{
        background-color: #4ee44e;
    }
    .btn-green:hover{
        background-color: #148114;
    }
    .btn-orange{
        background-color: #FFA500;
    }
    .btn-orange:hover{
        background-color: #FF6600;
    }
    .bg-red{
        background-color: #E62900;
    }
    
</style>
<body class="fixed-bottom-padding">

<!-- <div class="bg-dark shadow-sm osahan-main-nav">
    <nav class="navbar navbar-expand-lg navbar-light bg-dark osahan-header py-0 container">
        <a class="navbar-brand mr-0" href="index"><img class="img-fluid logo-img " src="../images/logo_blue.png"> <h4 class="font-weight-bold text-dark" style="float: right; margin-top: 10px;"></h4></a>    
    
        <div class="ml-4 d-flex align-items-center">
            <form action="" method="POST">
            <div class="input-group mr-sm-4 col-lg-12" >                
                <input name="searchtxt" type="text" id="myInput" class="form-control" placeholder="Search...">
                <div class="input-group-prepend">
                <button type="submit" class="btn btn-dark rounded-right"><i class="icofont-search"></i></button>
                </div>
            </div>
            </form>
        </div>
        <div class="ml-auto d-flex align-items-center">
            <div class="dropdown mr-3">
                <a href="#" class="dropdown-toggle text-white" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user-circle text-white" style="font-size: 30px; margin-right: 10px;"></i> Hi <?php echo $fullname;?>
                </a>
                <div class="dropdown-menu dropdown-menu-right top-profile-drop" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="manage"><i class="fa fa-cog"></i> Manage account</a>                
                <a class="dropdown-item" href="../logout"><i class="fa fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <?php
        // badge
        $q_toShipBadge = @mysqli_query($dbc, "SELECT * FROM tbl_orders WHERE clm_status = 1 OR clm_status = 2"); 
        if (mysqli_num_rows($q_toShipBadge) != 0)    
        {
            $toShipBadge = '<span class="badge badge-danger">'.mysqli_num_rows($q_toShipBadge).'</span>';
        }
        else
        {
            $toShipBadge = '';
        }     

        $q_toReceiveBadge = @mysqli_query($dbc, "SELECT * FROM tbl_orders WHERE clm_status = 3");        
        if (mysqli_num_rows($q_toReceiveBadge) != 0)
        {
            $toReceiveBadge = '<span class="badge badge-danger">'.mysqli_num_rows($q_toReceiveBadge).'</span>';
        }  
        else
        {
            $toReceiveBadge = '';
        } 
    ?>

    <div class="bg-color-head">
        <div class="container menu-bar d-flex align-items-center" style="height: 50px;">
            <ul class="list-unstyled form-inline mb-0">
                <li class="nav-item dropdown">
                    <a class="nav-link text-white dropdown-toggle <?php if ($active == 'index'){echo ' font-weight-bold';}?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Orders
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item <?php if ($active_sub == 'all'){echo ' font-weight-bold text-dark';}?>" href="all">All</a>
                    <a class="dropdown-item <?php if ($active_sub == 'pending'){echo ' font-weight-bold text-dark';}?>" href="index">Pending <?php echo $toShipBadge ?></a>
                    <a class="dropdown-item <?php if ($active_sub == 'on delivery'){echo ' font-weight-bold text-dark';}?>" href="on_delivery">On Delivery <?php echo $toReceiveBadge; ?></a>
                    <a class="dropdown-item <?php if ($active_sub == 'completed'){echo ' font-weight-bold text-dark';}?>" href="completed">Completed</a>
                    <a class="dropdown-item <?php if ($active_sub == 'cancelled'){echo ' font-weight-bold text-dark';}?>" href="Cancelled">Cancelled</a>                    
                    </div>
                </li>
                <li class="nav-item active">
                    <a class="nav-link text-white pl-0 <?php if ($active == 'products'){echo ' font-weight-bold';}?>" href="products">Products</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link text-white pl-0 <?php if ($active == 'category'){echo ' font-weight-bold';}?>" href="category">Category</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link text-white pl-0 <?php if ($active == 'customers'){echo ' font-weight-bold';}?>" href="customers">Customers</a>
                </li>
                <?php if ($type == 1){?>
                <li class="nav-item active">
                    <a class="nav-link text-white pl-0 <?php if ($active == 'manage_users'){echo ' font-weight-bold';}?>" href="manage_users">Manage Users</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link text-white pl-0 <?php if ($active == 'setup'){echo ' font-weight-bold';}?>" href="setup">Setup</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link text-white pl-0 <?php if ($active == 'reports'){echo ' font-weight-bold';}?>" href="reports">Reports</a>
                </li>
                <?php } ?>
            </ul>            
        </div>
        
    </div>

</div> -->