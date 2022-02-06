<?php

include_once '../../vendor/autoload.php';

use App\AdminController;
use App\util;

util::CORS();
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

if ($api === "DELETE") {
    echo $student->delete_student($id);
}
