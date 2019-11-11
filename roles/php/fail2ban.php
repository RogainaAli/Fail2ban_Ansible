#!/usr/bin/php7.0
<?php
$name = $_SERVER["argv"][1];
$protocol = $_SERVER["argv"][2];
$port = $_SERVER["argv"][3];
if (!preg_match('/^\d{1,5}$/', $port))
    $port = getservbyname($_SERVER["argv"][3], $protocol);
$ip = $_SERVER["argv"][4];

$hostname = gethostname();

// connect to mysql by hostname, username and password
// database configuration
$dbserver="localhost";
$dbuser="f2b_user";
$dbpass="123";
$dbname="fail2ban";
$link = mysqli_connect($dbserver, $dbuser, $dbpass) or die("Could not connect: " . mysqli_error());
mysqli_select_db($link, $dbname) or die('Could not select database');
$query = 'INSERT INTO `fail2ban` set hostname="' . addslashes($hostname) . '", name="' . addslashes($name) . '", protocol="' . addslashes($protocol) . '", port="' . addslashes($port) . '", ip="' . addslashes($ip) . '", created=NOW()';
$result = mysqli_query($link, $query) or die('Query failed: ' . mysqli_error());
mysqli_close($link);
exit;
