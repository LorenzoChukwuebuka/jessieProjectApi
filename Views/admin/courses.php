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
    $course = $cos->sanitize($Obj->course);
    $course_code = $cos->sanitize($Obj->course_code);
    $deptId = $cos->sanitize($Obj->deptId);
    $levelId = $cos->sanitize($Obj->levelId);

    echo $cos->addCourse($course, $course_code, $levelId, $deptId);
}

if ($api === "GET") {
    echo $cos->fetchCourses();
}

if ($api === "PUT") {
    $course = $cos->sanitize($Obj->course);
    $course_code = $cos->sanitize($Obj->course_code);
    $deptId = $cos->sanitize($Obj->deptId);
    $levelId = $cos->sanitize($Obj->levelId);

    echo $cos->updateCourses($course, $course_code, $levelId, $deptId, $id);

}

if ($api === "DELETE") {
    $cos->deleteCourse($id);
}
