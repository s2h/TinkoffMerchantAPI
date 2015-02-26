<?php

class Debug {
    private static $logfile = 'log.txt';
    public static function trace($arg = null, $die = false){
        if (!$arg) $arg = '';
        $arg = print_r($arg, true);
        echo '<pre>' . $arg . '</pre>';
        if ($die) die();
    }

    public static function log($arg = null, $die = false)
    {
        if (!$arg) return false;
        if ( ! is_string($arg)) {
            $arg = print_r($arg, true);
        }
        file_put_contents(self::$logfile, $arg);
        if ($die) die();
        return true;
    }
}