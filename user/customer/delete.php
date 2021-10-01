
<?php
$single_customer = new SingleCustomer($shop, $_GET['id']);

if ($single_customer->isOwner() == false) {
    echo '<h2>Check Customer ID cearfully</h2>';
    exit;
}



if(isset($_POST['deleteDataSure']))
{
    if($single_customer->delete())
    {
        echo "<script>window.location.replace('customer.php');</script>";
    }

}
?>

<div class="w3-card-4 w3-dark-grey">

    <div class="w3-container w3-center">
        <h3>Want to delete?</h3>
        <img src="customer/images/<?=$single_customer->getProfileImage();?> " alt="Avatar" style="width:80%">
        <h5><?=$single_customer->getName();?></h5>
        <p>If you press on delete, All associated with the user will be deleted. There is no way to retrive that again. So be careful when you are deleting a customer.

        </p>
        <form method="post" >
            <button class="w3-button w3-green" onclick="window.location.replace('customer.php')">No</button>    
            <button class="w3-button w3-red" name="deleteDataSure">Yes, Delete</button>
        </form>
    </div>

</div>

<script>

</script>