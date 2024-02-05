
<?php
    $active = 'products';
    include 'include/header.php';
    
    if (isset($_POST['addBtn']))
    {
        $category = mysqli_real_escape_string($dbc, $_POST['category']);
        $desc = mysqli_real_escape_string($dbc, $_POST['desc']);
        $price = mysqli_real_escape_string($dbc, $_POST['price']);
        $qty = mysqli_real_escape_string($dbc, $_POST['qty']);
        // check category
        if ($category != '0')
        {
            $prodid = 'P'.date('mydsih');
            // upload image
            if($_FILES['img']['tmp_name'] != ''){
                $fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
                $move = move_uploaded_file($_FILES['img']['tmp_name'],'../img/listing/'. $fname);
            }else{$fname = '';}
            // insert in tbl_products
            $q = @mysqli_query($dbc, "INSERT INTO tbl_products 
            (clm_prodid,clm_catid,clm_desc,clm_price,clm_quantity,clm_image,clm_encoded_by) VALUES 
            ('$prodid','$category','$desc','$price','$qty','$fname','$fullname')");
            if ($q)
            {
                $_SESSION['success'] = 'New product has been added successfully';
                echo '<script>location.replace("products");</script>';
            }
            else
            {
                $_SESSION['error'] = mysqli_error($dbc);
            }
        }
        else
        {
            $_SESSION['error'] = 'Please select category';
        }
    }
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
<li class="breadcrumb-item active"aria-current="page">Home</li>
<li class="breadcrumb-item active" aria-current="page">Products</li>
<li class="breadcrumb-item " aria-current="page">Add New Products</li>
</ol>
</div>
</nav>

<section class="py-4 osahan-main-body shadow">
<div class="container">
<div class="row">
    <?php include 'include/sidebar.php';?>
<div class="col-lg-9 p-4 bg-white rounded shadow-sm">
<div class="osahan-promos">
<h4 class="mb-4 profile-title">Add Products
    <a class="ml-auto btn btn-outline-dark float-right btn-sm" href="products"><i class="fa fa-arrow-left"></i> Back to Homepage</a>      
</h4>

                <div class="pick_today shadow">
                <div class="card">
                    <div class="card-body">
                        <?php
                            if (!empty($_SESSION['error']))
                            {
                                echo'
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>'.$_SESSION['error'].'</strong>
                                </div>';
                                unset($_SESSION['error']);
                            }
                        ?>  
                        <form action="" method="POST" enctype="multipart/form-data">
                            <select required class="form-control" name="category">
                                <option value="0">Select Category</option>
                                <?php 
                                    $q = @mysqli_query($dbc, "SELECT * FROM tbl_category");
                                    while ($row = mysqli_fetch_array($q))
                                    {
                                        echo '<option value="'.$row['clm_catid'].'">'.$row['clm_name'].'</option>';
                                    }
                                ?>
                            </select><br>
                            <input required type="text" name="desc" placeholder="Product Description" class="form-control" <?php if (isset($_POST['desc'])){echo ' value="'.$_POST['desc'].'"';}?>><br>
                            <input required type="number" name="price" placeholder="Price" class="form-control" <?php if (isset($_POST['price'])){echo ' value="'.$_POST['price'].'"';}?>><br>                            
                            <input required type="number" name="qty" placeholder="Quantity" class="form-control" <?php if (isset($_POST['qty'])){echo ' value="'.$_POST['qty'].'"';}?>><br>
                            <div class="custom-file mb-3">
                            <input required type="file" class="custom-file-input" id="customFile" name="img" onchange="displayImg(this,$(this))">
                            <label class="custom-file-label" for="customFile">Upload Image (500x500 Pixels)</label>
                            <img src="" alt="" id="cimg">                            
                            <div>
                                <button name="addBtn" type="submit" class="btn btn-dark " style="width: 100%"><b>ADD PRODUCT</b></button>
                        </form>
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
    function displayImg(input,_this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#cimg').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }

        $(".custom-file-input").on("change", function() {
        var img = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(img);
        });
    }
</script>


