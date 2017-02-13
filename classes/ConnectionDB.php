<?php
/**
 * Created by PhpStorm.
 * User: kana
 * Date: 2017/02/10
 * Time: 10:27
 */

class ConnectionDB
{
    public static function getConnection()
    {
        $dbh = mysqli_connect('localhost', 'root', '')
            or die("Can't connect database because : ".mysqli_error());
        mysqli_select_db($dbh, 'test_board');
        return $dbh;
    }
}