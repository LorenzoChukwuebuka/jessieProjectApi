<?php
include_once '../../vendor/autoload.php';

use App\LecturerController;
use App\util;

util::CORS();
$name = new LecturerController();

$api = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? '';

if ($api === "GET") {
  echo $name->getUser($id);
}
