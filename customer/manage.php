<?php
    $active = 'manage';
    include 'include/header.php';
    if (isset($_POST['updateBtn']))
    {
        $fname = mysqli_real_escape_string($dbc, $_POST['fname']);
        $lname = mysqli_real_escape_string($dbc, $_POST['lname']);
        $email = mysqli_real_escape_string($dbc, $_POST['email']);
        $address = mysqli_real_escape_string($dbc, $_POST['address']);
        $contact = mysqli_real_escape_string($dbc, $_POST['contact']);        
        // check email or username if already exist
        $q = @mysqli_query($dbc, "SELECT * FROM tbl_customers WHERE clm_email = '$email' AND clm_customerid != '$CustomerID' ");
        if (mysqli_num_rows($q) == 0)
        {            
            $q = @mysqli_query($dbc, "UPDATE tbl_customers SET 
            clm_fname = '$fname',clm_lname = '$lname',clm_email = '$email',clm_address = '$address',clm_contact = '$contact' WHERE clm_customerid = '$CustomerID' ");
            if ($q)
            {
                $_SESSION['success'] = 'Your account has been successfully updated.';
            }
            else
            {
                $_SESSION['error'] = mysqli_error($dbc);
            }				
           
        }
        else
        {
            $_SESSION['error'] = 'Email address is already in use.';
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
<li class="breadcrumb-item active" aria-current="page">Manage Profile</li>
</ol>
</div>
</nav>

<section class="py-4 osahan-main-body shadow">
<div class="container">
<div class="row">
    <?php include 'include/sidebar.php';?>
<div class="col-lg-9 p-4 bg-white rounded shadow-sm">
<div class="osahan-promos">
<h4 class="mb-4 profile-title">Manage Profile</h4>
<?php
                    if (!empty($_SESSION['error']))
                    {
                        echo'
                        <div class="alert alert-danger alert-dismissible">
                            <strong>'.$_SESSION['error'].'</strong>
                        </div>';
                        unset($_SESSION['error']);
                    }                    
                    if (!empty($_SESSION['success']))
                    {
                        echo'
                        <div class="alert alert-success alert-dismissible">
                            <strong>'.$_SESSION['success'].'</strong>
                        </div>';
                        unset($_SESSION['success']);
                    }
                ?>
                <div class="card shadow">
                    <div class="card-body">
                        <?php 
                            $q = @mysqli_query($dbc, "SELECT * FROM tbl_customers WHERE clm_customerid = '$CustomerID' ");
                            $row = mysqli_fetch_array($q);
                        ?>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label>First Name</label>
                            <input required name="fname" placeholder="Enter First Name" type="text" class="form-control" value="<?php echo $row['clm_fname'];?>">
                        </div>                       
                        <div class="form-group">
                            <label>Last Name</label>
                            <input required name="lname" placeholder="Enter Last Name" type="text" class="form-control" value="<?php echo $row['clm_lname'];?>">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" placeholder="Enter Email" type="email" class="form-control" value="<?php echo $row['clm_email'];?>">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input required name="address" placeholder="Enter Address" type="text" class="form-control" value="<?php echo $row['clm_address'];?>">
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input required name="contact" placeholder="Enter Phone Number" type="number" class="form-control" value="<?php echo $row['clm_contact'];?>">
                        </div>
                                          
                        <button type="submit" name="updateBtn" class="btn btn-dark btn-lg rounded btn-block">UPDATE</button>
                    </form>
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

<!-- <script>  
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
</script> -->