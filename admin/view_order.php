

<?php
    $active = 'view_order';
    include 'include/header.php';
    if (empty($_SESSION['view_order'])){echo '<script>location.replace("index");</script>';}
    else{
        $view_order = $_SESSION['view_order'];
        $pageName = $_SESSION['pageName'];
        $q = @mysqli_query($dbc, "SELECT *,DATE_FORMAT(clm_date, '%b %e, %Y %h:%i %p') as DateOrder FROM tbl_orders WHERE clm_orderid = '$view_order' ");
        $r = mysqli_fetch_array($q);
        $delivery_fee = $r['clm_delivery_fee'];
        $order_status = $r['clm_status'];
        $DateOrder = $r['clm_date'];
        $customerID = $r['clm_customerid'];
        $c = @mysqli_query($dbc, "SELECT * FROM tbl_customers WHERE clm_customerid = '$customerID' ");
        $r1 = mysqli_fetch_array($c);
        $customer_fullname = $r1['clm_fname'].' '.$r1['clm_lname'];
        $customer_contact = $r1['clm_contact'];
        $customer_address = $r1['clm_address'];

        if ($order_status == 1)
        {

            $status_name = 'Pending Order';
            $badge_bg = 'text-warning';
            $order_status_display = '
                <i class="icofont-check-circled text-danger"></i> Pending<br>
                <i class="icofont-close-circled text-warning"></i> Preparing Order<br>
                <i class="icofont-close-circled text-warning"></i> Out for delivery <br>
                <i class="icofont-close-circled text-warning"></i> Received<br>
            ';
        }
        else if ($order_status == 2)
        {
            $status_name = 'Preparing Order';   
            $badge_bg = 'text-warning';
            $order_status_display = '
                <i class="icofont-check-circled text-danger"></i> Pending<br>
                <i class="icofont-check-circled text-danger"></i> Preparing Order<br>
                <i class="icofont-close-circled text-warning"></i> Out for delivery <br>
                <i class="icofont-close-circled text-warning"></i> Received<br>
            ';
        }
        else if ($order_status == 3)
        {
            $status_name = 'Out for delivery';   
            $badge_bg = 'text-danger';
            $order_status_display = '
                <i class="icofont-check-circled text-danger"></i> Pending<br>
                <i class="icofont-check-circled text-danger"></i> Preparing Order<br>
                <i class="icofont-check-circled text-danger"></i> Out for delivery <br>
                <i class="icofont-close-circled text-warning"></i> Received<br>
            ';
        }
        else if ($order_status == 4)
        {
            $status_name = 'Completed';   
            $badge_bg = 'text-danger';
            $order_status_display = '
                <i class="icofont-check-circled text-danger"></i> Pending<br>
                <i class="icofont-check-circled text-danger"></i> Preparing Order<br>
                <i class="icofont-check-circled text-danger"></i> Out for delivery <br>
                <i class="icofont-check-circled text-danger"></i> Received<br>
            ';
        }
        else if ($order_status == 5)
        {
            $status_name = 'Canceled';   
            $badge_bg = 'text-danger';
            $order_status_display = '
                <i class="icofont-check-circled text-danger"></i> Ordered<br>
                <i class="icofont-close-circled text-danger"></i> Canceled ('.$r['clm_cancelled_remarks'].')
            ';
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
<ol class="d-flex  align-items-center mb-0 p-0">
<li class="breadcrumb-item"><a href="#" class="text-success">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">My order Status</li>
</ol>
</div>
</nav>
<section class="py-4 osahan-main-body">
<div class="container">
<div class="row">
    
<?php include 'include/sidebar.php';?>
<div class="col-md-9">

<section class="bg-white osahan-main-body rounded shadow-sm overflow-hidden">
<div class="container-0">
<div class="row">
<div class="col-lg-12">
<div class="osahan-status">
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
<div class="p-3 status-order shadow round border-bottom bg-white">
    <b><?php echo $status_name; ?> <br></b>
Name Of Reciever : <?php echo $customer_fullname; ?> <br>
<?php 
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_contact = $_POST['customer_contact']; // Phone number to send SMS
    // $message = $_POST['message']; // SMS message
  
  
        $ch = curl_init();
        $parameters = array(
            'apikey' => '8fb4048190209848376d07e02cfed34e', //Your API KEY
            'number' => $customer_contact,
            'message' => 'DEAR Maam/Sir ,
            Your order is on its way! Please have the exact amount of cash for our deliverer..
             Maraming Salamat..( KIMSON ONLINE GROCERY )',
            'sendername' => 'SEMAPHORE'
        );
        curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
        curl_setopt( $ch, CURLOPT_POST, 1 );
  
        //Send the parameters set above with the request
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );
  
        // Receive response from server
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $output = curl_exec( $ch );
        curl_close ($ch);
  
        //Show the server response
        // echo $output;
  }
