<?php
include_once '../../vendor/autoload.php';

use App\AdminController;
use App\util;

util::CORS();
$user = new AdminController();
$Obj = util::input();

$api = $_SERVER['REQUEST_METHOD'];

$id = intval($_GET['id'] ?? '');

if ($api === "POST") {

    $name = $user->sanitize($Obj->username);
    $pass = $user->sanitize($Obj->password);


    echo $user->login($name, $pass);

}
