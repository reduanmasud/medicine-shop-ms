<?php include 'inc/header.php'; ?>
<?php require_once '../classes/SingleCustomer.php';?>
<?php include 'inc/nav.php'; ?>


<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Customer</b></h5>
  </header>
  <!-- <pre>

  </pre> -->

  <?php if (isset($_GET['view']) && isset($_GET['id']) && !empty($_GET['id'])): ?>
    <!-- Customer View Option -->
    
      <?php include 'customer/view.php'; ?>

    <!-- [End] Customer View Option -->
  <?php elseif (isset($_GET['edit']) && isset($_GET['id']) && !empty($_GET['id'])): ?>
    <!-- Customer Edit Option -->

    <?php include 'customer/edit.php'; ?>

    <!-- [End] Customer Edit Option -->

  <?php elseif (isset($_GET['delete']) && isset($_GET['id']) && !empty($_GET['id'])): ?>
    <!-- Customer Delete Option -->
  
    <?php include 'customer/delete.php' ?>
    
    <!-- [End] Customer Delete Option -->
  <?php else: ?>
    <?php include 'customer/index.php'; ?>  
  <?php endif; ?>

  
  
  
  

  



  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">
    <h4>FOOTER</h4>
    <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
  </footer>

  <!-- End page content -->
</div>


<?php include 'inc/footer.php'; ?>