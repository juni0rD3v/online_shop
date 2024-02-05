<?php
session_start(); 
date_default_timezone_set('Asia/Manila');
require_once('../database/connection.php');
if (empty($_SESSION['AdminID'])){echo '<script>location.replace("../login");</script>';}
else
{
    $AdminID = $_SESSION['AdminID'];
    $q = @mysqli_query($dbc, "SELECT * FROM tbl_admin WHERE clm_adminid = '$AdminID' ");
    $row_admin = mysqli_fetch_array($q);
    $fullname = $row_admin['clm_username'];
}

// CATEGORY

if (isset($_POST['add_new_category']))
{
    $name = mysqli_real_escape_string($dbc, $_POST['name']);
    // check if category already exist
    $q = @mysqli_query($dbc, "SELECT * FROM tbl_category WHERE clm_name = '$name' ");
    if (mysqli_num_rows($q) != 1)
    {
        $catid = 'C'.date('ymdhis');
        $q = @mysqli_query($dbc, "INSERT INTO tbl_category (clm_catid, clm_name, clm_encoded_by) VALUES ('$catid', '$name', '$fullname') ");
        if ($q)
        {
            $_SESSION['success'] = '<b>'.$name.'</b> Successfully added';
            echo '<script>location.replace("category");</script>';
        }
    }
    else
    {
        $_SESSION['error'] = 'Category name already exist';
        echo '<script>location.replace("category");</script>';
    }
}

if (isset($_POST['update_category']))
{
    $name = mysqli_real_escape_string($dbc, $_POST['name']);
    $catid = mysqli_real_escape_string($dbc, $_POST['catid']);
    // check if category already exist
    $q = @mysqli_query($dbc, "SELECT * FROM tbl_category WHERE clm_name = '$name' ");
    if (mysqli_num_rows($q) != 1)
    {
        $q = @mysqli_query($dbc, "UPDATE tbl_category SET clm_name = '$name', clm_encoded_by = '$fullname' WHERE clm_catid = '$catid' ");
        if ($q)
        {
            $_SESSION['success'] = '<b>Successfully updated</b>';
            echo '<script>location.replace("category");</script>';
        }
    }
    else
    {
        $_SESSION['error'] = 'Category name already exist';
        echo '<script>location.replace("category");</script>';
    }

}

// CUSTOMERS

if (isset($_POST['delete_customer']))
{
    $customerID = $_POST['customerID'];
    $remarks = mysqli_real_escape_string($dbc, $_POST['remarks']);
    $q = @mysqli_query($dbc, "UPDATE tbl_customers SET clm_status = 0, clm_del_by = '$fullname', clm_date_del = NOW(), clm_remarks = '$remarks' WHERE clm_customerid = '$customerID' ");
    if ($q)
    {
        $_SESSION['success'] = 'Successfully deleted';
        echo '<script>location.replace("customers");</script>';
    }
}

if (isset($_POST['reactivate_customer']))
{
    $customerID = $_POST['customerID'];
    $q = @mysqli_query($dbc, "UPDATE tbl_customers SET clm_status = 1, clm_del_by = NULL, clm_date_del = NULL, clm_remarks = NULL WHERE clm_customerid = '$customerID' ");
    if ($q)
    {
        $_SESSION['success'] = 'Successfully reactivated';
        echo '<script>location.replace("deleted_customers");</script>';
    }
}

// MANAGE USERS
if (isset($_POST['add_user']))
{
    $user = mysqli_real_escape_string($dbc, $_POST['user']);
    $pass = mysqli_real_escape_string($dbc, $_POST['pass']);
    $conpass = mysqli_real_escape_string($dbc, $_POST['conpass']);
    // check if passwords match
    if ($pass == $conpass)
    {
        $adminid = 'ADMIN'.date('ymdsih');
        $q = @mysqli_query($dbc, "INSERT INTO tbl_admin (clm_adminid, clm_username, clm_password) VALUES ('$adminid','$user',md5('$pass')) ");
        if ($q)
        {
            $_SESSION['success'] = 'New user has been successfully added';
        }
        else
        {
            $_SESSION['error'] = mysqli_error($dbc);
        }
    }
    else
    {
        $_SESSION['error'] = 'Passwords not match!';
    }
    echo '<script>location.replace("manage_users");</script>';

}

if (isset($_POST['update_user']))
{
    $userID = mysqli_real_escape_string($dbc, $_POST['userID']);
    $user = mysqli_real_escape_string($dbc, $_POST['user']);
    $pass = mysqli_real_escape_string($dbc, $_POST['pass']);
    $conpass = mysqli_real_escape_string($dbc, $_POST['conpass']);
    // check if passwords match
    if ($pass == $conpass)
    {
        $q = @mysqli_query($dbc, "UPDATE tbl_admin SET clm_username = '$user', clm_password = md5('$pass') WHERE clm_adminid = '$userID' ");
        if ($q)
        {
            $_SESSION['success'] = 'User has been successfully updated';
        }
        else
        {
            $_SESSION['error'] = mysqli_error($dbc);
        }
    }
    else
    {
        $_SESSION['error'] = 'Passwords not match!';
    }
    echo '<script>location.replace("manage_users");</script>';

}

