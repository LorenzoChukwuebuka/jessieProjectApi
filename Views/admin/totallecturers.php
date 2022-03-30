<?php

include_once '../../vendor/autoload.php';

use App\AdminController;
use App\util;

util::CORS();
$lecturers = new AdminController();

$api = $_SERVER['REQUEST_METHOD'];

if ($api === "GET") {
    echo $lecturers->get_total_lecturers();
}
