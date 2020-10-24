<?php
session_start();
date_default_timezone_set("Africa/Casablanca");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define("HOSTNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DBNAME", "covidma");

// Global MySQL connection
$conn = new mysqli(HOSTNAME, USERNAME, PASSWORD, DBNAME);
$conn->set_charset('utf8');

// Define constants
define("APP_ID", 'covidma_id2020');
define("APP_NAME", 'CovidMA');
define("DC", 'DevCrawlers');
define("SHOW_ADMIN", 'Administration');

// Global alert message variable to change use setMessage(string $msg):void
$message = "";