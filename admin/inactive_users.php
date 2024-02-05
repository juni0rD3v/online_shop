
<?php
    $active = 'manage_users';
    include 'include/header.php';
    if ($type != 1){echo '<script>location.replace("../login");</script>';}
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
<li class="breadcrumb-item"aria-current="page">Home</li>
<li class="breadcrumb-item"aria-current="page">Manage Users</li>
<li class="breadcrumb-item active" aria-current="page">Inactive Users</li>
</ol>
</div>
</nav>

<section class="py-4 osahan-main-body shadow">
    <div class="container">
        <div class="row">
                <?php include 'include/sidebar.php';?>
            <div class="col-lg-9 p-4 bg-white rounded shadow-sm">
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
                ?>
                <div class="osahan-promos">
                 <h4 class="mb-4 profile-title d-flex align-items-center py-3">Inactive Users
                    <a class="ml-auto btn btn-outline-dark btn-sm" href="manage_users"><i class="fa fa-check-circle"></i> View Active Users</a>
                 </h4>
                  
                    <div class="pick_today shadow">
                    <div class="card">
                        <div class="card-body">
                            <?php                          
                                $q = @mysqli_query($dbc, "SELECT * FROM tbl_admin WHERE clm_status = 0 AND clm_type = 0 ORDER BY clm_username ASC");
                            ?>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Date Registered</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="myTable">
                                <?php                                 
                                    while ($row = mysqli_fetch_array($q))
                                    {
                                        echo '
                                        <tr>
                                            <td>'.$row['clm_username'].'</td>
                                            <td>'.$row['clm_date'].'</td>
                                            <td>
                                                <button id="'.$row['clm_adminid'].'" class="btn btn-warning reactivate"><i class="fa fa-redo-alt"></i></button>
                                            </td>
                                        </tr>
                                        ';
                                    }                            
                                ?>
                                </tbody>
                            </table>
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

    $('.reactivate').click(function(){  
      var reactivate = $(this).attr("id");  
      $.ajax({  
        url:"modal/manage_users.php",  
        method:"post",  
        data:{reactivate:reactivate},  
        success:function(data){  
            $('#modal-content').html(data);  
            $('#dataModal').modal("show");  
        }  
      });  
    });

  });
</script>
