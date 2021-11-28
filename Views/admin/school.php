<?php

include_once '../../vendor/autoload.php';

use App\AdminController;
use App\util;

util::CORS();
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
