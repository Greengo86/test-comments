<?php
namespace App\components;

use PDO;

class DB
{
    public static $dbConnection = null;
    public static $conf = null;

    public static function getDbConn(): PDO
    {
        if (!static::$conf) {
            static::$conf = require 'config-db.php';
        }
        $db = static::$conf['db'];
        if (!static::$dbConnection) {
            static::$dbConnection = new PDO("mysql:host={$db['host']};port={$db['port']};dbname={$db['dbname']}",
                $db['username'], $db['password']);
        }
        return static::$dbConnection;
    }
}