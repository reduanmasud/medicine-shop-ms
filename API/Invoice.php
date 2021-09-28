<?php

// required headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Max-Age: 3600');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

//header('Content-Type: application/json;');

require_once '../config.php';
require_once '../classes/User.php';
require_once '../classes/Customer.php';
include_once '../classes/DBConnect.php';
require_once '../classes/Medicine.php';
$medicine = new Medicine();

// generate json web token
include_once '../libs/php-jwt-master/src/BeforeValidException.php';
//include_once '../libs/php-jwt-master/src/ExpiredException.php';
require_once '../libs/php-jwt-master/src/ExpiredException.php';
include_once '../libs/php-jwt-master/src/SignatureInvalidException.php';
include_once '../libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;

//<?php echo "<pre>".$_SERVER['HTTP_AUTHORIZATION']."<pre>";

if (!preg_match("/Bearer\s(\S+)/", $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
    header('http/1.0 400 Bad Request');
    echo 'Bad Request';
    exit;
}

$jwt = $matches[1];
$invoiceID = null;
$shopID = null;
if (!isset($_GET['shopID'])) {
    header('http/1.0 400 Bad Request');
    echo 'Bad Request';
    exit;
} else {
    $shopID = $_GET['shopID'];
}

if (!isset($_GET['invoiceID'])) {
    header('http/1.0 400 Bad Request');
    echo 'Bad Request';
    exit;
} else {
    $invoiceID = $_GET['invoiceID'];
}

if (!$jwt) {
    header('http/1.0 400 Bad Request');
    echo 'Bad Request';
    exit;
}
$token = null;
try {
    $token = JWT::decode($jwt, $secretKey, ['HS512']);
} catch (Exception $e) {
    //echo 'Exception catched: ',  $e->getMessage(), "\n";
}

$now = new DateTimeImmutable();
if ($token == null) {
    header('http/1.0 401 Unauthorized');
    echo 'Unauthorized';
    exit;
}

if ($token->iss !== $serverName || $token->nbf > $now->getTimestamp() || $token->exp < $now->getTimestamp()) {
    header('http/1.0 401 Unauthorized');
    echo 'Unauthorized';
    exit;
}

// echo '<pre>';
// var_dump($token);
// echo '</pre>';

if ($token->shopID != $shopID) {
    header('http/1.0 401 Unauthorized');
    echo 'Unauthorized';
    exit;
}
$db = null;
if ($db == null) {
    $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . '', DB_USER, DB_PASSWORD);
}

    $sql = 'SELECT * FROM invoice WHERE id = ?';
    $stmt = $db->prepare($sql);
    $stmt->execute([$invoiceID]);
    $invoice = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = 'SELECT invoice_med.*, medicine.brand_name, medicine.strength FROM invoice_med INNER JOIN medicine ON medicine.id = invoice_med.medicine_id WHERE invoice_med.invoice_id = ?';
    $stmt = $db->prepare($sql);
    $stmt->execute([$invoiceID]);
    $invoice['medicines'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = 'SELECT * FROM shop WHERE id = ?';
    $stmt = $db->prepare($sql);
    $stmt->execute([$shopID]);
    $invoice['shop_info'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    

    if($invoice[0]["customer_id"] != null)
    {
        $sql = 'SELECT * FROM customer WHERE id = ? AND shop_id =?';
    $stmt = $db->prepare($sql);
    $stmt->execute([$invoice[0]["customer_id"], $shopID]);
    $invoice["customer"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    echo json_encode($invoice);

  
?>



