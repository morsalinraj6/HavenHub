<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('APP_NAME', 'HavenHub');
define('BASE_URL', '/HavenHub/public');

define('DB_HOST', 'localhost');
define('DB_NAME', 'havenhub');
define('DB_USER', 'root');
define('DB_PASS', '');
