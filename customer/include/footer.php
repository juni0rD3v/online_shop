
<form method = "POST" action = "function.php">
    <div id="dataModal" class="modal fade">  
        <div class="modal-dialog" id="modal-content">
        </div>  
    </div> 
</form>
<div id="data-content"></div>
<footer class="section-footer border-top text-dark" style="margin-top: 100px;">
<?php
  $q_setup = @mysqli_query($dbc, "SELECT * FROM tbl_setup");
  $row_setup = mysqli_fetch_array($q_setup);
?>

<section class="footer-main border-top pt-5 pb-4 text-dark" >
<div class="container">
<div class="row">
<aside class="col-md">
<h6 class="title">Customer Service</h6>
<ul class="list-unstyled list-padding">
    <li> <a class="text-dark">Contact Us</a></li>
    <li> <a class="text-dark">Hotline: <?php echo $row_setup['clm_hotline']; ?></a></li>
    <li> <a class="text-dark">Email: <?php echo $row_setup['clm_email']; ?></a></li>
</ul>
</aside>
<aside class="col-md">
<h6 class="title">About Kimson</h6>
<ul class="list-unstyled list-padding">
    <li> <a href="aboutus" class="text-dark">About Us</a></li>
</ul>
</aside>
<aside class="col-md">
<h6 class="title">Payment</h6>
<ul class="list-unstyled list-padding">
<li> <a class="text-dark"><?php echo $row_setup['clm_payment']; ?></a></li>
</ul>
</aside>
<aside class="col-md">
<h6 class="title">Follow us</h6>
<ul class="list-unstyled list-padding">
<li> <a class="text-dark" href="<?php echo $row_setup['clm_fb']; ?>"> <i class="icofont-facebook"></i> Facebook</a></li>
<li> <a class="text-dark" href="<?php echo $row_setup['clm_twitter']; ?>"> <i class="icofont-twitter"></i> Twitter</a></li>
<li> <a class="text-dark" href="<?php echo $row_setup['clm_instagram']; ?>"> <i class="icofont-instagram"></i> Instagram</a></li>
</ul>
</aside>
 </div>
</div>
</section>

<section class="footer-bottom border-top py-4">
<div class="container">
<div class="row">
<div class="col-md-6">
<span class="pr-2">© 2023 Kimson Online Shopping</span>
</div>
<div class="col-md-6 text-md-right">
</div>
</div>

</div>

</section>
</footer>
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../vendor/slick/slick.min.js"></script>
<script src="../vendor/sidebar/hc-offcanvas-nav.js"></script>
<script>
  $(document).ready(function(){
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>

</body>
</html>
