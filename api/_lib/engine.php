<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //helpers
    include('helpers.php');
    
    $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') === FALSE ? 'http' : 'https';
    $domainLink = "{$protocol}://{$_SERVER['HTTP_HOST']}";
    $query_string = $_SERVER['QUERY_STRING'];

    define('API_PROTOCOL', $protocol);
    define('API_DOMAIN', $domainLink);
    define('API_QUERY_STRING', $query_string);
    define('API_INFO', _info_api());
?>