<?php
session_start(); 
date_default_timezone_set('Asia/Manila');
require_once('../../database/connection.php');
$CustomerID = $_SESSION['CustomerID'];

if (isset($_POST['add_to_cart']))
{
    $prodid = $_POST['add_to_cart'];
    //select if there is item already in cart
    $q = @mysqli_query($dbc, "SELECT * FROM tbl_cart WHERE clm_customerid = '$CustomerID' AND clm_prodid = '$prodid' ");
    $row = mysqli_fetch_array($q);
    if (mysqli_num_rows($q) != 0)
    {
        // check stock
        $q1 = @mysqli_query($dbc, "SELECT * FROM tbl_products WHERE clm_prodid = '$prodid' ");
        $row1 = mysqli_fetch_array($q1);
        $stock = $row1['clm_quantity'];
        $quantity = $row['clm_quantity'];

        if ($stock > $quantity)
        {
            //add quantity        
            $q = @mysqli_query($dbc, "UPDATE tbl_cart SET clm_quantity = clm_quantity + 1 WHERE clm_customerid = '$CustomerID' AND clm_prodid = '$prodid' ");
            if ($q)
            {
                echo '<script>location.replace("index");</script>';
            }
            else
            {
                $_SESSION['error'] = mysqli_error($dbc);
            }
        }
        else
        {
            $_SESSION['error'] = 'Not enough stock!';
        }
    }
    else
    {
        $q = @mysqli_query($dbc, "INSERT INTO tbl_cart 
        (clm_prodid, clm_customerid) VALUES ('$prodid','$CustomerID')");
    }
    echo '<script>location.replace("index");</script>';
}

if(isset($_POST['manual']))
{  
    $cart_id = $_POST['manual'];
    $q = @mysqli_query($dbc, "SELECT * FROM tbl_cart WHERE clm_cartid = '$cart_id' ");
    $row = mysqli_fetch_array($q);
  echo '
  <div  class="modal-content" style="width: 100%;" >
    <div class="modal-header">  
      <h4 class="modal-title">Change Quantity</h4>  
      <button type="button" class="close" data-dismiss="modal">&times;</button>  
    </div>  
    <div class="modal-body">
        <input type="number" style="font-size: 20px;" class="form-control text-center" name="qty" required autofocus value="'.$row['clm_quantity'].'"><br>                         
      
    </div>      
    <div class="modal-footer">
        <button class="btn btn-dark" type="submit" name="changeQtyManual"><i class="fa fa-check-circle"></i> CHANGE</button>
        <input type="hidden" name="cart_id" value="'.$_POST['manual'].'">
    </div>  
  </div>';
} 

if(isset($_POST['placeorderBtn']))
{  
  echo '
  <div  class="modal-content" style="width: 100%;" >
    <div class="modal-header">  
      <h4 class="modal-title">Confirmation</h4>  
      <button type="button" class="close" data-dismiss="modal">&times;</button>  
    </div>  
    <div class="modal-body">
        You are about to place this order
      
    </div>      
    <div class="modal-footer">
        <button class="btn btn-dark" type="submit" name="placeorderBtn"><i class="fa fa-check-circle"></i> Confirm</button>
    </div>  
  </div>';
} 

if(isset($_POST['cancelOrder']))
{  
  echo '
  <div  class="modal-content" style="width: 100%;" >
    <div class="modal-header">  
      <h4 class="modal-title">Confirmation</h4>  
      <button type="button" class="close" data-dismiss="modal">&times;</button>  
    </div>  
    <div class="modal-body">
        Are you sure you want to cancel this order?
        <br><br>
        <input type="text" name="cancelRemarks" placeholder="Please input remarks" required class="form-control">
      
    </div>      
    <div class="modal-footer">
        <button class="btn btn-dark" type="submit" name="cancelOrderBtn"><i class="fa fa-check-circle"></i> Cancel Order</button>
        <input type="hidden" name="orderid" value="'.$_POST['cancelOrder'].'">
    </div>  
  </div>';
} 

if(isset($_POST['ReceivedOrder']))
{  
  echo '
  <div  class="modal-content" style="width: 100%;" >
    <div class="modal-header">  
      <h4 class="modal-title">Confirmation</h4>  
      <button type="button" class="close" data-dismiss="modal">&times;</button>  
    </div>  
    <div class="modal-body">
        Are you sure you receive this order?
    </div>      
    <div class="modal-footer">
        <button class="btn btn-dark" type="submit" name="ReceivedOrderBtn"><i class="fa fa-check-circle"></i> Confirm</button>
        <input type="hidden" name="orderid" value="'.$_POST['ReceivedOrder'].'">
    </div>  
  </div>';
} 




?>