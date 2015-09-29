<?
class DB {
    static private $databaseConnection;

    static private function init() {
        self::$databaseConnection = new mysqli('localhost', 'visitor', '');
    }

    static function getConnection() {
        if (self::$databaseConnection == null)
           DB::init();

        return self::$databaseConnection;
    }
}