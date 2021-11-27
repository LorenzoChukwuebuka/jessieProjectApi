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
$id = intval($_GET['levelId'] ?? '');

if ($api === "POST") {
    $levelId = $cos->sanitize($Obj->levelId);
    $deptId = $cos->sanitize($Obj->deptId);

    if (empty($levelId) && empty($deptId)) {
        return false;
    } else {
        echo $cos->get_Course($levelId, $deptId);

    }

}
