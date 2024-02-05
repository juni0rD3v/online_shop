
<?php
    $active = 'change_pass';
    include 'include/header.php';
    if (isset($_POST['saveBtn']))
    {
        $oldpass = mysqli_real_escape_string($dbc, $_POST['oldpass']);
        $username = mysqli_real_escape_string($dbc, $_POST['username']);
        $newpass = mysqli_real_escape_string($dbc, $_POST['newpass']);
        $conpass = mysqli_real_escape_string($dbc, $_POST['conpass']);

        $q = @mysqli_query($dbc, "SELECT * FROM tbl_customers WHERE clm_username = '$username' AND clm_customerid != '$CustomerID' ");
        if (mysqli_num_rows($q) == 0)
        {
            if ($pass != md5($oldpass))
            {
                $_SESSION['error'] = 'Invalid old password';
            }
            else
            {
                if ($newpass != $conpass)
                {
                    $_SESSION['error'] = 'Passwords not match';
                }
                else
                {
                    $q = @mysqli_query($dbc, "UPDATE tbl_customers SET clm_username = '$username', clm_password = md5('$newpass') WHERE clm_customerid = '$CustomerID' ");
                    if ($q)
                    {
                        $_SESSION['success'] = 'Your password has been change successfully. Please login your new credential';
                        echo '<script>location.replace("../login");</script>';                    
                    }
                    else
                    {
                        $_SESSION['error'] = mysqli_error($dbc);
                    }
                }
                
            }
        }
        else
        {
            $_SESSION['error'] = 'Username is already in use';
        }
        
    }
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
<li class="breadcrumb-item active" aria-current="page">Change Password</li>
</ol>
</div>
</nav>

<section class="py-4 osahan-main-body shadow">
<div class="container">
<div class="row">
    <?php include 'include/sidebar.php';?>
<div class="col-lg-9 p-4 bg-white rounded shadow-sm">
<div class="osahan-promos">
<h4 class="mb-4 profile-title">Change Password</h4>

<?php                                        
                    if (!empty($_SESSION['error']))
                    {
                        echo'
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>'.$_SESSION['error'].'</strong>
                        </div>';
                        unset($_SESSION['error']);
                    }
                ?> 
                <div class="card shadow">
                    <div class="card-body">
                        <?php 
                            $q = @mysqli_query($dbc, "SELECT * FROM tbl_customers WHERE clm_customerid = '$CustomerID' ");
                            $row = mysqli_fetch_array($q);
                        ?>
                    <form action="" method="POST">
                        <input required type="text" name="username" class="form-control" value="<?php echo $row['clm_username']; ?>"><br>
                        <input required type="password" name="oldpass" class="form-control" placeholder="Old Password"><br>
                        <input required type="password" name="newpass" class="form-control" placeholder="New Password"><br>
                        <input required type="password" name="conpass" class="form-control" placeholder="Confirm Password"><br>
                        <button type="submit" name="saveBtn" class="btn btn-dark" style="width: 100%;"><b>SAVE</b></button>
                    </form>
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

    $('.add_to_cart').click(function(){  
      var add_to_cart = $(this).attr("id");  
      $.ajax({  
        url:"modal/modal.php",  
        method:"post",  
        data:{add_to_cart:add_to_cart},  
        success:function(data){  
            $('#ajax-content').html(data);
        }  
      });  
    });

  });
</script>