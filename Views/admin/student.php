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
$student = new AdminController();
$Obj = util::input();

$api = $_SERVER['REQUEST_METHOD'];
$id = intval($_GET['id'] ?? '');

if ($api === "POST") {
    $name = $student->sanitize($Obj->name);
    $regnum = $student->sanitize($Obj->regnum);
    $dept_Id = $student->sanitize($Obj->deptId);
    $levelId = $student->sanitize($Obj->levelId);
    $course = $Obj->course;

    echo $student->addStudents($name, $regnum, $dept_Id, $levelId, $course);

}

if ($api === "GET") {
    echo $student->fetchStudents();
}
