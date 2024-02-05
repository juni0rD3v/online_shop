<?php
session_start(); 
date_default_timezone_set('Asia/Manila');
require_once('../../database/connection.php');

if(isset($_POST['add_user']))
{  
  echo '
  <div  class="modal-content" style="width: 100%;" >
    <div class="modal-header">  
      <h4 class="modal-title">New User</h4>  
      <button type="button" class="close" data-dismiss="modal">&times;</button>  
    </div>  
    <div class="modal-body">
      Username
      <input type="text" class="form-control" name="user" placeholder="Username" required><br> 
      Password
      <input type="password" class="form-control" name="pass" placeholder="Password" required><br>
      Confirm Password
      <input type="password" class="form-control" name="conpass" placeholder="Confirm Password" required>                          
    </div>      
    <div class="modal-footer">
        <button class="btn btn-dark" type="submit" name="add_user"><i class="fa fa-check-circle"></i> Create</button>
    </div>  
  </div>';
} 

if(isset($_POST['edit']))
{  
  $userID = $_POST['edit'];
  $q = @mysqli_query($dbc, "SELECT * FROM tbl_admin WHERE clm_adminid = '$userID' ");
  $row = mysqli_fetch_array($q);
  echo '
  <div  class="modal-content" style="width: 100%;" >
    <div class="modal-header">  
      <h4 class="modal-title">Update User</h4>  
      <button type="button" class="close" data-dismiss="modal">&times;</button>  
    </div>  
    <div class="modal-body">
      Username
      <input type="text" class="form-control" name="user" placeholder="Username" value="'.$row['clm_username'].'" required><br> 
      Password
      <input type="password" class="form-control" name="pass" placeholder="Password" required><br>
      Confirm Password
      <input type="password" class="form-control" name="conpass" placeholder="Confirm Password" required>                          
    </div> 
    <div class="modal-footer">
        <button class="btn btn-dark" type="submit" name="update_user"><i class="fa fa-check-circle"></i> Update</button>
        <input type="hidden" name="userID" value="'.$userID.'">
    </div>  
  </div>';
} 

if(isset($_POST['delete_user']))
{  
  $userID = $_POST['delete_user'];
  $q = @mysqli_query($dbc, "SELECT * FROM tbl_admin WHERE clm_adminid = '$userID' ");
  $row = mysqli_fetch_array($q);
  echo '
  <div  class="modal-content" style="width: 100%;" >
    <div class="modal-header">  
      <h4 class="modal-title">Confirmation</h4>  
      <button type="button" class="close" data-dismiss="modal">&times;</button>  
    </div>  
    <div class="modal-body">
      You are about to delete user "'.$row['clm_username'].'".<br>                           
    </div>      
    <div class="modal-footer">
        <button class="btn btn-dark" type="submit" name="delete_user"><i class="fa fa-check-circle"></i> Confirm</button>
        <input type="hidden" name="userID" value="'.$userID.'">
    </div>  
  </div>';
} 

if(isset($_POST['reactivate']))
{  
  $userID = $_POST['reactivate'];
  $q = @mysqli_query($dbc, "SELECT * FROM tbl_admin WHERE clm_adminid = '$userID' ");
  $row = mysqli_fetch_array($q);
  echo '
  <div  class="modal-content" style="width: 100%;" >
    <div class="modal-header">  
      <h4 class="modal-title">Confirmation</h4>  
      <button type="button" class="close" data-dismiss="modal">&times;</button>  
    </div>  
    <div class="modal-body">
      You are about to reactivate user "'.$row['clm_username'].'".<br>                           
    </div>      
    <div class="modal-footer">
        <button class="btn btn-dark" type="submit" name="reactivate_user"><i class="fa fa-check-circle"></i> Confirm</button>
        <input type="hidden" name="userID" value="'.$userID.'">
    </div>  
  </div>';
} 
?>