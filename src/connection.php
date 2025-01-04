<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "online_store";

if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    die("failed to connect!");
}
