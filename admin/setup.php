
<?php
    $active = 'setup';
    include 'include/header.php';
    if ($type != 1){echo '<script>location.replace("../login");</script>';}
    
    if (isset($_POST['update_aboutus']))
    {
        $aboutus = mysqli_real_escape_string($dbc, $_POST['aboutus']);
        $q = @mysqli_query($dbc, "UPDATE tbl_setup SET clm_about_us = '$aboutus' ");
        $_SESSION['success'] = 'Successfully updated!';
    }

    if (isset($_POST['update_contactus']))
    {
        $hotline = mysqli_real_escape_string($dbc, $_POST['hotline']);
        $email = mysqli_real_escape_string($dbc, $_POST['email']);
        $q = @mysqli_query($dbc, "UPDATE tbl_setup SET clm_hotline = '$hotline', clm_email = '$email' ");
        $_SESSION['success'] = 'Successfully updated!';
    }

    if (isset($_POST['update_payment']))
    {
        $payment = mysqli_real_escape_string($dbc, $_POST['payment']);
        $q = @mysqli_query($dbc, "UPDATE tbl_setup SET clm_payment = '$payment' ");
        $_SESSION['success'] = 'Successfully updated!';
    }

    if (isset($_POST['update_followus']))
    {
        $fb = mysqli_real_escape_string($dbc, $_POST['fb']);
        $twitter = mysqli_real_escape_string($dbc, $_POST['twitter']);
        $instagram = mysqli_real_escape_string($dbc, $_POST['instagram']);
        $q = @mysqli_query($dbc, "UPDATE tbl_setup SET clm_fb = '$fb', clm_twitter = '$twitter', clm_instagram = '$instagram' ");
        if ($q)
        {
            $_SESSION['success'] = 'Successfully updated!';
        }
        else
        {
            $_SESSION['error'] = mysqli_error($dbc);
        }
    }

    if (isset($_POST['update_delivery_fee']))
    {
        $delivery_fee = mysqli_real_escape_string($dbc, $_POST['delivery_fee']);
        $q = @mysqli_query($dbc, "UPDATE tbl_setup SET clm_delivery_fee = '$delivery_fee' ");
        if ($q)
        {
            $_SESSION['success'] = 'Successfully updated!';
        }
        else
        {
            $_SESSION['error'] = mysqli_error($dbc);
        }
    }
    
    
    //
?>

<body class="fixed-bottom-padding">
    
<div class="shadow shadow-sm osahan-main-nav">
    <nav class="navbar navbar-expand-lg navbar-light  osahan-header py-0 container">
    
</nav>
<div class="col-lg-12 text-center shadow">
        <a class="navbar-brand align-items-center mr-0" href="index"><img class="img-fluid logo-img " src="../images/logo_blue.png"> <h4 class="font-weight-bold text-dark" style="float: right; margin-top: 10px;"></h4></a>    
</div>
</div>
<nav aria-label="breadcrumb" class="breadcrumb mb-0">
<div class="container">
<ol class="d-flex align-items-center mb-0 p-0">
<li class="breadcrumb-item active"aria-current="page">Home</li>
<li class="breadcrumb-item active" aria-current="page">Settings</li>
</ol>
</div>
</nav>

<section class="py-4 osahan-main-body shadow">
<div class="container">
<div class="row">
    <?php include 'include/sidebar.php';?>
