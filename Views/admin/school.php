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
$school = new AdminController();
$Obj = util::input();

$api = $_SERVER['REQUEST_METHOD'];
$id = intval($_GET['id'] ?? "");
 

if ($api === "POST") {
    $sch = $school->sanitize($Obj->school);
    echo $school->addSchool($sch);
}

if ($api === "GET") {
    echo $school->fetchSchool();
}

if ($api === "PUT") {
    $sch = $school->sanitize($Obj->school);

    echo $school->updateSchool($id, $sch);
}

if ($api === "DELETE") {
    echo $school->deleteSchool($id);
}
