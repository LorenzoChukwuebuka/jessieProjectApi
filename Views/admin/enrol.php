<?php

include_once '../../vendor/autoload.php';
use App\AdminController;
use App\util;
util::CORS();
$biometrics = new AdminController();

$api = $_SERVER['REQUEST_METHOD'];

if ($api === "POST") {
    $biometrics->enroll();
}
