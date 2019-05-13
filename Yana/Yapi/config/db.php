<?php

namespace Mapi\Config;

class Database
{
    private static $bdd = null;
    private function __construct() {
    }
    public static function getBdd() {
        if(is_null(self::$bdd)) {
            self::$bdd =  new \PDO("sqlite:/rhome/davidr/testFolder/prelude/prelude/config/todo_php.db");
        }
        return self::$bdd;
    }
}
?>