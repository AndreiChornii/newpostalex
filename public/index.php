<?php
session_start();

include '../handlers/validate.php';
include '../includes/DatabaseConnection.php';
include '../handlers/mysqli.php';

$route = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

include '../handlers/routesMethodGet.php';

include '../handlers/routesMethodPost.php';