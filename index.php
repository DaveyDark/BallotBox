<?php

require_once __DIR__ . '/includes/dbh.inc.php';

$request = strtok($_SERVER['REQUEST_URI'], '?'); // Get the request URI without query string
$pageDir = __DIR__ . '/pages/';
$apiDir = __DIR__ . '/api/';

session_start();

switch ($request) {
    // Main pages
  case '':
  case '/':
    require $pageDir . 'index.php';
    break;
  case '/login':
    require $pageDir . 'login.php';
    break;
  case '/signup':
    require $pageDir . 'signup.php';
    break;

  default:
    http_response_code(404);
    echo $request;
    require $pageDir . '404.php';
}
