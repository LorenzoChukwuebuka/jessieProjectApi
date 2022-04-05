<?php
include_once '../../vendor/autoload.php';

ini_set("display_erroros", 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\LecturerController;
use App\util;

util::CORS();
$csv = new LecturerController();
$Obj = util::input();

$api = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? '';

if ($api === "GET") {

    echo $csv->exportCSV($id);
}
