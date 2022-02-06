<?php
declare (strict_types = 1);
namespace App;

class util
{
    public static function input()
    {
        $data = file_get_contents("php://input");
        return json_decode($data);
    }

    public static function generateRand(int $val)
    {
        $len = $val;
        $dat = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($dat), 0, $len);

    }

    public static function CORS()
    {
        // Allow from any origin
        if (isset($_SERVER["HTTP_ORIGIN"])) {
            // You can decide if the origin in $_SERVER['HTTP_ORIGIN'] is something you want to allow, or as we do here, just allow all
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header("Content-Type: application/json; charset=UTF-8");
        } else {
            //No HTTP_ORIGIN set, so we allow any. You can disallow if needed here
            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");
        }

        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Max-Age: 6000"); // cache for 10 minutes
        header("Content-Type: application/json; charset=UTF-8");

        if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
            if (isset($_SERVER["HTTP_ACCESS_CONTROL_REQUEST_METHOD"])) {
                header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
                header("Content-Type: application/json; charset=UTF-8");
            }
            //Make sure you remove those you do not want to support

            if (isset($_SERVER["HTTP_ACCESS_CONTROL_REQUEST_HEADERS"])) {
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
                header("Content-Type: application/json; charset=UTF-8");
            }

            //Just exit with 200 OK with the above headers for OPTIONS method
            exit(0);
        }
//From here, handle the request as it is ok
    }
}
