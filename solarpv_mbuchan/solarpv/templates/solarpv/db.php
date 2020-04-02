<?php
/* Database connection settings */
$host = 'localhost';
$user = '458user';
$pass = 'password';
$db = 'solarpv';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
?>