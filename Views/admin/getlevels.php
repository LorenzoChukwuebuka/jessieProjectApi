<?php

include_once '../../vendor/autoload.php';
use App\AdminController;
use App\util;

util::CORS();
$levels = new AdminController();
$Obj = util::input();

$api = $_SERVER['REQUEST_METHOD'];

if ($api === "GET") {
    echo $levels->getlevel();
}
