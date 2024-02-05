
<?php
    $active = 'products';
    include 'include/header.php';
    if (empty($_SESSION['edit_product'])){
        echo '<script>location.replace("products");</script>';
    }else{
        $prodid = $_SESSION['edit_product'];
        $q = @mysqli_query($dbc, "SELECT * FROM tbl_products WHERE clm_prodid = '$prodid' ");
        $row = mysqli_fetch_array($q);
        $catid = $row['clm_catid'];
        $q1 = @mysqli_query($dbc, "SELECT * FROM tbl_category WHERE clm_catid = '$catid' ");
        $row1 = mysqli_fetch_array($q1);

    }

    if (isset($_POST['updateBtn']))
    {
        $category = mysqli_real_escape_string($dbc, $_POST['category']);
        $desc = mysqli_real_escape_string($dbc, $_POST['desc']);
        $price = mysqli_real_escape_string($dbc, $_POST['price']);
        $qty = mysqli_real_escape_string($dbc, $_POST['qty']);
       
        // if image is change
        if($_FILES['img']['tmp_name'] != ''){
            $fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
            $move = move_uploaded_file($_FILES['img']['tmp_name'],'../img/listing/'. $fname);
            
            // update product
            $q = @mysqli_query($dbc, "UPDATE tbl_products SET 
            clm_catid = '$category',clm_desc = '$desc',clm_price = '$price',clm_quantity = '$qty',clm_image = '$fname',clm_edited_by = '$fullname', clm_date_edited = NOW() WHERE clm_prodid = '$prodid' ");
            if ($q)
            {
                $_SESSION['success'] = 'Product has been updated successfully';
                echo '<script>location.replace("products");</script>';
            }
            else
            {
                $_SESSION['error'] = mysqli_error($dbc);
            }
        }else{
            // update product
            $q = @mysqli_query($dbc, "UPDATE tbl_products SET 
            clm_catid = '$category',clm_desc = '$desc',clm_price = '$price',clm_quantity = '$qty',clm_edited_by = '$fullname', clm_date_edited = NOW() WHERE clm_prodid = '$prodid' ");
            if ($q)
            {
                $_SESSION['success'] = 'Product has been updated successfully';
                echo '<script>location.replace("products");</script>';
            }
            else
            {
                $_SESSION['error'] = mysqli_error($dbc);
            }            
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
<li class="breadcrumb-item"aria-current="page">Home</li>
<li class="breadcrumb-item"aria-current="page">Products</li>
<li class="breadcrumb-item active" aria-current="page">Edit Product</li>
</ol>
</div>
</nav>

<section class="py-4 osahan-main-body shadow">
    <div class="container">
        <div class="row">
                <?php include 'include/sidebar.php';?>
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
                 <h4 class="mb-4 profile-title">Edit Products</h4>
                  
                    <div class="pick_today shadow-lg">
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
                        <div class="text-center">
                            <img src="../img/listing/<?php echo $row['clm_image'];?>" class="img-fluid item-img w-50 mb-3">
                        </div>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <label>Select Category</label>
                            <select required class="form-control" name="category">
                                <option value="<?php echo $row['clm_catid']; ?>"><?php echo $row1['clm_name']; ?></option>
                                <?php 
                                    $q2 = @mysqli_query($dbc, "SELECT * FROM tbl_category");
                                    while ($row2 = mysqli_fetch_array($q2))
                                    {
                                        echo '<option value="'.$row2['clm_catid'].'">'.$row2['clm_name'].'</option>';
                                    }
                                ?>
                            </select><br>
                            <label>Product Description</label>
                            <input required type="text" name="desc" placeholder="Product Description" class="form-control" value="<?php echo $row['clm_desc']; ?>"><br>
                            <label>Price</label>
                            <input required type="number" name="price" placeholder="Price" class="form-control" value="<?php echo $row['clm_price']; ?>"><br>                            
                            <label>Quantity</label>
                            <input required type="number" name="qty" placeholder="Quantity" class="form-control" value="<?php echo $row['clm_quantity']; ?>"><br>
                            <label>Change Product Image</label>
                            <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" id="customFile" name="img" onchange="displayImg(this,$(this))">
                            <label class="custom-file-label" for="customFile">Change Image (500x500 Pixels)</label>
                            <img src="" alt="" id="cimg">                            
                            <div>
                                <button name="updateBtn" type="submit" class="btn btn-dark" style="width: 100%"><b>UPDATE PRODUCT</b></button>
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

