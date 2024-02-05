

<?php
    $active = '';
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
<li class="breadcrumb-item active"aria-current="page">Home</li>
<li class="breadcrumb-item"aria-current="page">About Us</li>
<!-- <li class="breadcrumb-item active" aria-current="page">All Orders</li> -->
</ol>
</div>
</nav>

<section class="py-4 osahan-main-body shadow">
    <div class="container">
        <div class="row">
                <?php include 'include/sidebar.php';?>
               
            <div class="col-lg-9 p-4 bg-white rounded shadow-sm">
                <div class="osahan-promos">
                 <h4 class="mb-4 profile-title">All Orders</h4>
                 <div class="card shadow">
                    <div class="card-body" style="min-height: 300px;">
                    <?php 
                        $q = @mysqli_query($dbc, "SELECT * FROM tbl_setup");
                        $row = mysqli_fetch_array($q);
                        $clm_about_us = htmlspecialchars($row['clm_about_us'], ENT_QUOTES);

                        echo str_replace(array("\r\n", "\n"), array("<br />", "<br />"), $clm_about_us);

                    ?>
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

    $('.view_order').click(function(){  
      var view_order = $(this).attr("id");  
      var pageName = 'all';
      $.ajax({  
        url:"function.php",  
        method:"post",  
        data:{view_order:view_order, pageName:pageName},  
        success:function(data){  
            $('#data-content').html(data);  
            //$('#dataModal').modal("show");  
        }  
      });  
    });

  });
</script>
