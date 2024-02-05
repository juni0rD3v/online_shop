<?php
session_start(); 
date_default_timezone_set('Asia/Manila');
require_once('../../database/connection.php');

if(isset($_POST['add_new']))
{  
  echo '
  <div  class="modal-content" style="width: 100%;" >
    <div class="modal-header">  
      <h4 class="modal-title">New Category</h4>  
      <button type="button" class="close" data-dismiss="modal">&times;</button>  
    </div>  
    <div class="modal-body">
        <input type="text" class="form-control" name="name" placeholder="Category Name" required autofocus><br>                            
      
    </div>      
    <div class="modal-footer">
        <button class="btn btn-dark" type="submit" name="add_new_category"><i class="fa fa-plus-circle"></i> ADD</button>
    </div>  
  </div>';
} 

if(isset($_POST['edit']))
{  
    $catid = $_POST['edit'];
    $q = @mysqli_query($dbc, "SELECT * FROM tbl_category WHERE clm_catid = '$catid' ");
    $row = mysqli_fetch_array($q);
  echo '
  <div  class="modal-content" style="width: 100%;" >
    <div class="modal-header">  
      <h4 class="modal-title">Update Category</h4>  
      <button type="button" class="close" data-dismiss="modal">&times;</button>  
    </div>  
    <div class="modal-body">
        <input type="text" class="form-control" name="name" placeholder="Category Name" required value="'.$row['clm_name'].'"><br>                            
      
    </div>      
    <div class="modal-footer">
        <button class="btn btn-dark" type="submit" name="update_category"><i class="fa fa-check-circle"></i> UPDATE</button>
        <input type="hidden" name="catid" value="'.$catid.'">
    </div>  
  </div>';
} 
?>