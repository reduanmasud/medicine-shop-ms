
<?php
$single_customer = new SingleCustomer($shop, $_GET['id']);

if ($single_customer->isOwner() == false) {
    echo '<h2>Check Customer ID cearfully</h2>';
    exit;
}

?>




<div class="w3-row w3-margin-bottom profile-section" style="margin-left: 8px; margin-right:8px;">
      <div class="w3-col m4 w3-card-4" >
        <div style="height:325px; overflow:hidden;">
        <img src="customer/images/<?php echo $single_customer->getProfileImage();?>" style="width:100%" alt="">
        </div>
        <h2 align="center"><?php echo $single_customer->getName();?></h2>
        
        <div class="w3-bar">
          <button class="w3-bar-item w3-button w3-teal" style="width:50%" onclick="window.location.replace('customer.php?edit&id=<?=$single_customer->getId();?>')">Edit</button>
          <button class="w3-bar-item w3-button w3-red" style="width:50%" onclick="window.location.replace('customer.php?delete&id=<?=$single_customer->getId();?>')">Delete</button>
        </div>
      </div>
      <div class="w3-col m8 pdl-0 mgl-0 component-2">
        <div class="w3-row w3-card-4 mgt-20 component-1">
          <div class="w3-col m12">
            <p><b>Address: </b> : <?php echo $single_customer->getAddress(); ?></p>
            <p><b>Mobile:</b> : <?php echo $single_customer->getMobile() ?> </p>
          </div>  
        </div>

        <div class="w3-row" style="margin-bottom: 10px;">
          <div class="w3-col m6 pdr-8-0">
            <div class="w3-container w3-card-4 w3-red w3-padding-16">
              <div class="w3-left"><i class="fas fa-hand-holding-usd w3-xxxlarge"></i></div>
              <div class="w3-right">
                <h3><?php echo $single_customer->getDue();?></h3>
              </div>
              <div class="w3-clear"></div>
              <h4>Total due</h4>
            </div>
          </div>
          <div class="w3-col m6 pdl-8-0">
          <div class="w3-container w3-card-4 w3-green w3-padding-16">
            <div class="w3-left"><i class="fas fa-money-bill w3-xxxlarge"></i></div>
              <div class="w3-right">
                <h3><?php echo $single_customer->getPaid();?></h3>
              </div>
              <div class="w3-clear"></div>
              <h4>Total Paid</h4>
            </div>

          </div>
        </div>

        <div class="w3-row">
          <div class="w3-col m6 pdr-8-0">
            <div class="w3-container w3-card-4 w3-teal w3-padding-16">
              <div class="w3-left"><i class="fas fa-money-bill-alt w3-xxxlarge"></i></div>
              <div class="w3-right">
                <h3><?php echo $single_customer->getTotalBuy();?></h3>
              </div>
              <div class="w3-clear"></div>
              <h4>Total Buy</h4>
            </div>
          </div>
          <div class="w3-col m6 pdl-8-0">
          <div class="w3-container w3-card-4 w3-blue w3-padding-16">
            <div class="w3-left"><i class="fas fa-pills w3-xxxlarge"></i></div>
              <div class="w3-right">
                <h3><?php echo $single_customer->getUniqueMedicineNumber();?></h3>
              </div>
              <div class="w3-clear"></div>
              <h4># Unique Med</h4>
            </div>

          </div>
        </div>

      </div>
    </div>