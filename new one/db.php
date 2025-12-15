<?php
// db.php
require_once 'config.php';

function getConn() {
    static $conn = null;
    if ($conn === null) {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($conn->connect_error) {
            die("Database Connection Failed: " . $conn->connect_error);
        }
    }
    return $conn;
}
?>