<?php
include_once '../../vendor/autoload.php';

use App\LecturerController;
use App\util;

util::CORS();
$enroll = new LecturerController();
$Obj = util::input();

$api = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? '';

if ($api === "GET") {
    echo $enroll->attend();
}

if ($api === "POST") {
    $courseId = $enroll->sanitize($Obj->courseId);
    $attendanceCode = $enroll->sanitize($Obj->attendanceCode);
    echo $enroll->attendanceCode($courseId, $attendanceCode);
}
