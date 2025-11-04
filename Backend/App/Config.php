<?php
// backend/app/Config.php

class Config {
    private static $config = [];

    public static function load() {
        $dotenv = file(ROOT_PATH . '.env');
        foreach ($dotenv as $line) {
            list($key, $value) = explode('=', trim($line), 2);
            self::$config[$key] = $value;
        }
    }

    public static function get($key, $default = null) {
        return self::$config[$key] ?? $default;
    }
}
?>