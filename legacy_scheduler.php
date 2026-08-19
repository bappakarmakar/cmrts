<?php
$host     = 'localhost';
$port     = '5433';
$dbname   = 'cmrts_report'; // make sure this is EXACTLY correct
$user     = 'postgres';
$password = 'root';

$conn_string = "host=$host port=$port dbname=$dbname user=$user password=$password";
$conn = pg_connect($conn_string);

if (!$conn) {
    die("Connection failed.");
}
echo "DB Connected successfully!";




?>