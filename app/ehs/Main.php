<?php
namespace EHS;

use \PDO;
use Jenssegers\Blade\Blade;
use EHS\Router;
use EHS\Parameters;

class Main {
    public static $blade;
    public static $db;
    public static $notifies = [];

    public static function run() {
        // instance of blade here
        self::$blade = new Blade('ehs/views', 'ehs/cache');
        self::$db = new \PDO('mysql:host=db;dbname=myGame', getenv("MYSQL_USER"), 
            getenv("MYSQL_PASSWORD"));
        
        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo Router::route(Parameters::get("action"));
    }

    public static function view($name, $vars = []) {
        $vars['notifies'] = self::$notifies;
        
        return self::$blade->make($name, $vars);
    }
}