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
    if (isset($_SESSION['user_id'])) {
      require $pageDir . 'home.php';
    } else {
      require $pageDir . 'index.php';
    }
    break;
  case '/about':
    require $pageDir . 'about.php';
    break;
  case '/login':
    require $pageDir . 'login.php';
    break;
  case '/signup':
    require $pageDir . 'signup.php';
    break;
  case '/create-poll':
    if (isset($_SESSION['user_id'])) {
      require $pageDir . 'create_poll.php';
    } else {
      require $pageDir . 'login.php';
    }
    break;
  // Dynamic pages
  case '/vote':
    require $pageDir . 'vote.php';
    break;
  case '/poll':
    require $pageDir . 'poll.php';
    break;
  // API endpoints
  case '/api/create-poll':
    require $apiDir . 'create_poll.php';
    break;
  case '/api/signup':
    require $apiDir . 'signup.php';
    break;
  case '/api/login':
    require $apiDir . 'login.php';
    break;
  case '/api/vote':
    require $apiDir . 'vote.php';
    break;
  case '/logout':
    session_destroy();
    header('Location: /');
    break;
  default:
    http_response_code(404);
    require $pageDir . '404.php';
}