?>
<form action="" method="post">
    <div class="row">
        <div class="col-6">
            <label for="">Contact</label>
            <input type="text" name="customer_contact" readonly class="form-control border-none" value="<?php echo  $customer_contact; ?>">
        </div>
        <div class="col-6">
        <?php 
            if($order_status == 2){
            echo'<button type="submit" class="float-right btn btn-outline-dark btn-sm" style="width: 200px; padding: 10px;"><b>SEND SMS CONFIRMATION</b></button>';
            }
        ?>
        </div>
    </div>
</form>
<!-- Contact Number : <b class="badge badge-info text-danger">
    <?php //echo  $customer_contact; ?></b>
        <?php 
            // if($order_status == 2){
            // echo'<button type="submit" class="float-right btn btn-outline-dark btn-sm" style="width: 200px; padding: 10px;"><b>SEND SMS CONFIRMATION</b></button>';
            // }
        ?><br> -->
ORDER ID: <?php echo $view_order;?>
<p class="small m-0"><i class="icofont-ui-calendar"></i> <?php echo $DateOrder;?></p>
</div>
<div class="p-3 border-bottom">
    
<h6 class="font-weight-bold">Order Status</h6>
<div class="tracking-wrap">
<?php echo $order_status_display; ?>

</div>
</div>

