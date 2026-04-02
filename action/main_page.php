<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/auth.php';

$is_logged_in = isLoggedIn();
$user_name = getUserName();

require_once __DIR__ . '/../templates/main_page.php';