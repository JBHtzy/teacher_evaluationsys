<?php

$mysqli = new mysqli('localhost', 'root', '', 'teachereval');

if ($mysqli->connect_errno) {
    die('Connection Error: ' . $mysqli->connect_errno);
}
