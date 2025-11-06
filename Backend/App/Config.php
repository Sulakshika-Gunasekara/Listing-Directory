<?php
// backend/app/Config.php

class Config {
    private static $config = [
        
        'DB_HOST' => 'localhost',
        'DB_USER' => 'root',
        'DB_PASS' => '',
        'DB_NAME' => 'BWW_Listing_Directory',

        // 🧠 Add more config values here if needed later
        // 'APP_ENV' => 'development',
        // 'DEBUG' => true,
    ];

    public static function load() {
        // Nothing to load anymore since config is already defined above.
    }

    public static function get($key, $default = null) {
        return self::$config[$key] ?? $default;
    }
}
?>
