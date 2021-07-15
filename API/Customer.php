
<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
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

if(!preg_match("/Bearer\s(\S+)/", $_SERVER["HTTP_AUTHORIZATION"], $matches))
{
    header('http/1.0 400 Bad Request');
    echo 'Bad Request';
    exit;
}

$jwt = $matches[1];
$shopID = null;
if(!isset($_GET['shopID']))
{
    header('http/1.0 400 Bad Request');
    echo 'Bad Request';
    exit;
}
else
{
    $shopID = $_GET['shopID'];
}

if(!$jwt)
{
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
if($token == null) 
{
    header('http/1.0 401 Unauthorized');
    echo 'Unauthorized';
    exit;
}

if($token -> iss !== $serverName || $token->nbf > $now->getTimestamp() || $token->exp < $now->getTimestamp())
{
    header('http/1.0 401 Unauthorized');
    echo 'Unauthorized';
    exit;
}

// echo '<pre>';
// var_dump($token);
// echo '</pre>';

if($token->shopID != $shopID)
{
    header('http/1.0 401 Unauthorized');
    echo 'Unauthorized';
    exit;
}
$db = null;
if ($db == null) {
    $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . '', DB_USER, DB_PASSWORD);
}


    if(isset($_GET["csID"]))
    {
        $sql = 'SELECT * FROM `customer` WHERE `shop_id` = ? AND `id`= ?';
        $stmt = $db->prepare("$sql");
        $stmt->execute([$shopID, $_GET["csID"]]);

    }
    else
    {
        $sql = 'SELECT * FROM `customer` WHERE `shop_id` = ?';
        $stmt = $db->prepare("$sql");
        $stmt->execute([$shopID]);
    }
    

    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $data = [];
    foreach ($res as $key) {
        
        $key['name'] = $key['first_name'] . ' ' . $key['last_name'];
        unset($key['first_name']);
        unset($key['last_name']);
        array_push($data, $key);
        //var_dump($key);
    }
    echo json_encode($data);


?>


