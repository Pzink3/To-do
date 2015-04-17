<?php

$mysqli = new mysqli('localhost', 'root', 'root', 'to-do');
if ($mysqli->connect_error) {
    die('Connection Error (' . $mysqli->connect_errno . ')'
            . $mysqli->connect_error);
}

 // echo 'Connection Complete!' . $mysqli->host_info . '\n';

 $mysqli->close();


?>
<!-- http://php.net/manual/en/mysqli,connect-errno.php -->