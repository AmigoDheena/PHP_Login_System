<?php
$sql_servername = 'localhost';
$sql_username = 'root';
$sql_password = '';
$sql_db = 'login_system';

$connect = mysqli_connect($sql_servername,$sql_username,$sql_password,$sql_db);
if (!$connect) {
    echo "Connection Failed";
}