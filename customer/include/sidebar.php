
<div class="col-lg-3">
    <div class="osahan-account bg-white rounded shadow-sm overflow-hidden ">
        <div class="p-4 profile text-center border-bottom bg-dark">
            <!-- <img src="img/user.png" class="img-fluid rounded-pill"> -->
            <div class="ml-auto">
            <div class="dropdown mr-3">
                <a href="#" class="dropdown- text-white" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user-circle text-white" style="font-size: 20px; margin-right: 0px;"></i> Hi <b><?php echo $fullname;?></b>
                </a>
                <!-- <div class="dropdown-menu dropdown-menu-right top-profile-drop" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="change_pass"><i class="fa fa-cog"></i> Change Password</a>                
                <a class="dropdown-item" href="../logout"><i class="fa fa-sign-out-alt"></i> Logout</a>
                </div> -->
            </div>
        </div>
            <!-- <p class="small text-muted m-0"><a href="https://askbootstrap.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="432a222e2c30222b222d03242e222a2f6d202c2e">[email&#160;protected]</a></p> -->
        </div>
        <div class="account-sections">
            <ul class="list-group">
                <a href="index" class="text-decoration-none text-dark">
                    <li class="border-bottom bg-white d-flex align-items-center p-3">
                    <i class="icofont-home osahan-icofont bg-info"></i>Home
                    <span class="badge badge-info p-1 badge-pill ml-auto"><i class="icofont-simple-right"></i></span>
                    </li>
                </a>
                <a href="index" class="text-decoration-none text-dark">
                    <li class="nav-item dropdown border-bottom pt-3 pb-3">
                        <a class="nav-link text-dark dropdown-toggle <?php if ($active == 'my_purchases'){echo ' font-weight-bold';}?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icofont-truck osahan-icofont bg-info"></i>My Purchases <?php echo $toReceiveBadge; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item <?php if ($active_sub == 'all'){echo ' font-weight-bold text-dark';}?>" href="all">All</a>
                        <a class="dropdown-item <?php if ($active_sub == 'to_ship'){echo ' font-weight-bold text-dark';}?>" href="to_ship">To Ship <?php echo $toShipBadge; ?></a>
                        <a class="dropdown-item <?php if ($active_sub == 'to_receive'){echo ' font-weight-bold text-dark';}?>" href="to_receive">To Receive <?php echo $toReceiveBadge; ?></a>
                        <a class="dropdown-item <?php if ($active_sub == 'completed'){echo ' font-weight-bold text-dark';}?>" href="completed">Completed</a>
                        <a class="dropdown-item <?php if ($active_sub == 'cancelled'){echo ' font-weight-bold text-dark';}?>" href="Cancelled">Cancelled</a>                    
                        </div>
                </li>
                </a>
                <!-- <a href="products" class="text-decoration-none text-dark">
                    <li class="border-bottom bg-white d-flex  align-items-center p-3">
                    <i class="icofont-sale-discount osahan-icofont bg-info"></i> All Products
                    <span class="badge badge-info p-1 badge-pill ml-auto"><i class="icofont-simple-right"></i></span>
                    </li>
                </a> -->
                <a href="my_cart" class="text-decoration-none text-dark">
                    <li class="border-bottom bg-white d-flex align-items-center p-3">
                    <i class="icofont-cart osahan-icofont bg-info"></i>
                    <?php 
                        $count_cart = @mysqli_query($dbc, "SELECT COUNT(clm_prodid) as quantity FROM tbl_cart WHERE clm_customerid = '$CustomerID' AND clm_status = 1");            
                        $row_cart = mysqli_fetch_array($count_cart);                    
                        if ($row_cart['quantity'] >= 1)
                        {
                            echo'<span class=" text-danger" style="font-family: arial; font-size: 15px;"><b>'.$row_cart['quantity'].'</b></span>';
                        }
                        // badge
                        $q_toShipBadge = @mysqli_query($dbc, "SELECT * FROM tbl_orders WHERE clm_customerid = '$CustomerID' AND clm_status = 1 OR clm_status = 2"); 
                        if (mysqli_num_rows($q_toShipBadge) != 0)    
                        {
                            $toShipBadge = '<span class="badge badge-danger">'.mysqli_num_rows($q_toShipBadge).'</span>';
                        }
                        else
                        {
                            $toShipBadge = '';
                        }     

                        $q_toReceiveBadge = @mysqli_query($dbc, "SELECT * FROM tbl_orders WHERE clm_customerid = '$CustomerID' AND clm_status = 3");        
                        if (mysqli_num_rows($q_toReceiveBadge) != 0)
                        {
                            $toReceiveBadge = '<span class="badge badge-danger">'.mysqli_num_rows($q_toReceiveBadge).'</span>';
                        }  
                        else
                        {
                            $toReceiveBadge = '';
                        }  

                    ?> Cart
                    </li>
                </a>
               
                <form action="" method="POST" class="p-2">
                    <div class="input-group mr-sm-2 col-lg-12">
                        <input type="text" name="searchtxt" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Search for Products..">
                        <div class="input-group-prepend">
                        <button type="submit" class="btn btn-dark rounded-right"><i class="icofont-search"></i></button>
                        </div>
                    </div>
                </form>
                <form action="" method="POST" class="p-2">
                    <div class="title">                
                        <div class="ml-auto input-group input-group-sm col-sm-12">
                            <div class="input-group-prepend">
                            <span class="input-group-text">Category</span>
                            </div>                        
                            <select class="form-control" name="category">
                                
                                <?php 
                                    if (isset($_POST['category'])){ echo '<option value="'.$catid.'">'.$cat_name.'</option>';}
                                    echo'<option value="0">All</option>';
                                    $q_cat = @mysqli_query($dbc, "SELECT * FROM tbl_category");
                                    while ($row_cat = mysqli_fetch_array($q_cat))
                                    {
                                        echo '<option value="'.$row_cat['clm_catid'].'">'.$row_cat['clm_name'].'</option>';
                                    }
                                ?>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-dark" name="goBtn" type="submit">Go</button>
                            </div>

                        </div>
                    </div>
                </form>
                <a href="manage" class="text-decoration-none text-dark">
                    <li class="border-bottom bg-white d-flex  align-items-center p-3">
                    <i class="icofont-user osahan-icofont bg-info"></i> Manage Profile
                    <span class="badge badge-info p-1 badge-pill ml-auto"><i class="icofont-simple-right"></i></span>
                    </li>
                </a>
                <a href="change_pass" class="text-decoration-none text-dark">
                    <li class="border-bottom bg-white d-flex  align-items-center p-3">
                    <i class="icofont-lock osahan-icofont bg-info"></i> Change Password
                    <span class="badge badge-info p-1 badge-pill ml-auto"><i class="icofont-simple-right"></i></span>
                    </li>
                </a>
                <a href="../logout" class="text-decoration-none text-dark">
                    <li class="border-bottom bg-white d-flex  align-items-center p-3">
                    <i class="icofont-login osahan-icofont bg-info"></i>Logout
                    <span class="badge badge-info p-1 badge-pill ml-auto"><i class="icofont-simple-right"></i></span>
                    </li>
                </a>
            </ul>
        </div>
    </div>
</div>