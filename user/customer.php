<?php include 'inc/header.php'; ?>
<?php include 'inc/nav.php'; ?>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Customer</b></h5>
  </header>
  <pre>
  <?php
    $customer = new Customer($shop);
    if (isset($_POST['add_new_customer'])) {
         $customer->addCustomer($_POST);
    }

  ?>
  </pre>
  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fas fa-pills w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $med->medicineCount();?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Total</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fas fa-shopping-cart w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>99 $</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Total Sell (<small>Monthly</small>)</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fas fa-hand-holding-usd w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>23 $</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Cash (<small>Monthly</small>)</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fas fa-money-check-alt w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>50 $</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Total Due</h4>
      </div>
    </div>
  </div>

  <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
      <div class="w3-col m4">
        <div class="w3-card-4">
          <div class="w3-container w3-orange">
            <h2>Sell Medicine</h2>
          </div>


          <form autocomplete="off" method="post" action="" class="w3-container">
            <p>
                <label class="w3-text-teal" for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" class="w3-input w3-border" value="">
            </p>
            <p>
                <label class="w3-text-teal" for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" value="" class="w3-input w3-border">
            </p>
            <p>
                <label class="w3-text-teal" for="mobile">Mobile Number</label>
                <input type="text" name="mobile" id="mobile" value="" class="w3-input w3-border">
            </p>
            <p>
                <label class="w3-text-teal" for="address">Address</label>
                <input type="text" name="address" id="address" value="" class="w3-input w3-border">
            </p>
            <p>
                <label class="w3-text-teal" for="remark">Remark</label>
                <input type="text" name="remark" id="remark" value="" class="w3-input w3-border">
            </p>
            <p>
                <label class="w3-text-teal" for="profile_photo">Profile Photo</label>
                <input type="file" name="profile_photo" id="profile_photo" value="" class="w3-input w3-border">
            </p>
            <p>
              <button type="submit" name="add_new_customer" id="add_new_customer" class="w3-btn w3-blue-gray">Add Info</button>
            </p>
          </form>
        </div>


      </div>

      <div class="w3-col m8">
        <div class="w3-card-4">
          <div class="w3-container w3-orange">
            <h2>Customer List</h2>
          </div>


          
          <?php
           $all_customer = $customer->getAllCustomers();
          ?>
            <div class="w3-margin-top w3-margin-bottom w3-padding-small">
            <table id="customerListTable" class="display" style="width:100%">
              <thead>
                <tr>
                  <th>#ID</th>
                  <th>Full Name</th>
                  <th>Mobile</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($all_customer as $row) { ?>
                    <tr>
                    <td><?=$row["id"]?></td>
                    <td><?=$row["first_name"]?> <?=$row["last_name"]?></td>
                    <td><?=$row["mobile"]?></td>
                    <td>EDIT|DELETE</td>
                    </tr>
                <?php } ?>
              </tbody>
              <tfoot>
              <tr>
                  <th>#ID</th>
                  <th>Full Name</th>
                  <th>Mobile</th>
                  <th>Action</th>
                </tr>
              
              </tfoot>
            </table>
            </div>
 
        </div>


      </div>

    </div>
  </div>
 
  
  

  
  
  
  

  



  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">
    <h4>FOOTER</h4>
    <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
  </footer>

  <!-- End page content -->
</div>

<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

</script>
<?php include 'inc/footer.php'; ?>