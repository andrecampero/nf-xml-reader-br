<?php
// Error PHP Print
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);

// timezone db
date_default_timezone_set('America/Sao_Paulo');

// cnf app url
$GLOBALS['app_url'] = "http://localhost/xmlreader";

// cnf db
$GLOBALS['db_host'] = "127.0.0.1";
$GLOBALS['db_name'] = "xmlreader";
$GLOBALS['db_user'] = "root";
$GLOBALS['db_pass'] = "root";
?>