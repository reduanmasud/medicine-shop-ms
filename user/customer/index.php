
  <?php
    $customer = new Customer($shop);

    if (isset($_POST['add_new_customer'])) {
        $uploadOk = 1;
        $fileEmpty = 1;
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
                array_pop($_POST);
                $_POST['profile_photo'] = $newfilename;
                $_POST['done'] = '';

                $customer->addCustomer($_POST);
            }
            else
            {
              echo 'Sorry, there was an error uploading your file.';
            }
            //
        } else if($fileEmpty){
          $customer->addCustomer($_POST);
        }

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
            <h2>Add Customer</h2>
          </div>


          <form autocomplete="off" method="post" action="" class="w3-container" enctype="multipart/form-data">
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
                <input type="file" accept="image/*;capture=camera" name="profile_photo" id="profile_photo" value="" class="w3-input w3-border">
            </p>
            <p>
              <button type="submit" name="add_new_customer" id="add_new_customer" class="w3-btn w3-blue-gray">Add Info</button>
            </p>
          </form>
        </div>


      </div>

      <div class="w3-col m8 mgt-10">
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
                    <td><?=$row['id']?></td>
                    <td><?=$row['first_name']?> <?=$row['last_name']?></td>
                    <td><?=$row['mobile']?></td>
                    <td>
                    <a href="customer.php?view&id=<?=$row['id']?>"><i class="fas fa-eye" style="color:#40AAF2;"></i></a>
                    <a href="customer.php?edit&id=<?=$row['id']?>"><i class="fas fa-edit" style="color:#FF9800;"></i></a>
                    <a href="customer.php?delete&id=<?=$row['id']?>"><i class="fas fa-trash-alt" style="color:#F44336;"></i></a>                  
                    </td>
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