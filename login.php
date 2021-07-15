
<?php
    session_start();
    require_once 'config.php';
    require_once 'functions.php';
    require_once 'classes/User.php';
    require_once 'classes/DBConnect.php';
    // generate json web token

    include_once 'libs/php-jwt-master/src/BeforeValidException.php';
    include_once 'libs/php-jwt-master/src/ExpiredException.php';
    include_once 'libs/php-jwt-master/src/SignatureInvalidException.php';
    include_once 'libs/php-jwt-master/src/JWT.php';
    use \Firebase\JWT\JWT;

    if(isLoggedIn())
    {
        header('Location: user/');
    }


    if (isset($_POST['login'])) {
        //var_dump($_POST);
        $loggedIn = $user->login($_POST['email'], $_POST['password']);

        if ($loggedIn) {

            $issuedAt = new DateTimeImmutable();
            $expire = $issuedAt->modify('+24 hours')->getTimestamp();      // Add 60 seconds
            
            $userEmail = $loggedIn[1];
            $shopID = $loggedIn[0];                                           // Retrieved from filtered POST data

            $data = [
                'iat' => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated
                'iss' => $serverName,                       // Issuer
                'nbf' => $issuedAt->getTimestamp(),         // Not before
                'exp' => $expire,                           // Expire
                'userEmail' => $userEmail,                     // User name
                'shopID' => $shopID,
            ];
            $hash = JWT::encode($data, $secretKey, 'HS512');
            $_SESSION['hash'] = $hash;
            // echo $hash;
            // echo '<pre>';
            //  var_dump($_SERVER);
            // echo '</pre>';
            header('location: user/index.php');
        } else {

        }
    }
?>




<form action="" method="post">
    Email : <input type="email" name="email" id=""> <br>
    password : <input type="password" name="password" id=""> <br>
    <input type="submit" value="Login" name="login">

</form>