<?php
    $active = 'index';
    include 'include/header.php';

    if (isset($_POST['goBtn']))
    {
        if ($_POST['category'] != '0')
        {
            $catid = $_POST['category'];
            $q_cat1 = @mysqli_query($dbc, "SELECT * FROM tbl_category WHERE clm_catid = '$catid' ");
            $row_cat1 = mysqli_fetch_array($q_cat1);
            $cat_name = $row_cat1['clm_name']; 
            $q = @mysqli_query($dbc, "SELECT * FROM tbl_products WHERE clm_catid = '$catid' ORDER BY clm_desc ASC");
            $title = $cat_name;
        }
        else
        {
            echo '<script>location.replace("");</script>';
        }
    }
    else
    {
        if (isset($_POST['searchtxt']))
        {
            $searchtxt = mysqli_real_escape_string($dbc, $_POST['searchtxt']);
            $q = @mysqli_query($dbc, "SELECT * FROM tbl_products WHERE clm_desc LIKE '%$searchtxt%' AND clm_quantity >= 1 ORDER BY clm_desc ASC");
        }
        else
        {
            $q = @mysqli_query($dbc, "SELECT * FROM tbl_products WHERE clm_quantity >= 1 ORDER BY clm_desc ASC LIMIT 20");
        }
        $title = 'All Products';
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
<!-- <li class="breadcrumb-item active" aria-current="page">Promos</li> -->
</ol>
</div>
</nav>

<section class="py-4 osahan-main-body shadow">
<div class="container">
<div class="row">
    <?php include 'include/sidebar.php';?>
<div class="col-lg-9 p-4 bg-white rounded shadow-sm">
<div class="osahan-promos">
<h4 class="mb-4 profile-title">Avaiable Products</h4>
<div class="pick_today shadow">
                    <div class="row list_products">
                        <?php                            
                            if (mysqli_num_rows($q) == 0)
                            {
                                echo '<h6 style="margin-top: 100px;color:black">No products found!</h6>';
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
                                        <img src="../img/listing/<?php echo $row['clm_image'];?>" class="img-fluid item-img w-50 mb-3">
                            </div>
                                        <h6><?php echo $row['clm_desc'];?></h6>
                                        Available Stock:  <b><?php echo $row['clm_quantity'];?> </b>
                                        <div class="d-flex align-items-center">
                                        
                                        <h6 class="price m-0 text-dark"><b><?php echo $pesos.' '.number_format($row['clm_price'], 2);?></b></h6>
                                        <a href="#" id="<?php echo $row['clm_prodid']; ?>" class="btn btn-dark text-dark btn-sm ml-auto add_to_cart"><i class="fa fa-cart-plus" ></i></a>       
                                        </div>                     
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            }// end while
                            }// end else
                        ?>

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