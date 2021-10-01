<?php
$single_customer = new SingleCustomer($shop, $_GET['id']);

if ($single_customer->isOwner() == false) {
    echo '<h2> Check Customer ID cearfully </h2>';
    exit;
}

if (isset($_POST['update_the_customer'])) {
    $uploadOk = 1;
    $fileEmpty = 1;

    $single_customer->setFirstName($_POST['first_name']);
    $single_customer->setLastName($_POST['last_name']);
    $single_customer->setMobile($_POST['mobile']);
    $single_customer->setAddress($_POST['address']);
    $single_customer->setRemark($_POST['remark']);

    $current_file = $single_customer->getProfileImage();
    if (!empty($_FILES['profile_photo']['name'])) {
        $fileEmpty = 0;
        $target_dir = 'customer/images/';
        $target_file = $target_dir . basename($_FILES['profile_photo']['name']);
        $file_name = explode('.', $_FILES['profile_photo']['name']);
        $newfilename = substr(md5(round(microtime(true))), 0, 10) . '.' . end($file_name);

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES['profile_photo']['tmp_name']);
        if ($check !== false) {
            // echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo 'File is not an image.';
            $uploadOk = 0;
        }

        if ($_FILES['profile_photo']['size'] > 5000000) {
            echo 'Sorry, your file is too large.';
            $uploadOk = 0;
        }

        if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif') {
            echo 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
            $uploadOk = 0;
        }
    }
    if ($uploadOk == 1 && $fileEmpty == 0) {
        if (move_uploaded_file($_FILES['profile_photo']['tmp_name'], $target_dir . $newfilename)) {
            if (!empty($current_file)) {
                unlink($target_dir . $current_file);
            }
            $single_customer->setProfileImage($newfilename);
        } else {
            echo 'Sorry, there was an error uploading your file.';
        }
        //
    }

    $single_customer->update();

    //
}

?>


<div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter mgb-10">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fas fa-pills w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $med->medicineCount();?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Total</h4>
      </div>
    </div>
    <div class="w3-quarter mgb-10">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fas fa-shopping-cart w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>99 $</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Total Sell (<small>Monthly</small>)</h4>
      </div>
    </div>
    <div class="w3-quarter mgb-10">
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
      <div class="w3-col m4 mgb-10">
        <div class="w3-card-4">
          <div class="w3-container w3-orange">
            <h2>Update Customer  
                <button class="w3-button w3-teal w3-tiny" onclick="window.location.replace('customer.php?view&id=<?=$single_customer->getId();?>')">View</button>
            </h2>
          </div>


          <form autocomplete="off" method="post" action="" class="w3-container" enctype="multipart/form-data">
            <p>
                <label class="w3-text-teal" for="first_name">First Name</label>
                <input type="text" name="first_name" value="<?=$single_customer->getFirstName();?>" id="first_name" class="w3-input w3-border" value="">
            </p>
            <p>
                <label class="w3-text-teal" for="last_name">Last Name</label>
                <input type="text" name="last_name" value=<?=$single_customer->getLastName();?> id="last_name" value="" class="w3-input w3-border">
            </p>
            <p>
                <label class="w3-text-teal" for="mobile">Mobile Number</label>
                <input type="text" name="mobile" value="<?=$single_customer->getMobile();?>" id="mobile" value="" class="w3-input w3-border">
            </p>
            <p>
                <label class="w3-text-teal" for="address">Address</label>
                <input type="text" name="address" id="address" value="<?=$single_customer->getAddress();?>" class="w3-input w3-border">
            </p>
            <p>
                <label class="w3-text-teal" for="remark">Remark</label>
                <input type="text" name="remark" id="remark" value="<?=$single_customer->getRemark();?>" class="w3-input w3-border">
            </p>
            <p>
                <label class="w3-text-teal" for="profile_photo">Profile Photo</label>
                <img src="customer/images/<?=$single_customer->getProfileImage();?>" alt="" width="200px">
                <input type="file" accept="image/*;capture=camera" name="profile_photo" id="profile_photo" value="" class="w3-input w3-border">
            </p>
            <p>
              <button type="submit" name="update_the_customer" id="update_the_customer" class="w3-btn w3-blue-gray">Update Information</button>
            </p>
          </form>
        </div>


      </div>

      <div class="w3-col m8 mgt-10">
        <div class="w3-card-4">
          

        
 
        </div>


      </div>

    </div>
  </div>