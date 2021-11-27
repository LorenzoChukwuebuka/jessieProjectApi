<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: *');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../../vendor/autoload.php';

use App\AdminController;
use App\util;
$cos = new AdminController();
$Obj = util::input();

$api = $_SERVER['REQUEST_METHOD'];

$id = intval($_GET['id'] ?? '');

if ($api === "POST") {
 

    $name = $user->sanitize($Obj->name);
    $pass = $user->sanitize($Obj->pass);

    echo $user->login($name, $pass);

}
