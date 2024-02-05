
<form method = "POST" action = "function.php">
    <div id="dataModal" class="modal fade">  
        <div class="modal-dialog" id="modal-content">
        </div>  
    </div> 
</form>
<div id="data-content"></div>
<footer class="section-footer border-top "id="print" style="margin-top: 200px;">   

    <section class="footer-bottom border-top py-4 text-dark">
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
