<?php
    $active = 'reports';
    include 'include/header.php';
    if ($type != 1){echo '<script>location.replace("../login");</script>';}
    if (empty($_SESSION['report_type'])){$_SESSION['report_type'] = 'daily';}
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
<div class="container" id="print">
<ol class="d-flex align-items-center mb-0 p-0">
<li class="breadcrumb-item"aria-current="page">Home</li>
<li class="breadcrumb-item"aria-current="page">Reports</li>
<li class="breadcrumb-item active" aria-current="page">Daily Report</li>
</ol>
</div>
</nav>

<section class="py-4 osahan-main-body shadow">
    <div class="container">
        <div class="row">
                <?php //include 'include/sidebar.php';?>
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
                 <h4 class="mb-4 profile-title">Daily Reports</h4>
                  
                    <div class="pick_today shadow">
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

                    if (!empty($_SESSION['error']))
                    {
                        echo'
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>'.$_SESSION['error'].'</strong>
                        </div>';
                        unset($_SESSION['error']);
                    }

                    $q = @mysqli_query($dbc, "SELECT * FROM tbl_setup");
                    $row = mysqli_fetch_array($q);
                    //$clm_about_us = htmlspecialchars($row['clm_about_us'], ENT_QUOTES);
                ?>
                <div class="card">
                    <div class="card-body">
                        <!-- Nav tabs -->
                        <!-- <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                            <a class="nav-link report_daily <?php if ($_SESSION['report_type'] == 'daily'){echo ' active';}?>" data-toggle="tab" href="#daily">Daily</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link report_monthly <?php if ($_SESSION['report_type'] == 'monthly'){echo ' active';}?>" data-toggle="tab" href="#monthly">Monthly</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link report_summary <?php if ($_SESSION['report_type'] == 'summary'){echo ' active';}?>" data-toggle="tab" href="#summary">Summary of transactions</a>
                            </li>                          
                        </ul> -->
                        <style>
                            
@media print{
#print {
display:none;
}
}


                        </style>
                        <script>
