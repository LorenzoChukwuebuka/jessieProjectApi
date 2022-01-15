<?php

include_once '../../vendor/autoload.php';

use App\AdminController;
use App\util;

util::CORS();
$student = new AdminController();

$api = $_SERVER['REQUEST_METHOD'];

if ($api === "GET") {
    echo $student->get_total_students();
}
