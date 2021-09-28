<?php session_start(); ?>
<?php
require_once '../../config.php';
?>
<!doctype html>
<html>
    <head>
        <title></title>
    </head>

    <body>
    <style>
    
    .bl{
        border-left: none;
    }
    .br{
        border-right:none;
    }
    .bb{
        border-bottom:none;
    }
    #print{
        display: block;
        width: 300px;
    }
    @media print { 
    /* All your print styles go here */
     .print-hide{
         display: none;
     }
     @page { size:  auto; margin: 50px; }

    }
</style>


<div id="print">
    <table width="100%" id="dt_table" border="1" style="border-collapse: collapse;">
        <tr>
            <td colspan="4">
                <img src="https://www.kadencewp.com/wp-content/uploads/2020/10/alogo-2.png" width="60px" height="60px" alt="" style="float:left"/>
                <div style="float:left">
                <h3 style="margin-top: 2px; margin-bottom: 0px;" id="shopName"></h3>
                <small style="display:block; width:211px;" id="shopAddr"></small>
                </div>
                <div style="clear:both"></div>
                
            </td>
        </tr>
        <tr>
            <td id="mobileNumber" colspan="2"></td>
            <td id="sellDate" colspan="2"></td>
        </tr>
        <tr>
            <td colspan="3" id="customerID"></td>
            <td align="center"><div id="barCode"></div></td>
        </tr>
        <tr>
            <th colspan="2">Medicine name</th>
            <th>Qty.</th>
            <th>Cost</th>
        </tr>

    </table>
    <br>
    <br>
    <br>
    <div style="clear: both;"></div>
    <div style="float:right; padding: 0px 30px; border-top: 1px solid black;">
    Signeture
    </div>
    <div style="clear: both;"></div>

</div>

<button class="print-hide" onclick="print_close()">Print</button>
<button class="print-hide" onclick="window.close()">Close</button>

<script>
function print_close()
{
    window.print();
    window . close();
}

</script>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<?php

?>

<script>
$(document).ready(function(){
    let app = $("#print");
    let shopID = <?php echo $_GET['shopID'];?>;
    let invoiceID = <?php echo $_GET['invoiceID'];?>;
    let url = `http://<?=URL?>/API/Invoice.php?invoiceID=${invoiceID}&shopID=${shopID}`;
    let headers = {
        Authorization : "<?php echo 'Bearer ' . $_SESSION['hash']; ?>"
    };
    fetch(url,{
        method: "GET",
        headers: [
            ["Authorization" , "<?php echo 'Bearer ' . $_SESSION['hash']; ?>"]
        ]
    })
    .then(res => res.json())
    .then(data => {
        $("#shopName").text(data['shop_info'][0].shop_name);
        $("#mobileNumber").text(`Mob: ${data['shop_info'][0].shop_mobile}`);
        $("#sellDate").text(data[0].created_at);
        $("#shopAddr").text(data["shop_info"][0].shop_address);
        let bartext = data[0].customer_id;
        let len = bartext.toString().length;
        let str = '';
        for(var i = 0; i < 10-len; i++)
            str += '0';
        str += bartext;

        $("#barCode").html(`
        <img height="40px" src="https://barcode.tec-it.com/barcode.ashx?data=${str}&code=QRCode&multiplebarcodes=false&translate-esc=true&unit=Fit&dpi=96&imagetype=Gif&rotation=0&color=%23000000&bgcolor=%23ffffff&codepage=Default&qunit=Mm&quiet=0&hidehrt=False&dmsize=Default" >
        `);
        if(data[0].customer_id != null)
        {
            $("title").text(`${data[0].customer_id}00000#${data[0].id}`)
            $("#customerID").text(`Customer Name: ${data["customer"][0].first_name} ${data["customer"][0].last_name}`);
            
        }
        else
        {
            $("title").text(`##00000#${data[0].id}`)
            $("#customerID").text(`Customer Name: Unknown`);
        }
        
        $.each(data["medicines"], (key, val)=>{
            $("#dt_table").append(`
                <tr>
                    <td colspan="2">${val.brand_name} ${val.strength} </td>
                    <td>${val.quantity}</td>
                    <td>${val.cost}</td>
                </tr>
            `);
        })
        $("#dt_table").append(`
                <tr>
                    <th align="right" class="br" colspan="3"> Total  : </th>
                    <th class="bl">${data[0].total}</th>
                </tr>
                <tr>
                    <th align="right" class="br" colspan="3"> Discount  : </th>
                    <th class="bl">${data[0].discount} %</th>
                </tr>
                <tr>
                    <th align="right" class="br" colspan="3"> Sub-Total  : </th>
                    <th class="bl">${data[0].sub_total}</th>
                </tr>
                <tr>
                    <th align="right" class="br" colspan="3"> Paid  : </th>
                    <th class="bl">${data[0].paid}</th>
                </tr>
                <tr>
                    <th align="right" class="br" colspan="3"> Due  : </th>
                    <th class="bl">${data[0].due}</th>
                </tr>
            `);
        
        
        
        
    })
}
);

</script>

<?php

?>
    </body>
</html>