<div class="col-lg-9 p-4 bg-white rounded shadow-sm">
<div class="osahan-promos">
<h4 class="mb-4 profile-title">Settings</h4>
<div class="pick_today shadow">
<?php
                    if (!empty($_SESSION['success']))
                    {
                        echo'
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>'.$_SESSION['success'].'</strong>
                        </div>';
                        unset($_SESSION['success']);
                    }

                    if (!empty($_SESSION['error']))
                    {
                        echo'
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>'.$_SESSION['error'].'</strong>
                        </div>';
                        unset($_SESSION['error']);
                    }

                    $q = @mysqli_query($dbc, "SELECT * FROM tbl_setup");
                    $row = mysqli_fetch_array($q);
                    //$clm_about_us = htmlspecialchars($row['clm_about_us'], ENT_QUOTES);
                ?>
                <div class="card">
                    <div class="card-body">
                        <!-- Nav tabs -->
                        <form action="" method="POST">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#about_us">About Us</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#contact_us">Contact Us</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#payment">Payment</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#followus">Follow Us</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#delivery_fee">Delivery Fee</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div id="about_us" class="container tab-pane active"><br>
                                <h3>About Us</h3>
                                <textarea required class="form-control" name="aboutus" rows="10"><?php echo $row['clm_about_us']; ?></textarea><br>
                                <button type="submit" name="update_aboutus" class="btn btn-dark btn-lg float-right">Update</button>
                            </div>
                            <div id="contact_us" class="container tab-pane"><br>
                                <h3>Contact Us</h3>
                                Hotline:
                                <input type="text" name="hotline" class="form-control" value="<?php echo $row['clm_hotline']; ?>"><br>
                                Email Address:
                                <input type="email" name="email" class="form-control" value="<?php echo $row['clm_email']; ?>">
                                <br>
                                <button type="submit" name="update_contactus" class="btn btn-dark btn-lg float-right">Update</button>
                                
                            </div>
                            <div id="payment" class="container tab-pane fade"><br>
                                <h3>Payment Method</h3>
                                <br>
                                <input required type="text" name="payment" class="form-control" value="<?php echo $row['clm_payment']; ?>"><br>                                                                
                                <br>
                                <button type="submit" name="update_payment" class="btn btn-dark btn-lg float-right">Update</button>
                                
                            </div>
                            <div id="followus" class="container tab-pane fade"><br>
                                <h3>Follow Us</h3>
                                Facebook link:
                                <input type="text" name="fb" class="form-control" value="<?php echo $row['clm_fb']; ?>"><br>
                                Twitter link:
                                <input type="text" name="twitter" class="form-control" value="<?php echo $row['clm_twitter']; ?>"><br>
                                Instagram link:
                                <input type="text" name="instagram" class="form-control" value="<?php echo $row['clm_instagram']; ?>"><br>                               
                                <br>
                                <button type="submit" name="update_followus" class="btn btn-dark btn-lg float-right">Update</button>
                                
                            </div>
                            <div id="delivery_fee" class="container tab-pane fade"><br>
                            <h3>Delivery Fee</h3>
                            <input required type="number" step="any" name="delivery_fee" class="form-control" value="<?php echo $row['clm_delivery_fee']; ?>"><br>
                            <button type="submit" name="update_delivery_fee" class="btn btn-dark btn-lg float-right">Update</button>                            
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                </div>
</div>
</div>
</div>
</section>

<div id="ajax-content"></div>

<?php
    include 'include/footer.php';
?>

<script>  
  $(document).ready(function(){ 

    $('.add_user').click(function(){  
      var add_user = 1;  
      $.ajax({  
        url:"modal/manage_users.php",  
        method:"post",  
        data:{add_user:add_user},  
        success:function(data){  
            $('#modal-content').html(data);  
            $('#dataModal').modal("show");  
        }  
      });  
    });

    $('.edit').click(function(){  
      var edit = $(this).attr("id");  
      $.ajax({  
        url:"modal/manage_users.php",  
        method:"post",  
        data:{edit:edit},  
        success:function(data){  
            $('#modal-content').html(data); 
            $('#dataModal').modal("show");  
        }  
      });  
    });

    $('.delete_user').click(function(){  
      var delete_user = $(this).attr("id");  
      $.ajax({  
        url:"modal/manage_users.php",  
        method:"post",  
        data:{delete_user:delete_user},  
        success:function(data){  
            $('#modal-content').html(data);  
            $('#dataModal').modal("show");  
        }  
      });  
    });

  });
</script>