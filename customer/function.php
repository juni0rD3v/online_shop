<?php
    session_start();
    require_once('../database/connection.php');
    if (empty($_SESSION['CustomerID'])){echo '<script>location.replace("../login");</script>';}
    else
    {
        $CustomerID = $_SESSION['CustomerID'];
        $q = @mysqli_query($dbc, "SELECT * FROM tbl_customers WHERE clm_customerid = '$CustomerID' ");
        $row_info = mysqli_fetch_array($q);
        $fullname = $row_info['clm_fname'].' '.$row_info['clm_lname'];
        $username = $row_info['clm_username'];
        $pass = $row_info['clm_password'];

    }
    $pesos = "\u{20b1}";

    // CART

    if (isset($_POST['deleteBtn']))
    {
        $cartid = $_POST['deleteBtn'];

        $q = @mysqli_query($dbc, "DELETE FROM tbl_cart WHERE clm_cartid = '$cartid' ");
        if ($q)
        {
            echo '<script>location.replace("my_cart");</script>';
        }
        else
        {
            $_SESSION['error'] = mysqli_error($dbc);
            echo '<script>location.replace("my_cart");</script>';
        }
    }

    if (isset($_POST['minus']))
    {
        $cartid = $_POST['minus'];
        $q = @mysqli_query($dbc, "SELECT * FROM tbl_cart WHERE clm_cartid = '$cartid' ");
        $row = mysqli_fetch_array($q);

        if ($row['clm_quantity'] == 1)
        {
            $q = @mysqli_query($dbc, "DELETE FROM tbl_cart WHERE clm_cartid = '$cartid' ");
            if (!$q)
            {
                $_SESSION['error'] = mysqli_error($dbc);
            }
        }
        else
        {
            $q = @mysqli_query($dbc, "UPDATE tbl_cart SET clm_quantity = clm_quantity - 1 WHERE clm_cartid = '$cartid' ");
            if (!$q)
            {
                $_SESSION['error'] = mysqli_error($dbc);
            }
        }
        echo '<script>location.replace("my_cart");</script>';        
    }

    if (isset($_POST['plus']))
    {
        $cartid = $_POST['plus'];        
        $q = @mysqli_query($dbc, "SELECT *, b.clm_quantity as ProductQuantity, a.clm_quantity as CartQuantity FROM tbl_cart a, tbl_products b WHERE a.clm_prodid = b.clm_prodid AND a.clm_cartid = '$cartid' ");
        $row = mysqli_fetch_array($q);
        if ($row['CartQuantity'] < $row['ProductQuantity'])
        {
            $q = @mysqli_query($dbc, "UPDATE tbl_cart SET clm_quantity = clm_quantity + 1 WHERE clm_cartid = '$cartid' ");
            if (!$q)
            {
                $_SESSION['error'] = mysqli_error($dbc);
            }            
        }    
        else
        {
            $_SESSION['error'] = 'Not enough stock!';
        }        
        echo '<script>location.replace("my_cart");</script>';    
    }

    if (isset($_POST['checkoutBtn']))
    {
        $_SESSION['checkout'] = 'true';
        echo '<script>location.replace("checkout");</script>';        
    }

    if (isset($_POST['placeorderBtn']))
    {
        // check
        $sf = @mysqli_query($dbc, "SELECT * FROM tbl_setup ");
        $row_sf = mysqli_fetch_array($sf);
        $delivery_fee = $row_sf['clm_delivery_fee'];
        $orderID = date('ymdhis');        
        $q = @mysqli_query($dbc, "INSERT INTO tbl_orders (clm_orderid, clm_customerid, clm_delivery_fee) VALUES ('$orderID','$CustomerID','$delivery_fee')");
        if ($q)
        {
            $q = @mysqli_query($dbc, "SELECT *, a.clm_quantity as Quantity FROM tbl_cart a, tbl_products b WHERE a.clm_prodid = b.clm_prodid AND clm_customerid = '$CustomerID' ");
            while ($row = mysqli_fetch_array($q))
            {
                $clm_cartid = $row['clm_cartid'];
                $clm_productid = $row['clm_prodid'];
                $clm_price = $row['clm_price'];
                $clm_quantity = $row['Quantity'];
                // create order
                $q1 = @mysqli_query($dbc, "INSERT INTO tbl_orders_dts (clm_orderid, clm_prodid,clm_price,clm_quantity) VALUES ('$orderID','$clm_productid','$clm_price','$clm_quantity')");
                // less qty for products
                $q2 = @mysqli_query($dbc, "UPDATE tbl_products SET clm_quantity = clm_quantity - '$clm_quantity' WHERE clm_prodid = '$clm_productid' ");
                // delete items in cart   
                $q3 = @mysqli_query($dbc, "DELETE FROM tbl_cart WHERE clm_cartid = '$clm_cartid' ");

            } 
            $_SESSION['success'] = 'Your order is on process. Please check your profile for notification of confirmation.';
            echo '<script>location.replace("to_ship");</script>';
            
        } 
        else
        {
            $_SESSION['error'] = mysqli_error($dbc);
            echo '<script>location.replace("checkout");</script>';    
        }  
    }

    if (isset($_POST['changeQtyManual']))
    {
        $cartid = $_POST['cart_id'];       
        $qty = $_POST['qty'];

        $q = @mysqli_query($dbc, "SELECT *, b.clm_quantity as ProductQuantity, a.clm_quantity as CartQuantity FROM tbl_cart a, tbl_products b WHERE a.clm_prodid = b.clm_prodid AND a.clm_cartid = '$cartid' ");
        $row = mysqli_fetch_array($q);
        if ($qty <= $row['ProductQuantity'])
        {
            $q = @mysqli_query($dbc, "UPDATE tbl_cart SET clm_quantity = '$qty' WHERE clm_cartid = '$cartid' ");
            if (!$q)
            {
                $_SESSION['error'] = mysqli_error($dbc);
            }            
        }    
        else
        {
            $_SESSION['error'] = 'Not enough stock!';
        }        
        echo '<script>location.replace("my_cart");</script>';    
    }

    if (isset($_POST['view_order']))
    {
        $_SESSION['view_order'] = $_POST['view_order'];
        $_SESSION['pageName'] = $_POST['pageName'];
        echo '<script>location.replace("view_order");</script>';    
    }

    if (isset($_POST['cancelOrderBtn']))
    {
        $orderid = $_POST['orderid'];
        $cancelRemarks = mysqli_real_escape_string($dbc, $_POST['cancelRemarks']);
        // check if the order is not out for delivery
        $q = @mysqli_query($dbc, "SELECT * FROM tbl_orders WHERE clm_orderid = '$orderid' ");
        $r = mysqli_fetch_array($q);
        if ($r['clm_status'] == 3)
        {
            $_SESSION['error'] = 'This order is out for delivery and cannot be cancelled.';
            echo '<script>location.replace("view_order");</script>'; 
        }
        else
        {
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

    

    //
?>