<?php
// Database credentials
$servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
$username = "root"; // Replace with your MySQL username
$password = "admin"; // Replace with your MySQL password
$database = "alumnos"; // Replace with the name of your MySQL database

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Fallo de conexión " . $conn->connect_error);
}