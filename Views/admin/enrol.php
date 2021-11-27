<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: *');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../../vendor/autoload.php';

use App\AdminController;
$biometrics = new AdminController();

$api = $_SERVER['REQUEST_METHOD'];

if ($api === "POST") {
    $biometrics->enroll();
}