function printPage() {
    window.print();
}
</script>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div id="daily" style="min-height: 400px;" class="container tab-pane <?php if ($_SESSION['report_type'] == 'daily'){echo ' active';}?>"><br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5>Please select date range</h5>
                                    </div>
                                    <div class="col-md-8 col-8">
                                        <form action="" method="POST">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">From:</span>
                                            </div>
                                            <input type="date" class="form-control" required name="daily_date_from" style="height: 40px;" value="<?php if (isset($_POST['daily_date_from'])){echo $_POST['daily_date_from'];}?>">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">To:</span>
                                            </div>
                                            <input type="date" class="form-control" required name="daily_date_to" style="height: 40px;" value="<?php if (isset($_POST['daily_date_to'])){echo $_POST['daily_date_to'];}?>">
                                            <div class="input-group-append">
                                                <button class="btn btn-dark" id="print" type="submit" name="generate_daily">Generate</button>
                                            </div>
                                        </div>
                                        </form>                                        
                                    </div>
                                    <div class="col-md-6 col-10">
                                    <?php
                                        if (isset($_POST['generate_daily']))
                                        {
                                            $daily_date_from = $_POST['daily_date_from'];
                                            $daily_date_to = $_POST['daily_date_to'];

                                            echo '
                                            <br>
                                            <h5>DAILY LIQUIDATION REPORT</h5>
                                            Date: <b>'.date_format(date_create($_POST['daily_date_from']), 'M d, Y').' - '.date_format(date_create($_POST['daily_date_to']), 'M d, Y').'</b>
                                            <br><br>
                                            KIMSON ONLINE GROCERY STORE <br>
                                            BULAN SORSOGON<br>
                                            bulankimsonenterprises@gmail.com<br>
                                            09478532014
                                            <br><br>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th class="text-center" colspan="2">DAILY COMPUTATION REPORT</th>
                                                </tr>
                                                <tr>
                                                    <th>DATE</th>
                                                    <th class="text-right">AMOUNT</th>
                                                </tr>';
                                                $total = 0;
                                                $q = @mysqli_query($dbc, "SELECT *, DATE_FORMAT(clm_date, '%b %d, %Y') as dateOrder FROM tbl_orders WHERE clm_date BETWEEN '$daily_date_from 00:00:00' AND '$daily_date_to 23:00:00' AND clm_status = 4 ");
                                                if (!$q){echo mysqli_error($dbc);}
                                                while ($row = mysqli_fetch_array($q))
                                                {
                                                    $total_per_date = 0;                                                    
                                                    $clm_date = $row['clm_date'];
                                                    $q1 = @mysqli_query($dbc, "SELECT * FROM tbl_orders WHERE clm_date = '$clm_date' AND clm_status = 4 ");
                                                    while ($row1 = mysqli_fetch_array($q1))
                                                    {
                                                        $clm_delivery_fee = $row1['clm_delivery_fee'];
                                                        $clm_orderid = $row1['clm_orderid'];
                                                        $q2 = @mysqli_query($dbc, "SELECT * FROM tbl_orders_dts WHERE clm_orderid = '$clm_orderid' ");
                                                        $amount = 0;
                                                        while ($row2 = mysqli_fetch_array($q2))
                                                        {
                                                            $sub_amount = $row2['clm_price'] * $row2['clm_quantity'];
                                                            $amount = $amount + $sub_amount;
                                                        }
                                                        $total_per_date = $amount + $clm_delivery_fee;
                                                    }                                                    
                                                    echo'
                                                    <tr>
                                                        <td>'.$row['dateOrder'].'</td>
                                                        <td class="text-right">'.number_format($total_per_date,2).'</td>
                                                    </tr>';
                                                    $total = $total + $total_per_date;
                                                    
                                                }echo'
                                                <tr>
                                                    <td colspan="2"><b><span class="text-left">Overall Total:</span></b> <h5 class="float-right text-success">'.number_format($total,2).'</h5></td>
                                                </tr>
                                            </table>
                                            
                                            
                                            
                                            ';

                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" id="print" onclick="printPage()">Print</button>
                            <!-- <div id="monthly" style="min-height: 400px;" class="container tab-pane <?php if ($_SESSION['report_type'] == 'monthly'){echo ' active';}?>"><br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5>Please select month</h5>
                                    </div>
                                    <div class="col-md-8">
                                        <form action="" method="POST">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Month:</span>
                                            </div>
                                            <input type="month" class="form-control" name="month" style="height: 40px;" required value="<?php if (isset($_POST['month'])){echo $_POST['month'];}?>">                                            
                                            <div class="input-group-append">
                                                <button class="btn btn-dark" type="submit" name="generate_monthly">Generate</button>
                                            </div>
                                        </div>
                                        </form>                                        
                                    </div>
                                    <div class="col-md-6">
                                    <?php
                                        if (isset($_POST['generate_monthly']))
                                        {
                                            $month_date_from = date_format(date_create($_POST['month']), 'Y-m-01');
                                            $month_date_to = date_format(date_create($_POST['month']), 'Y-m-t');  
                                        
                                            echo '
                                            <br>
                                            <h5>MONTHLY LIQUIDATION REPORT</h5>
                                            Month: <b>'.date_format(date_create($_POST['month']), 'F Y').'</b>
                                            <br><br>
                                            KIMSON ONLINE GROCERY STORE <br>
                                            BULAN SORSOGON<br>
                                            bulankimsonenterprises@gmail.com<br>
                                            09478532014
                                            <br><br>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th class="text-center" colspan="2">COMPUTATION REPORT</th>
                                                </tr>
                                                <tr>
                                                    <th>MONTH</th>
                                                    <th class="text-right">TOTAL AMOUNT</th>
                                                </tr>';
                                                $total = 0;
                                                $q = @mysqli_query($dbc, "SELECT *, DATE_FORMAT(clm_date, '%b %d, %Y') as dateOrder FROM tbl_orders WHERE clm_date BETWEEN '$month_date_from 00:00:00' AND '$month_date_to 23:00:00' AND clm_status = 4 ");
                                                if (!$q){echo mysqli_error($dbc);}
                                                while ($row = mysqli_fetch_array($q))
                                                {
                                                    $total_per_date = 0;                                                    
                                                    $clm_date = $row['clm_date'];
                                                    $q1 = @mysqli_query($dbc, "SELECT * FROM tbl_orders WHERE clm_date = '$clm_date' AND clm_status = 4 ");
                                                    while ($row1 = mysqli_fetch_array($q1))
                                                    {
                                                        $clm_delivery_fee = $row1['clm_delivery_fee'];
                                                        $clm_orderid = $row1['clm_orderid'];
                                                        $q2 = @mysqli_query($dbc, "SELECT * FROM tbl_orders_dts WHERE clm_orderid = '$clm_orderid' ");
                                                        $amount = 0;
                                                        while ($row2 = mysqli_fetch_array($q2))
                                                        {
                                                            $sub_amount = $row2['clm_price'] * $row2['clm_quantity'];
                                                            $amount = $amount + $sub_amount;
                                                        }
                                                        $total_per_date = $amount + $clm_delivery_fee;
                                                    }                                                    
                                                    $total = $total + $total_per_date;
                                                   
                                                }echo' 
                                                <tr>
                                                    <td>'.date_format(date_create($_POST['month']), 'F Y').'</td>
                                                    <td><h5 class="float-right text-success">'.number_format($total,2).'</h5></td>
                                                </tr>                                               
                                            </table>
                                            ';
                                        }
                                    ?>
                                    </div>
                                </div>                                
                            </div>
                            <div id="summary" style="min-height: 400px;" class="container tab-pane <?php if ($_SESSION['report_type'] == 'summary'){echo ' active';}?>"><br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5>Please select date</h5>
                                    </div>
                                    <div class="col-md-8">
                                        <form action="" method="POST">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Date:</span>
                                            </div>
                                            <input type="date" class="form-control" required name="date_summary" style="height: 40px;" value="<?php if (isset($_POST['date_summary'])){echo $_POST['date_summary'];}?>">                                            
                                            <div class="input-group-append">
                                                <button class="btn btn-dark" type="submit" name="generate_summary">Generate</button>
                                            </div>
                                        </div>
                                        </form>                                        
                                    </div>
                                    <div class="col-md-12">
                                    <?php
                                        if (isset($_POST['generate_summary']))
                                        {
                                            $date_summary = $_POST['date_summary'];

                                            echo '
                                            <br>
                                            <h5>SUMMARY OF TRANSACTIONS</h5>
                                            Date: <b>'.date_format(date_create($_POST['date_summary']), 'M d, Y').'</b>
                                            <br><br>
                                            KIMSON ONLINE SHOPPING <br>
                                            BULAN SORSOGON<br>
                                            bulankimsonenterprises@gmail.com<br>
                                            09123456789
                                            <br><br>
                                            <table class="table table-bordered">                                               
                                                <tr>
                                                    <th>Customers Name</th>
                                                    <th>Product Name</th>
                                                    <th>Address</th>
                                                    <th>Mobile No.</th>
                                                    <th>Order ID</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Status</th>
                                                </tr>';
                                                $q = @mysqli_query($dbc, "SELECT * FROM tbl_orders WHERE DATE(clm_date) = '$date_summary' ");                                                
                                                while ($row = mysqli_fetch_array($q))
                                                {
                                                    $clm_status = $row['clm_status'];
                                                    $clm_orderid = $row['clm_orderid'];
                                                    $clm_customerid = $row['clm_customerid'];
                                                    $q1 = @mysqli_query($dbc, "SELECT * FROM tbl_customers WHERE clm_customerid = '$clm_customerid' ");
                                                    $row1 = mysqli_fetch_array($q1);
                                                    $customerName = $row1['clm_fname'].' '.$row1['clm_lname'];
                                                    $address = $row1['clm_address'];
                                                    $contact = $row1['clm_contact'];
                                                    $q2 = @mysqli_query($dbc, "SELECT * FROM tbl_orders_dts WHERE clm_orderid = '$clm_orderid' ");
                                                    while ($row2 = mysqli_fetch_array($q2))
                                                    {
                                                        $clm_prodid = $row2['clm_prodid'];
                                                        $clm_quantity = $row2['clm_quantity'];
                                                        $clm_price = $row2['clm_price'];
                                                        $q3 = @mysqli_query($dbc, "SELECT * FROM tbl_products WHERE clm_prodid = '$clm_prodid' ");
                                                        $row3 = mysqli_fetch_array($q3);
                                                        $prodName = $row3['clm_desc'];

                                                        echo'
                                                        <tr>
                                                            <td>'.$customerName.'</td>
                                                            <td>'.$prodName.'</td>
                                                            <td>'.$address.'</td>
                                                            <td>'.$contact.'</td>
                                                            <td>'.$clm_orderid.'</td>
                                                            <td>'.$clm_quantity.'</td>
                                                            <td>'.$clm_price.'</td>
                                                            <td>';
                                                                if ($clm_status == 1)
                                                                {
                                                                    echo '<span class="text-warning">PENDING</span>';
                                                                }
                                                                else if ($clm_status == 2)
                                                                {
                                                                    echo '<span class="text-warning">PREPARING ORDER</span>';
                                                                }
                                                                else if ($clm_status == 3)
                                                                {
                                                                    echo '<span class="text-info">OUT FOR DELIVERY</span>';
                                                                }
                                                                else if ($clm_status == 4)
                                                                {
                                                                    echo '<span class="text-success">COMPLETED</span>';
                                                                }
                                                                else if ($clm_status == 5)
                                                                {
                                                                    echo '<span class="text-success">CANCALLED</span>';
                                                                }
                                                            echo'</td>
                                                        </tr>';  
                                                    }
                                                }echo'                                                
                                            </table>';
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>                                                  -->
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

    $('.report_daily').click(function(){  
      var report_daily = 1;  
      $.ajax({  
        url:"function.php",  
        method:"post",  
        data:{report_daily:report_daily},  
        success:function(data){  
            $('#modal-content').html(data);  
            //$('#dataModal').modal("show");  
        }  
      });  
    });

    $('.report_monthly').click(function(){  
      var report_monthly = 1;  
      $.ajax({  
        url:"function.php",  
        method:"post",  
        data:{report_monthly:report_monthly},  
        success:function(data){  
            $('#modal-content').html(data);  
            //$('#dataModal').modal("show");  
        }  
      });  
    });

    $('.report_summary').click(function(){  
      var report_summary = 1;  
      $.ajax({  
        url:"function.php",  
        method:"post",  
        data:{report_summary:report_summary},  
        success:function(data){  
            $('#modal-content').html(data);  
            //$('#dataModal').modal("show");  
        }  
      });  
    });

  });
</script>




