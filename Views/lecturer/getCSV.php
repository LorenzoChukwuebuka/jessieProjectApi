<?php
include_once '../../vendor/autoload.php';

use App\LecturerController;
use App\util;

util::CORS();
$csv = new LecturerController();
$Obj = util::input();

$api = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? '';

if ($api === "POST") {
    $id = $_POST['id'];
    echo $csv->exportCSV($id);
}
