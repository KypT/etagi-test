<?
class DB {
    static private $databaseConnection;

    static private function init() {
        if ($_SERVER['SERVER_NAME'] == "etagi-test.herokuapp.com") {
            $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
            $host = $url["host"];
            $username = $url["user"];
            $password = $url["pass"];
            $db = substr($url["path"], 1);
        } else {
            $host = 'localhost';
            $db = 'etagi_test';
            $username = 'visitor';
            $password = '';
        }

        self::$databaseConnection = new mysqli($host, $username, $password, $db);
        self::$databaseConnection->set_charset('utf8');
        self::$databaseConnection->query('SET NAMES utf8');
    }

    static function getConnection() {
        if (self::$databaseConnection == null)
           DB::init();

        return self::$databaseConnection;
    }
}