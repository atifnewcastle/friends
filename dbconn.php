<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'friends');
/**
 * Database connection functions
 *
 * This file contains functions to establish and close a connection to the database.
 * It uses MySQLi for database operations.
 */
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
