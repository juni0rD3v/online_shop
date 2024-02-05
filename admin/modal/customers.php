<?php
session_start(); 
date_default_timezone_set('Asia/Manila');
require_once('../../database/connection.php');

if(isset($_POST['delete_customer']))
{  
  $customerID = $_POST['delete_customer'];
  $q = @mysqli_query($dbc, "SELECT * FROM tbl_customers WHERE clm_customerid = '$customerID' ");
  $row = mysqli_fetch_array($q);
  echo '
  <div  class="modal-content" style="width: 100%;" >
    <div class="modal-header">  
      <h4 class="modal-title">Confirmation</h4>  
      <button type="button" class="close" data-dismiss="modal">&times;</button>  
    </div>  
    <div class="modal-body">
      You are about to delete customer "'.$row['clm_fname'].' '.$row['clm_lname'].'".<br>
      <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Input remarks" required>                               
    </div>      
    <div class="modal-footer">
        <button class="btn btn-dark" type="submit" name="delete_customer"><i class="fa fa-check-circle"></i> Confirm</button>
        <input type="hidden" name="customerID" value="'.$customerID.'">
    </div>  
  </div>';
} 

if(isset($_POST['reactivate']))
{  
  $customerID = $_POST['reactivate'];
  $q = @mysqli_query($dbc, "SELECT * FROM tbl_customers WHERE clm_customerid = '$customerID' ");
  $row = mysqli_fetch_array($q);
  echo '
  <div  class="modal-content" style="width: 100%;" >
    <div class="modal-header">  
      <h4 class="modal-title">Confirmation</h4>  
      <button type="button" class="close" data-dismiss="modal">&times;</button>  
    </div>  
    <div class="modal-body">
      You are about to reactivate customer "'.$row['clm_fname'].' '.$row['clm_lname'].'".<br>                           
    </div>      
    <div class="modal-footer">
        <button class="btn btn-dark" type="submit" name="reactivate_customer"><i class="fa fa-check-circle"></i> Confirm</button>
        <input type="hidden" name="customerID" value="'.$customerID.'">
    </div>  
  </div>';
} 
?>