<?php

include_once '../../vendor/autoload.php';

use App\AdminController;
use App\util;

util::CORS();
$course = new AdminController();

 

$api = $_SERVER['REQUEST_METHOD'];

if ($api === "GET") {
    echo $course->get_total_course();
}