<div class="p-3 border-bottom bg-white ">
<div class="card shadow">
                    <div class="card-body">
                        <h6 class="card-title"></h6>       
                        <table class="table table-borderless">
                            <tr>
                                <th colspan="2" class="text-dark"><h5>Products Ordered</h5></th>
                                <th style="color: gray; text-align: right;"><b>Price</b></th>
                                <th style="color: gray; text-align: right;"><b>Quantity</b></th>
                                <th style="text-align: right; color: gray;"><b>Subtotal</b></th>
                            </tr>
                            <?php
                                $q1 = @mysqli_query($dbc, "SELECT * FROM tbl_orders_dts WHERE clm_orderid = '$view_order' ");
                                $total = 0;
                                $Quantity = 0;
                                while ($row1 = mysqli_fetch_array($q1))
                                {
                                    $clm_prodid = $row1['clm_prodid'];
                                    $q_prod = @mysqli_query($dbc, "SELECT * FROM tbl_products WHERE clm_prodid = '$clm_prodid' ");
                                    $row_prod = mysqli_fetch_array($q_prod);
                                    $clm_price = $row1['clm_price'];
                                    $clm_quantity = $row1['clm_quantity'];                                
                                    $subTotal = $clm_price * $clm_quantity;
                                    echo '
                                    <tr>                                        
                                        <td width="50px"><img id="product_img" src="../img/listing/'.$row_prod['clm_image'].'"></td>
                                        <td><b>'.$row_prod['clm_desc'].'</b></td>
                                        <td style="text-align: right;">'.$pesos.' '.number_format($clm_price,2).'</td>
                                        <td style="text-align: right;">'.$row1['clm_quantity'].'</td>
                                        <td style="text-align: right;">'.$pesos.' '.number_format($subTotal, 2).'</td>
                                    </tr>
                                    ';
                                    $total = $total + $subTotal;
                                    $Quantity = $Quantity + $clm_quantity;
                                }
                                echo'
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: right;">Order Total ('.$Quantity.' Item'; if ($Quantity >> 1){echo 's';}echo'):</td>
                                    <td style="text-align: right;"><h6 class="text-danger">'.$pesos.' '.number_format($total,2).'</h6></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: right;">Delivery Fee:</td>
                                    <td style="text-align: right;"><h6 class="text-danger">'.$pesos.' '.number_format($delivery_fee,2).'</h6></td>
                                </tr>';
                                $total_payment = $total + $delivery_fee;
                                echo'<tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: right;">Total Payment:</td>
                                    <td style="text-align: right;"><h5 class="text-danger">'.$pesos.' '.number_format($total_payment,2).'</h5></td>
                                </tr>';
                            ?>
                        </table>  
                        <hr><br>
                        <a href="<?php echo $pageName; ?>"><button class="float-left btn btn-outline-dark btn-sm" style="width: 200px; padding: 10px;"><i class="fa fa-angle-left"></i> BACK</button></a>
                                <?php
                                    if ($order_status == 1)
                                    {
                                        echo'<button id="'.$view_order.'" class="float-right btn btn-dark text-white btn-sm prepareOrder" style="width: 200px; padding: 10px;"><b>PREPARE ORDER</b></button>';
                                        echo'<button id="'.$view_order.'" class="float-right btn btn-danger text-white btn-sm cancelOrder" style="width: 200px; padding: 10px; margin-right: 20px;"><b>CANCEL ORDER</b></button>';
                                    }
                                    else if ($order_status == 2)
                                    {
                                        echo'<button id="'.$view_order.'" class="float-right btn btn-dark text-white btn-sm outOrder" style="width: 200px; padding: 10px;"><b>OUT FOR DELIVERY</b></button>';
                                        echo'<button id="'.$view_order.'" class="float-right btn btn-danger text-white btn-sm cancelOrder" style="width: 200px; padding: 10px; margin-right: 20px;"><b>CANCEL ORDER</b></button>';
                                    }
                                    else if ($order_status == 3)
                                    {
                                        echo'<button id="'.$view_order.'" class="float-right btn btn-dark text-white btn-sm ReceivedOrder" style="width: 200px; padding: 10px;"><b>ORDER RECIEVE</b></button>';
                                        echo'<button id="'.$view_order.'" class="float-right btn btn-danger text-white btn-sm cancelOrder" style="width: 200px; padding: 10px; margin-right: 20px;"><b>CANCEL ORDER</b></button>';                                        
                                    }
                                ?>
                        
                    </div>
                </div>
</div>
<div class="p-3 border-bottom">
 <p class="font-weight-bold small mb-1">Courier</p>
  <span class="small text-success font-weight-bold">KImson Courier
</span>
</div>

</div>
</div>
</section>
</div>
</div>
</div>
</section>

<?php
    include 'include/footer.php';
?>

<script>  
  $(document).ready(function(){ 

    $('.prepareOrder').click(function(){  
      var prepareOrder = $(this).attr("id");  
      $.ajax({  
        url:"modal/orders.php",  
        method:"post",  
        data:{prepareOrder:prepareOrder},  
        success:function(data){  
            $('#modal-content').html(data);  
            $('#dataModal').modal("show");  
        }  
      });  
    });

    $('.cancelOrder').click(function(){  
      var cancelOrder = $(this).attr("id");  
      $.ajax({  
        url:"modal/orders.php",  
        method:"post",  
        data:{cancelOrder:cancelOrder},  
        success:function(data){  
            $('#modal-content').html(data);  
            $('#dataModal').modal("show");  
        }  
      });  
    });

    $('.ReceivedOrder').click(function(){  
      var ReceivedOrder = $(this).attr("id");  
      $.ajax({  
        url:"modal/orders.php",  
        method:"post",  
        data:{ReceivedOrder:ReceivedOrder},  
        success:function(data){  
            $('#modal-content').html(data);  
            $('#dataModal').modal("show");  
        }  
      });  
    });

    $('.outOrder').click(function(){  
      var outOrder = $(this).attr("id");  
      $.ajax({  
        url:"modal/outOrder.php",  
        method:"post",  
        data:{outOrder:outOrder},  
        success:function(data){  
            $('#modal-content').html(data);  
            $('#dataModal').modal("show");  
        }  
      });  
    });

  });
</script>