<?php include 'inc/header.php'; ?>
<?php include 'inc/nav.php'; ?>
<style>
    .autocomplete {
        position: relative;
        display: inline-block;
    }


    input {
        border: 1px solid transparent;
        background-color: #f1f1f1;
        padding: 10px;
        font-size: 16px;
    }

    input[type=text] {
        background-color: #f1f1f1;
        width: 100%;
    }

    input[type=submit] {
        background-color: DodgerBlue;
        color: #fff;
        cursor: pointer;
    }

    .autocomplete-items {
        position: absolute;
        border: 1px solid #d4d4d4;
        border-bottom: none;
        border-top: none;
        z-index: 99;
        /*position the autocomplete items to be the same width as the container:*/
        top: 100%;
        left: 0;
        right: 0;
    }

    .autocomplete-items div {
        padding: 10px;
        cursor: pointer;
        background-color: #fff;
        border-bottom: 1px solid #d4d4d4;
    }

    /*when hovering an item:*/
    .autocomplete-items div:hover {
        background-color: #e9e9e9;
    }

    /*when navigating through the items using the arrow keys:*/
    .autocomplete-active {
        background-color: DodgerBlue !important;
        color: #ffffff;
    }
</style>


<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

    <!-- Header -->
    <header class="w3-container" style="padding-top:22px">
        <h5><b><i class="fa fa-cog"></i> Add Medicine</b></h5>

        <?php

            // echo '<pre>';
            // var_dump();
            // echo '</pre>';
        if(isset($_POST['add_medicine'])){
            $medID = $_POST['med_id'];
            
            $quantity = $_POST['quantity'];
            
             if($med->addMedicineToShop($medID, $quantity))
             {
                // echo '<script> window.location.reload() </script>';
                echo '<font color="green"> Added </font>';
             }
             else
             {
                 echo `<font color="red"> There is some Problem </font>`;
             }
        }


        ?>

    </header>
    


    <div class="w3-panel">
        <div class="w3-row-padding" style="margin:0 -16px">

            <div class="w3-row-padding">
                <div class="w3-col m4">
                    <div class="w3-card-4">
                        <div class="w3-container w3-teal">
                            <h2>Add Medicine</h2>
                        </div>


                        <form autocomplete="off" method="post" action="" class="w3-container">
                            <p>
                                <label class="w3-text-teal" for="brand_name">Medicine Brand Name</label>
                                <input type="hidden" name="med_id" id="med_id" value="">
                                <div class="autocomplete" style="width:100%;">
                                    <input type="text" name="brand_name" id="brand_name" class="w3-input w3-border"
                                        value="">
                                </div>
                            </p>
                            <p>
                                <label class="w3-text-teal" for="quantity">Quantity</label>
                                <input type="text" name="quantity" id="quantity" value="" class="w3-input w3-border">
                            </p>
                            <p>

                                <button type="submit" name="add_medicine" class="w3-btn w3-blue-gray">Add
                                    Medicine</button>
                            </p>
                        </form>
                    </div>


                </div>

                <div class="w3-col m8">
                    <div class="w3-card-4">
                        <div class="w3-container w3-brown">
                            <h2>Histroy</h2>
                        </div>
                        <div class="w3-margin-top w3-margin-bottom w3-padding-small">
                        <table id="historyTable" class="display " style="width:100%">
                            <thead>
                                <tr>
                                    <th>Brand Name</th>
                                    <th>Quantity</th>
                                    <th>Company</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($med->addMedicineHistory() as $row) { ?>
                                <tr>
                                    <td><?=$row["brand_name"]?> <?=$row["strength"]?></td>
                                    <td><?=$row["quantity"]?></td>
                                    <td><?=$row["manufactured_by"]?></td>
                                    <td><?=$row["added_time"]?></td>
                                </tr>
                                <?php } ?>

                                
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Brand Name</th>
                                    <th>Quantity</th>
                                    <th>Company</th>
                                    <th>Date</th>
                                </tr>
                            </tfoot>
                        </table>
                        </div>

                    </div>
                </div>
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

<script>
    function autocomplete(inp, arr) {
        let id = document.getElementById("med_id");
        var currentFocus;
        inp.addEventListener("input", function (e) {
            var a, b, i, val = this.value;
            closeAllLists();
            if (!val) {
                return false
            };

            currentFocus = -1;

            a = document.createElement("div");
            a.setAttribute("id", this.id + " autocomplete-list");
            a.setAttribute('class', 'autocomplete-items');
            this.parentNode.appendChild(a);

            for (i = 0; i < arr.length; i++) {
                //console . log(val . toUpperCase());
                //console . log(arr[i]['brand_name'] . substr(0, val . length) . toUpperCase());
                let medName = arr[i]["brand_name"].concat(" ").concat(arr[i]["strength"]);
                if (medName.substr(0, val.length).toUpperCase().trimStart() == val.toUpperCase()) {
                    console.log(val.toUpperCase());
                    b = document.createElement("div");
                    b.innerHTML = "<strong>" + medName.substr(0, val.length) + "</strong>";
                    b.innerHTML += medName.substr(val.length);
                    b.innerHTML +=
                        `  <span style="color:red"> ( ${arr[i]["dosage_form"]} ) </span>`;
                    b.innerHTML += `<br>${arr[i]["manufactured_by"]}</br>`
                    b.innerHTML += `<input type = 'hidden' value = '${medName}' >`;
                    b.innerHTML += `<input type = 'hidden' value = '${arr[i]["id"]}' >`;
                    b.addEventListener("click", function (e) {
                        inp.value = this.getElementsByTagName("input")[0].value;
                        id.value = this.getElementsByTagName("input")[1].value;
                        closeAllLists();
                    });
                    a.appendChild(b);
                }
            }
        });


        inp.addEventListener("keydown", function (e) {
            let x = document.getElementById(this.id + " autocomplete-list");
            if (x) {
                x = x.getElementsByTagName("div");
            }

            if (e.keyCode == 40) {
                currentFocus++;
                addActive(x);
            } else if (e.keyCode == 38) {
                currentFocus--;
                addActive(x);
            } else if (e.keyCode == 13) {
                e.preventDefault();
                if (currentFocus > -1) {
                    if (x) {
                        x[currentFocus].click();
                    }
                }
            }
        });

        function addActive(x) {
            if (!x) {
                return false;
            }
            removeActive(x);

            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            x[currentFocus].classList.add('autocomplete-active');
        }

        function removeActive(x) {
            for (var i = 0; i < x.length; i++) {
                x[i].classList.remove('autocomplete-active');
            }
        }

        function closeAllLists(elm) {
            let x = document.getElementsByClassName("autocomplete-items");
            for (let i = 0; i < x.length; i++) {
                if (elm != x[i] && elm != inp) {
                    x[i].parentNode.removeChild(x[i]);
                }
            }
        }

        document.addEventListener("click", function (e) {
            closeAllLists(e.target);
        });
    }

    var medicines;
    fetch("http://<?=URL?>/API/Medicine.php?AddMedInfo=1&shopID=<?=$shop->getId()?>", {
                      method: "GET",
                      headers : [
                        ["Authorization", "<?php echo 'Bearer ' . $_SESSION['hash']; ?>"]
                      ]
                    })
        .then(response => response.json())
        .then(data => {
            // console . log(data);
            //medicines = data;
            autocomplete(document.getElementById('brand_name'), data);

        });

    //var countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Turks & Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];
</script>
<?php include 'inc/footer.php'; ?>