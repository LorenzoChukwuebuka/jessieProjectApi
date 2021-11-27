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
$department = new AdminController();
$Obj = util::input();

$api = $_SERVER['REQUEST_METHOD'];
$id = intval($_GET['id'] ?? '');

if ($api === "POST") {
    $dept = $department->sanitize($Obj->dept);
    $schId = $department->sanitize($Obj->schId);

    echo $department->addDepartment($dept, $schId);
}

if ($api === "GET") {
    echo $department->fetchDept($id);
}

if ($api === "PUT") {
    $dept = $department->sanitize($Obj->dept);
    $schId = $department->sanitize($Obj->schId);

    echo $department->updateDepartment($dept, $schId, $id);
}

if ($api === "DELETE") {
    echo $department->deleteDept($id);
}
