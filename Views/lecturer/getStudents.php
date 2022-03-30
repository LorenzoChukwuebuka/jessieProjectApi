<?php
include_once '../../vendor/autoload.php';

use App\LecturerController;
use App\util;

util::CORS();
$student = new LecturerController();

$api = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? '';

if ($api === "GET") {
    echo $student->get_students_per_course($id);
}
