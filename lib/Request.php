<?php

namespace lib;

class Request
{
    public static function get($key = null, $default = null)
    {
        if (null === $key) {
            return $_GET;
        }

        return (isset($_GET[$key])) ? $_GET[$key] : $default;
    }

    public static function post($key = null, $default = null)
    {
        if (null === $key) {
            return $_POST;
        }

        return (isset($_POST[$key])) ? $_POST[$key] : $default;
    }

    public static function cookie($key = null, $default = null)
    {
        if (null === $key) {
            return $_COOKIE;
        }

        return (isset($_COOKIE[$key])) ? $_COOKIE[$key] : $default;
    }

    public static function session($key = null, $default = null)
    {
        isset($_SESSION) || session_start();
        if (null === $key) {
            return $_SESSION;
        }

        return (isset($_SESSION[$key])) ? $_SESSION[$key] : $default;
    }

    public static function clientIp($default = '0.0.0.0')
    {
        $keys = array('HTTP_X_FORWARDED_FOR', 'HTTP_CLIENT_IP', 'REMOTE_ADDR');

        foreach ($keys as $key) {
            if (empty($_SERVER[$key])) continue;
		    $ips = explode(',', $_SERVER[$key], 1);
		    $ip = $ips[0];
		    if (false != ip2long($ip) && long2ip(ip2long($ip) === $ip)) return $ips[0];
		}

        return $default;
    }
}