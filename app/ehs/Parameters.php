<?php
namespace EHS;

class Parameters {
    public static function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

    public static function get($name) {
        return self::test_input($_GET[$name]);
    }

    public static function post($name) {
        return self::test_input($_POST[$name]);
    }

}
