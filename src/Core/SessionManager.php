<?php

namespace Source\Core;

class SessionManager
{
    public static function start()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function destroy()
    {
        self::start();
        session_destroy();
    }

    public static function set($key, $value)
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        self::start();
        return $_SESSION[$key] ?? null;
    }

    public static function unset($key)
    {
        self::start();
        unset($_SESSION[$key]);
    }

    public static function flash($key, $value)
    {
        self::start();
        $_SESSION[$key] = $value;
        self::unset($key);
    }
}