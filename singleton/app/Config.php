<?php

namespace App;

class Config
{
    private static ?Config $instance = null;
    private array $settings;


    private function __construct()
    {

        $this->settings = require dirname(__DIR__) . '/config/config.php';
    }
    public static function getInstance(): Config
    {
        if (self::$instance === null) {
            self::$instance = new Config();
        }

        return self::$instance;
    }

    public function get(string $key, $default = null)
    {
        if (strpos($key, '.') !== false) {
            $keys = explode('.', $key);
            $value = $this->settings;

            foreach ($keys as $subKey) {
                if (!isset($value[$subKey])) {
                    return $default;
                }
                $value = $value[$subKey];
            }

            return $value;
        }
        return $this->settings[$key] ?? $default;
    }


}