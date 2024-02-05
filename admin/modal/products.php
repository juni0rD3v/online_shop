<?php
session_start(); 
date_default_timezone_set('Asia/Manila');
require_once('../../database/connection.php');

if (isset($_POST['edit_product']))
{
    $_SESSION['edit_product'] = $_POST['edit_product'];
    echo '<script>location.replace("edit_product");</script>';
}

?>