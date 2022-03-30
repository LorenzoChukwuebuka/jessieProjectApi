<?php
include_once '../../vendor/autoload.php';

use App\AdminController;
use App\util;


util::CORS();
$lecturer = new AdminController();
$Obj = util::input();

$api = $_SERVER['REQUEST_METHOD'];
$id = intval($_GET['id'] ?? '');

if ($api === "POST") {
    $name = $lecturer->sanitize($Obj->name);
    $course = $Obj->course;

    echo $lecturer->addLecturers($name, $course);
}

if ($api === "GET") {
    echo $lecturer->fetchlecturers();
}

if ($api === "PUT") {

}

if ($api === "DELETE") {
    echo $lecturer->deletelectures($id);
}
