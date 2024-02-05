
<?php
    $active = 'my_purchases'; $active_sub = 'cancelled';
    include 'include/header.php';
    unset($_SESSION['checkout']);
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
<li class="breadcrumb-item"aria-current="page">My Purchases</li>
<li class="breadcrumb-item active" aria-current="page">Cancelled</li>
</ol>
</div>
</nav>

<section class="py-4 osahan-main-body shadow">
    <div class="container">
        <div class="row">
                <?php include 'include/sidebar.php';?>
            <div class="col-lg-9 p-4 bg-white rounded shadow-sm">
                <div class="osahan-promos">
                 <h4 class="mb-4 profile-title">Cancelled</h4>
                    <div class="pick_today shadow">
                        
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
                    <?php
                    
                    $q = @mysqli_query($dbc, "SELECT *, DATE_FORMAT(clm_date, '%b %e, %Y %h:%i %p') as DateOrder FROM tbl_orders WHERE clm_customerid = '$CustomerID' AND clm_status = 5 ORDER BY clm_date DESC ");
                            if (mysqli_num_rows($q) != 0)
                            {
                                echo'
                                <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Order ID</th>
                                            <th>Items</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">';
                                        while ($row = mysqli_fetch_array($q))
                                        {
                                            $clm_delivery_fee = $row['clm_delivery_fee'];//
                                            $clm_orderid = $row['clm_orderid'];
                                            $subtotal = 0;
                                            $items = 0;
                                            $q1 = @mysqli_query($dbc, "SELECT * FROM tbl_orders_dts WHERE clm_orderid = '$clm_orderid' ");
                                            while ($row1 = mysqli_fetch_array($q1))
                                            {
                                                $subamount = $row1['clm_price'] * $row1['clm_quantity'];
                                                $subtotal = $subtotal + $subamount;
                                                $items = $items + $row1['clm_quantity'];
                                            }
                                            $amount = $clm_delivery_fee + $subtotal;
                                            if ($row['clm_status'] == 1){ $badge = 'bg-warning'; $statusName = 'Pending';}
                                            else if ($row['clm_status'] == 2){ $badge = 'bg-warning'; $statusName = 'Preparing Order';}
                                            else if ($row['clm_status'] == 3){ $badge = 'bg-info'; $statusName = 'Out for delivery';}
                                            else if ($row['clm_status'] == 4){ $badge = 'bg-success'; $statusName = 'Completed';}
                                            else if ($row['clm_status'] == 5){ $badge = 'bg-danger'; $statusName = 'Cancelled';}
                                            echo'
                                            <tr>
                                                <td>'.$row['DateOrder'].'</td>
                                                <td>'.$clm_orderid.'</td>
                                                <td>'.$items.'</td>
                                                <td class="text-dark"><b>'.number_format($amount, 2).'</b></td>
                                                <td><span class="badge '.$badge.' text-white">'.$statusName.'</span></td>
                                                <td><button id="'.$clm_orderid.'" class="btn btn-dark view_order">View</button></td>
                                            </tr>';
                                        }   
                                        echo'
                                    </tbody>
                                </table>
                            </div>';
                            }
                            else
                            {
                                echo'
                                <br><br>
                                <h4 style="color: gray">To ship orders will appear here.</h4><br><br><br><br>
                                '; 
                            }
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
      var pageName = 'cancelled';
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

