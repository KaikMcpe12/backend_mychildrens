<?php
$server = 'localhost';
$username = 'root';
$password = '';
$dbname = 'mychildrens';

$conn = new mysqli($server, $username, $password, $dbname);

if($conn->connect_error){
    echo 'Connection failed' . $conn->connect_error;
};