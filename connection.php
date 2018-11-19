<?php
session_start();
$connection = mysqli_connect('127.0.0.1', 'root', '', 'php12pm');

if ($connection != true) {
    die(mysqli_errno($connection));
}

