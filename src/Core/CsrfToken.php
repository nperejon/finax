<?php

namespace Source\Core;

class CsrfToken
{
    public static function generate()
    {
        SessionManager::start();
        $token = md5(uniqid(rand(), true));
        $_SESSION['csrf_token'] = $token;
        return $token;
    }

    public static function check($token)
    {
        SessionManager::start();
        if (empty(SessionManager::get('csrf_token')) || SessionManager::get('csrf_token') != $token) {
            return false;
        }
        SessionManager::unset('csrf_token');
        return true;
    }
}