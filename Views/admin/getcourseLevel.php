<?php
include_once '../../vendor/autoload.php';

use App\AdminController;
use App\util;

util::CORS();

$cos = new AdminController();
$Obj = util::input();

$api = $_SERVER['REQUEST_METHOD'];
$id = intval($_GET['levelId'] ?? '');

if ($api === "POST") {
    $levelId = $cos->sanitize($Obj->levelId);
    $deptId = $cos->sanitize($Obj->deptId);

    if (empty($levelId) && empty($deptId)) {
        return false;
    } else {
        echo $cos->get_Course($levelId, $deptId);

    }

}
