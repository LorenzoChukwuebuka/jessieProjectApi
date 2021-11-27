<?php
 namespace App;
class util
{
    public static function input()
    {
        $data = file_get_contents("php://input");
        return json_decode($data);
    }

    public static function generateRand()
    {
        $len = 8;
        $dat = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz!@#$%^&*()_+:"><?/~';
        return substr(str_shuffle($dat), 0, $len);

    }
}
