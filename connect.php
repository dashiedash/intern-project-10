<?php

// Database configuration
$host = 'localhost';
$dbName = 'project-10';
$username = 'root';
$password = '';

// Establish database connection
try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}
