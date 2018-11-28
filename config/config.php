<?php
ob_start();
session_start();
if (!function_exists('base_url')) {
    function base_url($uri = '')
    {
        $url = 'http://dev.php12pm.com/' . $uri;
        $serverName = $_SERVER['SERVER_NAME'];
        if ($serverName == 'localhost') {
            $url = 'http://localhost/' . 'php12pm/' . $uri;
        }
        return $url;

    }
}

if (!function_exists('admin_url')) {
    function admin_url($uri = '')
    {
        $url = 'http://dev.php12pm.com/admin/' . $uri;
        $serverName = $_SERVER['SERVER_NAME'];
        if ($serverName == 'localhost') {
            $url = 'http://localhost/' . 'php12pm/admin/' . $uri;
        }
        return $url;
    }
}


if (!function_exists('root_path')) {
    function root_path($path)
    {

        return dirname(__DIR__) . '/' . $path;
    }

}


if (!function_exists('redirect_to')) {
    function redirect_to($path = '')
    {
        $redirectPath = base_url($path);
        header('Location:' . $redirectPath);
        exit();
    }

}


if (!function_exists('messages')) {
    function messages()
    {
        if (isset($_SESSION['success'])) {
            $class = 'alert alert-success';
            $message = $_SESSION['success'];
            unset($_SESSION['success']);
        }

        if (isset($_SESSION['error'])) {
            $class = 'alert alert-danger';
            $message = $_SESSION['error'];
            unset($_SESSION['error']);
        }

        $output = '';

        if (isset($message)) {
            $output .= "<div class='{$class}'>";
            $output .= $message;
            $output .= "</div>";

        }

        return $output;
    }
}



