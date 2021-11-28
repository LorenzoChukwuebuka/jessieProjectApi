<?php
include_once '../../vendor/autoload.php';

use App\AdminController;
use App\util;

util::CORS();
$cos = new AdminController();
$Obj = util::input();

$api = $_SERVER['REQUEST_METHOD'];

$id = intval($_GET['id'] ?? '');

if ($api === "POST") {

    $name = $user->sanitize($Obj->name);
    $pass = $user->sanitize($Obj->pass);

    echo $user->login($name, $pass);

}