if (isset($_POST['delete_user']))
{
    $userID = mysqli_real_escape_string($dbc, $_POST['userID']);    
    $q = @mysqli_query($dbc, "UPDATE tbl_admin SET clm_status = 0 WHERE clm_adminid = '$userID' ");
    if ($q)
    {
        $_SESSION['success'] = 'User has been deleted successfully';
    }
    else
    {
        $_SESSION['error'] = mysqli_error($dbc);
    }
    echo '<script>location.replace("manage_users");</script>';

}

if (isset($_POST['reactivate_user']))
{
    $userID = mysqli_real_escape_string($dbc, $_POST['userID']);    
    $q = @mysqli_query($dbc, "UPDATE tbl_admin SET clm_status = 1 WHERE clm_adminid = '$userID' ");
    if ($q)
    {
        $_SESSION['success'] = 'User has been reactivated successfully';
    }
    else
    {
        $_SESSION['error'] = mysqli_error($dbc);
    }
    echo '<script>location.replace("inactive_users");</script>';

}

if (isset($_POST['view_order']))
{
    $_SESSION['view_order'] = $_POST['view_order'];
    $_SESSION['pageName'] = $_POST['pageName'];
    echo '<script>location.replace("view_order");</script>';    
}

if (isset($_POST['prepareOrderBtn']))
{
    $orderid = $_POST['orderid'];
    $q = @mysqli_query($dbc, "UPDATE tbl_orders SET clm_status = 2, clm_remarks = 'Preparing Order', clm_date_preparing = NOW() WHERE clm_orderid = '$orderid' ");
    if ($q)
    {
        $_SESSION['success'] = 'Order ID: '.$orderid.' Your order will be prepared and will come soon.';
        echo '<script>location.replace("index");</script>';    

    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // $number = $_POST['number']; // Phone number to send SMS
        // $message = $_POST['message']; // SMS message
      
      
            $ch = curl_init();
            $parameters = array(
                'apikey' => '8fb4048190209848376d07e02cfed34e', //Your API KEY
                'number' => '09460947869',
                'message' => 'DEAR Maam/Sir ,
                Ang iyong order ay inihahanda na.
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
}
if (isset($_POST['ReceivedOrderBtn']))
{
    $orderid = $_POST['orderid'];

    $q = @mysqli_query($dbc, "UPDATE tbl_orders SET clm_status = 4, clm_date_completed = NOW(), clm_remarks = 'Received Order' WHERE clm_orderid = '$orderid' ");
    if ($q)
    {
        $_SESSION['success'] = 'true';
        echo '<script>location.replace("completed");</script>'; 
    }
}

if (isset($_POST['outOrderBtn']))
{   
    $orderid = $_POST['orderid'];
    $q = @mysqli_query($dbc, "UPDATE tbl_orders SET clm_status = 3, clm_remarks = 'Out for Delivery', clm_date_to_receive = NOW() WHERE clm_orderid = '$orderid' ");
    if ($q)
    {
        $_SESSION['success'] = 'Order ID: '.$orderid.' is out for delivery.';
        echo '<script>location.replace("on_delivery");</script>';    

    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // $number = $_POST['number']; // Phone number to send SMS
        // $message = $_POST['message']; // SMS message
      
      
            $ch = curl_init();
            $parameters = array(
                'apikey' => '8fb4048190209848376d07e02cfed34e', //Your API KEY
                'number' => '09460947869',
                'message' => 'DEAR Maam/Sir ,
                Your order is on its way! Please have the exact amount of cash for our deliverer.
                 Thank you..(KIMSON ONLINE GROCERY)',
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
}

if (isset($_POST['cancelOrderBtn']))
{
    $orderid = $_POST['orderid'];
    $cancelRemarks = mysqli_real_escape_string($dbc, $_POST['cancelRemarks']);
    
    // return quantity each item
    $q = @mysqli_query($dbc, "SELECT * FROM tbl_orders_dts WHERE clm_orderid = '$orderid' ");
    while ($r = mysqli_fetch_array($q))
    {
        $clm_prodid = $r['clm_prodid'];
        $clm_quantity = $r['clm_quantity'];
        $p = @mysqli_query($dbc, "UPDATE tbl_products SET clm_quantity = clm_quantity + '$clm_quantity' WHERE clm_prodid = '$clm_prodid' ");
    }
    // change order status into cancelled
    $q1 = @mysqli_query($dbc, "UPDATE tbl_orders SET clm_status = 5, clm_date_cancelled = NOW(), clm_cancelled_remarks = '$cancelRemarks', clm_cancelled_by = '$fullname' WHERE clm_orderid = '$orderid' ");
    if ($q1)
    {
        $_SESSION['success'] = 'Order ID: '.$orderid.' has been cancelled';
        echo '<script>location.replace("cancelled");</script>'; 
    }
}

// REPORTS
if (isset($_POST['report_daily']))
{
    $_SESSION['report_type'] = 'daily';
    echo'<script>location.replace("");</script>';
}

if (isset($_POST['report_monthly']))
{
    $_SESSION['report_type'] = 'monthly';
    echo'<script>location.replace("");</script>';
}

if (isset($_POST['report_summary']))
{
    $_SESSION['report_type'] = 'summary';
    echo'<script>location.replace("");</script>';
}





?>