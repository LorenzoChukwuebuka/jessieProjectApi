<?php

include_once '../../vendor/autoload.php';

use App\AdminController;
use App\util;

util::CORS();
$depts = new AdminController();

$api = $_SERVER['REQUEST_METHOD'];

if ($api === "GET") {
    echo $depts->get_total_departments();
}
