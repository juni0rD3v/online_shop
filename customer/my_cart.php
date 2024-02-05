<?php
    $active = 'my_cart';
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
<!-- <li class="breadcrumb-item"aria-current="page">My Purchases</li> -->
<li class="breadcrumb-item active" aria-current="page">My Cart</li>
</ol>
</div>
</nav>

<section class="py-4 osahan-main-body shadow">
    <div class="container">
        <div class="row">
                <?php include 'include/sidebar.php';?>
            <div class="col-lg-9 p-4 bg-white rounded shadow-sm">
                <div class="osahan-promos">
                 <h4 class="mb-4 profile-title">My Cart</h4>
                    <div class="pick_today shadow">
                    <div class="col-lg-12">
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
                <div class="title d-flex align-items-center py-3">
                </div>
                <?php
                    $q = @mysqli_query($dbc, "SELECT * FROM tbl_cart WHERE clm_customerid = '$CustomerID' ");
                    if (mysqli_num_rows($q) == 0)
                    {
                        echo'
                        <br><br>
                        <h4 style="color: black">No product(s) on your cart.</h4>
                        ';
                    }
                    else
                    {
                        echo'
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr class="shadow">
                                    <th colspan="2">Product</th>
                                    <th>Quantity</th>
                                    <th style="text-align: right;">Total Price</th>
                                    <th>Action</th>
                                </tr>';

                            $total = 0;
                            $Quantity = 0;
                            while ($row = mysqli_fetch_array($q))
                            {
                                $clm_prodid = $row['clm_prodid'];
                                $q_prod = @mysqli_query($dbc, "SELECT * FROM tbl_products WHERE clm_prodid = '$clm_prodid' ");
                                $row_prod = mysqli_fetch_array($q_prod);
                                $clm_price = $row_prod['clm_price'];
                                $clm_stock = $row_prod['clm_quantity'];
                                $clm_quantity = $row['clm_quantity'];                                
                                $subTotal = $clm_price * $clm_quantity;
                                echo '
                                <tr>
                                    <td width="50px"><img id="product_img" src="../img/listing/'.$row_prod['clm_image'].'"></td>
                                    <td class="text-dark"><b>'.$row_prod['clm_desc'].'</b><br>Available Stock: '.$row_prod['clm_quantity'].'<br>'.$pesos.' '.number_format($clm_price,2).'</td>
                                    <td>
                                        <div class="btn-group cart-items-number">
                                            <button id="'.$row['clm_cartid'].'" type="button" class="btn btn-danger btn-sm minus"><b>-</b></button>
                                            <button id="'.$row['clm_cartid'].'" type="button" class="form-control  btn-sm manual">'.$row['clm_quantity'].'</button>
                                            <button id="'.$row['clm_cartid'].'" type="button" class="qtyplus btn btn-success btn-sm plus "><b>+</b></button>
                                            
                                        </div>
                                    </td>
                                    <td style="text-align: right;"><h6 class="">'.number_format($subTotal, 2).'</h6></td>
                                    <td class="text-danger"><button id="'.$row['clm_cartid'].'" class="btn deleteBtn"><i class="icofont-trash"></i></button></td>
                                </tr>
                                ';
                                $total = $total + $subTotal;
                                $Quantity = $Quantity + $clm_quantity;
                            }
                            echo'         
                            </table>
                            <br>
                            <table style="float: right;">
                                <tr>
                                    <td>
                                    <p class="mb-1">Item Total <span class="small text-muted">('.number_format($Quantity).' item)</span> <span class="float-right text-dark"></span></p></td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;" class=""><h5 class="mb-0">TO PAY : <span class="float-right text-danger"> '.$pesos.' '.number_format($total,2).'</span></h5></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>                               
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><button class="btn btn-dark checkoutBtn" style="width: 150px; padding: 10px; color: dark; float: right;">Proceed to checkout</button></td>
                                </tr>
                            </table>
                        </div>';                        
                    }
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

    $('.deleteBtn').click(function(){  
      var deleteBtn = $(this).attr("id");  
      $.ajax({  
        url:"function.php",  
        method:"post",  
        data:{deleteBtn:deleteBtn},  
        success:function(data){  
            $('#data-content').html(data);  
            //$('#dataModal').modal("show");  
        }  
      });  
    });

    $('.minus').click(function(){  
      var minus = $(this).attr("id");  
      $.ajax({  
        url:"function.php",  
        method:"post",  
        data:{minus:minus},  
        success:function(data){  
            $('#data-content').html(data);  
            //$('#dataModal').modal("show");  
        }  
      });  
    });

    $('.plus').click(function(){  
      var plus = $(this).attr("id");  
      $.ajax({  
        url:"function.php",  
        method:"post",  
        data:{plus:plus},  
        success:function(data){  
            $('#data-content').html(data);  
            //$('#dataModal').modal("show");  
        }  
      });  
    });

    $('.checkoutBtn').click(function(){  
      var checkoutBtn = 1;  
      $.ajax({  
        url:"function.php",  
        method:"post",  
        data:{checkoutBtn:checkoutBtn},  
        success:function(data){  
            $('#data-content').html(data);  
            //$('#dataModal').modal("show");  
        }  
      });  
    });

    $('.manual').click(function(){  
      var manual = $(this).attr("id");  
      $.ajax({  
        url:"modal/modal.php",  
        method:"post",  
        data:{manual:manual},  
        success:function(data){  
            $('#modal-content').html(data);  
            // $('#dataModal').modal("show");  
        }  
      });  
    });

  });//
</script>