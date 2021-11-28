<?php

include_once '../../vendor/autoload.php';

use App\AdminController;
use App\util;

util::CORS();
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
