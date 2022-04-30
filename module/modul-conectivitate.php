<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "atestat";

if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    die("Conectarea la baza de datea eșuat!");
}