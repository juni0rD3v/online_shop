

<?php
    $active = 'checkout';
    include 'include/header.php';
    if (empty($_SESSION['checkout'])){echo '<script>location.replace("index");</script>';}
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
<li class="breadcrumb-item"aria-current="page">My Cart</li>
<li class="breadcrumb-item active" aria-current="page">Checkout</li>
</ol>
</div>
</nav>

<section class="py-4 osahan-main-body shadow">
    <div class="container">
        <div class="row">
                <?php include 'include/sidebar.php';?>
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
            <div class="col-lg-9 p-4 bg-white rounded shadow-sm">
                <div class="osahan-promos">
                 <h4 class="mb-4 profile-title">Checkout</h4>
                    <div class="pick_today shadow">
                    <table class="table table-borderless">
                            <tr>
                                <th colspan="2">Products Ordered</th>
                                <th style="color: gray; text-align: right;"><b>Price</b></th>
                                <th style="color: gray; text-align: right;"><b>Quantity</b></th>
                                <th style="text-align: right; color: gray;"><b>Subtotal</b></th>
                            </tr>
                            <?php
                                $q = @mysqli_query($dbc, "SELECT * FROM tbl_cart WHERE clm_customerid = '$CustomerID' ");
                                $total = 0;
                                $Quantity = 0;
                                while ($row = mysqli_fetch_array($q))
                                {
                                    $clm_prodid = $row['clm_prodid'];
                                    $q_prod = @mysqli_query($dbc, "SELECT * FROM tbl_products WHERE clm_prodid = '$clm_prodid' ");
                                    $row_prod = mysqli_fetch_array($q_prod);
                                    $clm_price = $row_prod['clm_price'];
                                    $clm_quantity = $row['clm_quantity'];                                
                                    $subTotal = $clm_price * $clm_quantity;
                                    echo '
                                    <tr>                                        
                                        <td width="50px"><img id="product_img" src="../img/listing/'.$row_prod['clm_image'].'"></td>
                                        <td><b>'.$row_prod['clm_desc'].'</b></td>
                                        <td style="text-align: right;">'.$pesos.' '.number_format($clm_price,2).'</td>
                                        <td style="text-align: right;">'.$row['clm_quantity'].'</td>
                                        <td style="text-align: right;">'.$pesos.' '.number_format($subTotal, 2).'</td>
                                    </tr>
                                    ';
                                    $total = $total + $subTotal;
                                    $Quantity = $Quantity + $clm_quantity;
                                }
                                $sf = @mysqli_query($dbc, "SELECT clm_delivery_fee FROM tbl_setup ");
                                $row_sf = mysqli_fetch_array($sf);
                                echo'
                                <tr class="border-top">
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: right;" collspan="2">Total Item <span class="small text-muted">('.$Quantity.' Item'; if ($Quantity >> 1){echo 's';}echo')</span></td>
                                    <td></td>
                                    <td style="text-align: right;"><h6 class="text-danger">'.$pesos.' '.number_format($total,2).'</h6></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: right;">Delivery Fee:</td>
                                    <td></td>
                                    <td style="text-align: right;"><h6 class="text-danger">'.$pesos.' '.number_format($row_sf['clm_delivery_fee'],2).'</h6></td>
                                </tr>';
                                $total_payment = $total + $row_sf['clm_delivery_fee'];
                                echo'<tr>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: right;">Total Payment:</td>
                                    <td></td>
                                    <td style="text-align: right;"><h5 class="text-danger">'.$pesos.' '.number_format($total_payment,2).'</h5></td>
                                </tr>
                                
                                ';
                            ?>
                        </table>  
                        <br>
                                <a href="my_cart"><button class="float-left btn btn-danger btn-sm" style="width: 100px; padding: 10px;">Cancel</button></a>
                                <button class="float-right btn btn-dark btn-lg placeorderBtn" style="width: 100px; padding: 10px;">Place Order</button>
                        
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

    $('.placeorderBtn').click(function(){  
      var placeorderBtn = 1;  
      $.ajax({  
        url:"modal/modal.php",  
        method:"post",  
        data:{placeorderBtn:placeorderBtn},  
        success:function(data){  
            $('#modal-content').html(data);  
            $('#dataModal').modal("show");  
        }  
      });  
    });

  });
</script>
