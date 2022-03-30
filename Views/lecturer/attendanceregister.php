<?php
include_once '../../vendor/autoload.php';

use App\LecturerController;
use App\util;

util::CORS();
$attendance = new LecturerController();
$Obj = util::input();

$api = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? '';

if ($api === "GET") {
    echo $attendance->getAttendance_register($id);
}
