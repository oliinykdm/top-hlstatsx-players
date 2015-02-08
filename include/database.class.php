<?php
// +---------------------------------------------------------------------------------------+
// | Top HLStatsX Players                                                                  |
// | Software is licensed under the GNU GPL v2. Prohibited for use in commercial software. |
// +---------------------------------------------------------------------------------------+
// | Version 0.115                                                                         |
// +---------------------------------------------------------------------------------------+
// | Author: Dima Oliynyk                                                                  |
// | Email: <dima@dima.rv.ua>                                                              |
// | Web-site: www.dima.rv.ua                                                              |
// +---------------------------------------------------------------------------------------+

Class Database extends PDO {

    /* !!! HLSTATSX TABLE DETAILS !!!*/
    private static $db = null;
    private static $dbHost = "localhost";
    private static $dbUser = "root";
    private static $dbPass = "";
    private static $dbName = "hlstatsx";

    public static function interpolateQuery($query, $params = []) {
        $keys = array();
        foreach ($params as $key => $value) {
            if (is_string($key)) {
                $keys[] = '/:'.$key.'/';
            } else {
                $keys[] = '/[?]/';
            }
        }

        $query = preg_replace($keys, $params, $query, 1, $count);

        return $query;
    }


    public static function instance()
    {
        if (is_null(self::$db) === true)
        {
            self::$db = new PDO('mysql:host=' . self::$dbHost . ';dbname=' . self::$dbName . '', self::$dbUser, self::$dbPass, [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ]);
        }

        return self::$db;
    }
}

?>