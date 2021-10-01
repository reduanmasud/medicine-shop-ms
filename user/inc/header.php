<?php session_start(); ?>
<?php
    require_once '../config.php';
    require_once '../classes/User.php';
    include_once '../classes/DBConnect.php';
    require_once '../classes/Shop.php';
    require_once '../classes/Medicine.php';
    require_once '../classes/SoldMedicine.php';
    require_once '../classes/Shopmed.php';
    require_once '../classes/Customer.php';
    include_once 'functions.php';
    checkLoggedin();
    $user->setBySession($_SESSION['id']);
    $shop = new Shop($user->getUser());
    $med = new Shopmed($user, $shop);

?>
<!DOCTYPE html>
<html>
    <head>
    <title>W3.CSS Template</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/w3-css/4.1.0/w3.min.css" integrity="sha512-Z6UIAdEZ7JNzeX5M/c5QZj+oqbldGD+E8xJEoOwAx5e0phH7kdjsWULGeK5l2UjehKtChHDaUY2rQAF/NEiI9w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.1.4/dist/css/autoComplete.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.1.5/dist/css/autoComplete.02.min.css">

    <style>
    html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
    .autoComplete_wrapper {
        display: block !important;
        position: relative;
    }


    /** toggle switch */
    /* The switch - the box around the slider */
    .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {
    opacity: 0;
    width: 0;
    height: 0;
    }

    /* The slider */
    .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
    }

    .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
    }

    input:checked + .slider {
    background-color: #2196F3;
    }

    input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
    border-radius: 34px;
    }

    .slider.round:before {
    border-radius: 50%;
    }
    </style>
    <style>
  .component-1{
    padding: 8px; margin-bottom: 10px;
  }

  .component-2{
    padding-left: 15px;
  }

  .pdr-8-0{
    padding-right: 8px;
  }
  .pdl-8-0{
    padding-left: 8px;
  }
  @media screen and (max-width: 600px) {
    .component-2{
      padding-left: 0px;
      margin-top: 20px;
    }
    .mgb-10{
      margin-bottom: 10px;
    }
    .mgt-10{
      margin-top:10px;
    }

    .mgl-0{
      margin-left: 0px;
    }

    .pdl-0{
      padding-left: 0px;
    }

    .pdr-8-0{
      padding-right: 0px;
      margin-bottom: 10px;
    }
    .pdl-8-0{
    padding-left: 0px;
    }



  }
</style>
    </head>
<body class="w3-light-grey">