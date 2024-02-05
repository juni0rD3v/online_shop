
<?php
    $active = 'category';
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
<li class="breadcrumb-item"aria-current="page">Category</li>
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
                    if (!empty($_SESSION['error']))
                    {
                        echo'
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>'.$_SESSION['error'].'</strong>
                        </div>';
                        unset($_SESSION['error']);
                    }

                    if (!empty($_SESSION['success']))
                    {
                        echo'
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            '.$_SESSION['success'].'
                        </div>';
                        unset($_SESSION['success']);
                    }
                ?>        
                <div class="osahan-promos">
                 <h4 class="mb-4 profile-title">Category</h4>
                    <div class="pick_today shadow">
                    <div class="card">
                    <div class="card-body">
                                <?php
                                    $q = @mysqli_query($dbc, "SELECT * FROM tbl_category WHERE clm_status = 1 ORDER BY clm_name ASC");
                                ?>
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>CATEGORY</th>
                                        <th>ENCODED BY</th>
                                        <th>ACTION</th>
                                    </tr>
                                    </thead>
                                    <tbody id="myTable">
                                    <?php 
                                        while ($row = mysqli_fetch_array($q))
                                        {
                                            echo '
                                            <tr>
                                                <td>'.$row['clm_name'].'</td>
                                                <td>'.$row['clm_encoded_by'].' | '.$row['clm_date'].'</td>
                                                <td>
                                                    <button id="'.$row['clm_catid'].'" class="btn btn-dark edit"><i class="fa fa-edit"></i></button>                                                  
                                                </td>
                                            </tr>
                                            ';
                                        }
                                    ?>


                                </table>
                            </div>
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

    $('.add_new').click(function(){  
      var add_new = 1;  
      $.ajax({  
        url:"modal/category.php",  
        method:"post",  
        data:{add_new:add_new},  
        success:function(data){  
            $('#modal-content').html(data);  
            $('#dataModal').modal("show");  
        }  
      });  
    });

    $('.edit').click(function(){  
      var edit = $(this).attr("id");  
      $.ajax({  
        url:"modal/category.php",  
        method:"post",  
        data:{edit:edit},  
        success:function(data){  
            $('#modal-content').html(data);  
            $('#dataModal').modal("show");  
        }  
      });  
    });

  });
</script>