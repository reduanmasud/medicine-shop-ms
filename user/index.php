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
    <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
  </header>

  <input type="text" name="" id="" value="<?php echo $_SESSION['hash'];?>">
  <pre>
  <?php

    //var_dump($shop->getId());
    //var_dump($med->medicineCount());
    //var_dump($_SESSION["hash"]);

    if (isset($_POST['sell'])) {
        var_dump($shop->sell($_POST));
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
          <div class="w3-container w3-teal">
            <h2>Sell Medicine</h2>
          </div>


          <form autocomplete="off" method="post" action="" class="w3-container">
            <p>
              <label class="w3-text-teal" for="brand_name">Medicine Brand Name</label>
              <input type="hidden" name="med_id" id="medicineId" value="">
              <input type="hidden" name="med_id" id="medicinePrice" value="">
              <div class="autocomplete" style="width:100%;">
                <input type="text" name="brand_name" id="medicineName" class="w3-input w3-border" value="">
              </div>
            </p>
            <p>
              <label class="w3-text-teal" for="quantity">Quantity</label>
              <input type="text" name="quantity" id="medicineQuantity" value="" class="w3-input w3-border">
            </p>
            <p>

              <button type="submit" name="add_to_list" id="add_to_list" class="w3-btn w3-blue-gray">Add to list</button>
            </p>
          </form>
        </div>


      </div>

      <div class="w3-col m8">
        <div class="w3-card-4">
          <div class="w3-container w3-teal">
            <h2>Medicine List</h2>
          </div>
          
          <form autocomplete="off" method="post" id="sellMedForm" action="" class="w3-container">
          
            <table class="w3-table w3-bordered" style="overflow:hidden">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Medicine Name</th>
                  <th>Quantity</th>
                  <th>Price</th>
                </tr>
              </thead>

              <tbody id="tBodyList">
              
              </tbody>

            </table>
            <hr>
            <p>Total Cost: <span id="total_price"></span>
            <div class="toggle_unknown">
              <!-- Rounded switch -->
              <label class="switch">
                <input id="togglw_unknown_box" type="checkbox" default="false">
                <span class="slider round"></span>
                
              </label>
              <span style="margin-top:20px;" id="status">Unknown</span>
            </div>
            <hr>
            <div class="customar_wraper" id="customer_section">

            </div>

            <div class=""  id="discount" >
              <label class="w3-text-teal" for="discount">Discount</label>
              <input type="text" name="discount" id="discountInp" onClick="this.select();" onkeyup="changeTotalPriceAfterDiscount()" class="w3-input w3-border" value="00">
            </div>
            <div>
              Total : <span id="total_after_discount"></span>
            </div>
            <div class="" id="paid">
              <label class="w3-text-teal" for="paid">Paid</label>
              <input type="text" name="paid" id="paidInp" onClick="this.select();" onkeyup="changeDueAfterPaid()" class="w3-input w3-border" value="00">
            </div>
            <div>
              Due : <span id="due_after_paid"></span>
            </div>
            <input type="submit" value="Submit" name="sell"/>
          </form>
        </div>


      </div>

    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>General Stats</h5>
    <p>New Visitors</p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-green" style="width:25%">+25%</div>
    </div>

    <p>New Users</p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-orange" style="width:50%">50%</div>
    </div>

    <p>Bounce Rate</p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-red" style="width:75%">75%</div>
    </div>
  </div>
  <hr>

  <div class="w3-container">
    <h5>Countries</h5>
    <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
      <tr>
        <td>United States</td>
        <td>65%</td>
      </tr>
      <tr>
        <td>UK</td>
        <td>15.7%</td>
      </tr>
      <tr>
        <td>Russia</td>
        <td>5.6%</td>
      </tr>
      <tr>
        <td>Spain</td>
        <td>2.1%</td>
      </tr>
      <tr>
        <td>India</td>
        <td>1.9%</td>
      </tr>
      <tr>
        <td>France</td>
        <td>1.5%</td>
      </tr>
    </table><br>
    <button class="w3-button w3-dark-grey">More Countries  <i class="fa fa-arrow-right"></i></button>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Recent Users</h5>
    <ul class="w3-ul w3-card-4 w3-white">
      <li class="w3-padding-16">
        <img src="http://via.placeholder.com/35" class="w3-left w3-circle w3-margin-right" style="width:35px">
        <span class="w3-xlarge">Mike</span><br>
      </li>
      <li class="w3-padding-16">
        <img src="http://via.placeholder.com/35" class="w3-left w3-circle w3-margin-right" style="width:35px">
        <span class="w3-xlarge">Jill</span><br>
      </li>
      <li class="w3-padding-16">
        <img src="http://via.placeholder.com/35" class="w3-left w3-circle w3-margin-right" style="width:35px">
        <span class="w3-xlarge">Jane</span><br>
      </li>
    </ul>
  </div>
  <hr>

  <div class="w3-container">
    <h5>Recent Comments</h5>
    <div class="w3-row">
      <div class="w3-col m2 text-center">
        <img class="w3-circle" src="http://via.placeholder.com/96" style="width:96px;height:96px">
      </div>
      <div class="w3-col m10 w3-container">
        <h4>John <span class="w3-opacity w3-medium">Sep 29, 2014, 9:12 PM</span></h4>
        <p>Keep up the GREAT work! I am cheering for you!! Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
          do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><br>
      </div>
    </div>

    <div class="w3-row">
      <div class="w3-col m2 text-center">
        <img class="w3-circle" src="http://via.placeholder.com/96" style="width:96px;height:96px">
      </div>
      <div class="w3-col m10 w3-container">
        <h4>Bo <span class="w3-opacity w3-medium">Sep 28, 2014, 10:15 PM</span></h4>
        <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><br>
      </div>
    </div>
  </div>
  <br>
  <div class="w3-container w3-dark-grey w3-padding-32">
    <div class="w3-row">
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-green">Demographic</h5>
        <p>Language</p>
        <p>Country</p>
        <p>City</p>
      </div>
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-red">System</h5>
        <p>Browser</p>
        <p>OS</p>
        <p>More</p>
      </div>
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-orange">Target</h5>
        <p>Users</p>
        <p>Active</p>
        <p>Geo</p>
        <p>Interests</p>
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
// $("#sellMedForm").submit(function(){
//   $("#")
// });
      const customerSection = document . getElementById('customer_section');
      
      const toggleSwitch = document . getElementById('togglw_unknown_box');
      
      toggleSwitch.addEventListener("click", e => {
        //console . log(e.target);
        const html = document . createElement("div");
        const customerSection = document . getElementById('customer_section');
        html.innerHTML = customerSection.innerHTML;
        html.innerHTML = `
        <p>
          <label class="w3-text-teal" for="quantity">Customer Name</label>
          <div class="autocomplete" style="width:100%;">
            <input type="text" name="customer_full_name" id="autoComplete" class="w3-input w3-border" value="">
          </div>
        </p>
        <p>
          <label class="w3-text-teal" for="quantity">Customer ID</label>
          <div class="customerID" style="width:100%;">
            <input type="text" name="customer_id" id="customer_id" class="w3-input w3-border" value="">
          </div>
        </p>
        
        `;
        
        if(e.target.checked == true){
          console . log(e);
            document.getElementById("status").innerHTML = "Enter Customer";
            const customerSection = document . getElementById('customer_section');
            customerSection.appendChild(html);
            const autoCompleteJS = new autoComplete({
            //selector: "#autoComplete",
            placeHolder: "Search for Customer...",
            data: {
                src: async (query) => {
                  try {
                    const source = await fetch("http://<?=URL?>/API/Customer.php?shopID=<?=$_SESSION['id']?>", {
                      method: "GET",
                      headers : [
                        ["Authorization", "<?php echo 'Bearer ' . $_SESSION['hash']; ?>"]
                      ]
                    });
                    const data = await source.json();

                    return data;
                  } catch (error) {

                    return error;
                  }
                },
                keys : ["name","mobile"],
                cache: true,
            },
            resultsList: {
                element: (list, data) => {
                    if (!data.results.length) {
                        // Create "No Results" message element
                        const message = document.createElement("div");
                        // Add class to the created element
                        message.setAttribute("class", "no_result");
                        // Add message text content
                        message.innerHTML = `<span>Found No Results for "${data.query}"</span>`;
                        // Append message element to the results list
                        list.prepend(message);
                    }
                },
                noResults: true,
            },
            resultItem: {
              element:(item, data) =>{
                item.style=`
                display:flex;
                flex-direction:row;
                flex-wrap: wrap;
                justify-content: start;
                `;
                
                if(data.key == "mobile"){
                  item.innerHTML = `
                    <img class="w3-rounded" src="https://via.placeholder.com/70"/>
                    <div class="info" style="margin-left:5px;">
                      <div class="w3-text-indigo">${data.value.name} <small>(#${data.value.id})</small></div>
                      <div class="w3-text-indigo">${data.match}</div>
                      <div class="w3-text-teal">50$</div>
                    </div>
                    `;
                }
                else
                {
                  item.innerHTML = `
                    <img class="w3-rounded" src="https://via.placeholder.com/70"/>
                    <div class="info" style="margin-left:5px;">
                      <div class="w3-text-indigo">${data.match} <small>(#${data.value.id})</small></div>
                      <div class="w3-text-indigo">${data.value.mobile}</div>
                      <div class="w3-text-teal">50$</div>
                    </div>
                    `;
                }
               
              },
              highlight: true
            },
            events: {
                input: {
                    selection: (event) => {
                        const customer_id_field = document . getElementById('customer_id');
                        const selection = event.detail.selection.value;
                        autoCompleteJS.input.value = `${selection.name} (#${selection.id})`;
                        customer_id_field.value = selection.id;
                    }
                }
            }
        });
           
        }
        else
        {
          customerSection . removeChild(customerSection .children[0]);
          document.getElementById("status").innerHTML = "Unknown";
        }
      });
      

      function changeDueAfterPaid()
      {
        let paidValue = document . getElementById('paidInp');
        let dueElement = document.getElementById("due_after_paid");

        if(paidValue.value < 0 || isNaN(paidValue.value))
        {
          paidValue .style.backgroundColor = "red";
          let btn = document.querySelector("#sellMedForm > input[type=submit]");
          btn.disabled = true;
          btn . classList . add("w3-btn");
          btn . classList . add('w3-disabled');
          
        }
        else
        {
          paidValue.style.backgroundColor ="transparent";
          let btn = document.querySelector("#sellMedForm > input[type=submit]");
          btn.disabled = false;
          btn . classList . remove("w3-btn");
          btn . classList . remove('w3-disabled')
          setDueAfterPaid();
          
        }
        
      }

      document.getElementById("paidInp").addEventListener("change",(inp)=>{
     

        if(inp.target.value == "") inp.target.value = 0;
      });

      function setDueAfterPaid()
      {
        let paid = document . getElementById('paidInp');
        let totalPrice = document.getElementById("total_after_discount");
        let due = document.getElementById("due_after_paid");
        if(paid.value > 0)
        {
          due.innerHTML = Number.parseFloat(totalPrice.innerHTML) - paid.value;
        }
        else
        {
          due.innerHTML = Number.parseFloat(totalPrice.innerHTML)
        }
      }


      function changeTotalPriceAfterDiscount(){
        const discountElm = document . getElementById('discountInp');
        if(discountElm.value == "")
          discountElm.value = 0;
        
        let subTotalPrice = document . getElementById('total_price').innerHTML;
        
        subTotalPrice = Number.parseFloat(subTotalPrice);
        
        if(discountElm.value == 0)
        {
          setTotalPrice(subTotalPrice);
        }
        else
        {
          let a = parseFloat((subTotalPrice * discountElm.value) / 100);
          
          setTotalPrice(subTotalPrice - a);
        }
        
        setDueAfterPaid();
      }
     
      function setTotalPrice(price)
      {
        const item = document . getElementById('total_after_discount');
        
          item.innerHTML = price;
        
      }

      function changePrice(numItem)
      {

        let price = document.getElementById(`unit_price_${numItem}`).value;
        let change = document.getElementById(`t_quantity_${numItem}`);
        if(change.value == "") change.value = 0;
        document.getElementById(`t_price_${numItem}`).value = parseFloat(price) * parseFloat(change.value);
        calculateTotalPrice(numItem);
      }

      function calculateTotalPrice(numItem)
      {
        var sum = 0;
        for (let i = 1; i <= numItem; i++) {
          sum += parseFloat(document.getElementById(`t_price_${i}`).value);
        }

        document.getElementById("total_price").innerHTML = sum;
        const elm = document . getElementById('discountInp') . value;
        
        if(elm == 0 || elm == "")
            setTotalPrice(sum);
        else
            setTotalPrice(sum - (sum * elm / 100));

            setDueAfterPaid();
      }

    function addMedicineToList(inp){

      let medicineID, medicineName, medicineQuantity, medicinePrice;
      let numItem = 0;
      let total_price = 0;
      inp.addEventListener("click", e => {
          e . preventDefault();
          medicineID = document.getElementById("medicineId");
          medicineName = document.getElementById("medicineName");
          medicineQuantity = document.getElementById("medicineQuantity");
          medicinePrice = document.getElementById("medicinePrice");

          if(medicineName.value.trim() == "") 
          {
            alert('Medicine Name Field cannot be empty');

            return false;
          }
          if(medicineQuantity.value.trim() == "") 
          {
            alert('Quantity Field cannot be empty');

            return false;
          }
          
          numItem++;
          let price = medicinePrice.value * medicineQuantity.value;
          total_price += price;
          let html  = `<tr>`;
          html += `<td> ${numItem} </td>
                  <td> <input typt="text"disabled name="brand_name[]" value="${medicineName.value}" > </td>
                  <td> <input type="hidden" name="med_id[]" value ="${medicineID.value}"/><input typt="number" onKeyUp="changePrice(${numItem})" onChange="changePrice(${numItem})" name="quantity[]" id="t_quantity_${numItem}" value="${medicineQuantity.value}" > </td>
                  <td> <input typt="text" disabled id="t_price_${numItem}" name="tprice[]" value="${price}" style="width:70%"> <input type="hidden" id="unit_price_${numItem}" value="${medicinePrice.value}"></td>     
          `;
          html += `</tr>`;
          let row  = document.getElementById("tBodyList").insertRow();
          row.innerHTML = html;
          calculateTotalPrice(numItem);
          medicineName.value = "";
          medicineQuantity.value = "";
      });

      

    }

    addMedicineToList(document . getElementById("add_to_list"));
    
    function autocomplete(inp, arr) {
        let id = document.getElementById("medicineId");
        let pirce = document.getElementById("medicinePrice");
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
                    b = document.createElement("div");
                    b.innerHTML = "<strong>" + medName.substr(0, val.length) + "</strong>";
                    b.innerHTML += medName.substr(val.length);
                    b.innerHTML +=
                        `  <span style="color:red"> ( ${arr[i]["dosage_form"]} ) </span>
                          <span style="color:green;weigth:bold"> Price: ( ${arr[i]["unit_price"]}/= ) </span>
                        `;
                    b.innerHTML += `<br>${arr[i]["manufactured_by"]}</br>`
                    b.innerHTML += `<input type = 'hidden' value = '${medName}' >`;
                    b.innerHTML += `<input type = 'hidden' value = '${arr[i]["id"]}' >`;
                    b.innerHTML += `<input type = 'hidden' value = '${arr[i]["unit_price"]}' >`;
                    b.addEventListener("click", function (e) {
                        inp.value = this.getElementsByTagName("input")[0].value;
                        id.value = this.getElementsByTagName("input")[1].value;
                        pirce.value = this.getElementsByTagName("input")[2].value;
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
    fetch("http://<?=URL?>/API/Medicine.php?shopID=<?=$_SESSION['id']?>", {
                      method: "GET",
                      headers : [
                        ["Authorization", "<?php echo 'Bearer ' . $_SESSION['hash']; ?>"]
                      ]
                    })
        .then(response => response.json())
        .then(data => {
            //console . log(data);
            //medicines = data;
            autocomplete(document.getElementById('medicineName'), data);

        });

    //var countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Turks & Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];
</script>
<?php include 'inc/footer.php'; ?>
<script>
        const customer_id_field = document . getElementById('customer_id');
        if(customer_id_field != null)
        {
          customer_id_field . addEventListener('keyup', e => {
          console . log(e.srcElement.value);
            try {
                    fetch(`http://<?=URL?>/API/Customer.php?shopID=<?=$_SESSION['id']?>&csID=${e.srcElement.value}`, {
                      method: "GET",
                      headers : [
                        ["Authorization", "<?php echo 'Bearer ' . $_SESSION['hash']; ?>"]
                      ]
                    })
                    .then(res => res.json())
                    .then(data => {
                      console . log(data.length);
                      if(data.length > 0)
                        document.getElementById("autoComplete").value= data[0].name;
                      else
                        document.getElementById("autoComplete").value = "";
                    })
                  } catch (error) {

                    return error;
                  }
          
        });
        }
        
</script>