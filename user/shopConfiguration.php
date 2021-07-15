<?php include "inc/header.php"; ?>
<?php include "inc/nav.php"; ?>



<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-cog"></i> Configure Your Shop</b></h5>
  
<?php
    $medicine = new Medicine();
    echo '<pre>';
        var_dump($medicine->getAllGenericName());
    echo '</pre>';
    
    
    if(isset($_POST["shop_configuration"]))
    {
        if($user->hasShop())
        {
            $shop->shopUpdate($_POST);
        }
        else
        {
            $shop->shopSetup($_POST);
        }
    }
?>

  </header>



  <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">

    <div class="w3-card-4">
    <div class="w3-container w3-teal">
    <h2>Configure</h2>
    </div>
    <form method="post" action="" class="w3-container">
        <p>
            <label class="w3-text-teal" for="shop_name">Shop Name</label>
            <input type="text" name="shop_name" id="shopt_name" class="w3-input w3-border" value = "<?php echo $shop->inputValue("shop_name");?>">
        </p>
        <p>
            <label class="w3-text-teal" for="shop_address">Shop Address</label>
            <input type="text" name="shop_address" id="shop_address" value = "<?php echo $shop->inputValue("shop_address");?>" class="w3-input w3-border">
        </p>
        <p>
            <label class="w3-text-teal" for="shop_mobile">Shop Mobile Number</label>
            <input type="text" name="shop_mobile" id="shop_mobile" value = "<?php echo $shop->inputValue("shop_mobile");?>"  class="w3-input w3-border">
        </p>
        <p>
            <label for="shop_logo">Shop LOGO</label>
            <input type="file" name="shop_logo" id="shopt_logo" class="w3-input w3-border">
        </p>
        <p>

            <button type="submit" name="shop_configuration" class="w3-btn w3-blue-gray">Save Information</button>
        </p>
    </form>
    </div>
    </div>
  </div>
  <hr>



  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">
    <h4>FOOTER</h4>
    <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
  </footer>

  <!-- End page content -->
</div>


<?php include "inc/footer.php"; ?>