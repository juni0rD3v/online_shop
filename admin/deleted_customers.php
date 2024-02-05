

<?php
    $active = 'customers';
    include 'include/header.php';
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
<li class="breadcrumb-item"aria-current="page">Customer</li>
<!-- <li class="breadcrumb-item active" aria-current="page">Cancelled</li> -->
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
                 <h4 class="mb-4 profile-title">Deleted Customers
                                       <a class="ml-auto float-right btn btn-outline-dark btn-sm" href="customers"><i class="fa fa-check-circle"></i> View Active Customers</a>
                 </h4>
                  
                    <div class="pick_today shadow">
                    <div class="card">
                    <div class="card-body">
                        <?php                          
                            $q = @mysqli_query($dbc, "SELECT * FROM tbl_customers WHERE clm_status = 0 ORDER BY clm_date DESC");
                        ?>
                        <table class="table table-responsive table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <!-- <th>Email</th> -->
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Username</th>
                                <th>Date Registered</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="myTable">
                            <?php                                 
                                while ($row = mysqli_fetch_array($q))
                                {
                                    echo '
                                    <tr>
                                        <td>'.$row['clm_fname'].' '.$row['clm_lname'].'</td>
                                        <td>'.$row['clm_address'].'</td>
                                        <td>'.$row['clm_contact'].'</td>
                                        <td>'.$row['clm_username'].'</td>
                                        <td>'.$row['clm_date'].'</td>
                                        <td>'.$row['clm_remarks'].'</td>
                                        <td>
                                            <button id="'.$row['clm_customerid'].'" class="btn btn-warning reactivate"><i class="fa fa-redo-alt"></i> </button>
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
        url:"modal/customers.php",  
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
