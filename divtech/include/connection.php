<?php
session_start();
define('SALT','qwertyuiopasdfghjklzxcvbnm');
$sdate=date('Y-m-d');
$timearri=date('h:i:a');

//PDO connection
$servername = "localhost";
$username = "root";
$password = "";
try {
    $conn = new PDO("mysql:host=$servername;dbname=divtech", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";

  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }

  include 'function.php';

  