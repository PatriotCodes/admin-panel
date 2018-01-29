<?php
 
/*
    This is a configuration file. $config is a multi-dimensional array of global configuration variables.
*/
 
$config = array(
    "db" => array(
        "db1" => array(
            "dbname" => "asumenu",
            "username" => "Student",
            "password" => "12345",
            "host" => "asumenu"
        )
    ),
    "paths" => array(
        "root" => dirname("http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']),
        "resources" => "./resources",
        "images" => $_SERVER["DOCUMENT_ROOT"] . "/img",
    )
);
 
/*
    Constants for heavily used paths.
    ex. of use: require_once(LIBRARY_PATH . "Paginator.php")
*/
    
defined("LIBRARY_PATH")
    or define("LIBRARY_PATH", realpath(dirname(__FILE__) . '/library'));
     
defined("TEMPLATES_PATH")
    or define("TEMPLATES_PATH", realpath(dirname(__FILE__) . '/templates'));

defined("CONTROLLERS_PATH")
    or define("CONTROLLERS_PATH", realpath(dirname(__FILE__) . '/controllers'));

ini_set("error_reporting", "true");
error_reporting(E_ALL|E_STRCT);
 
?>