<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// Allow requests from any origin
header("Access-Control-Allow-Origin: *");
// Set allowed HTTP methods
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
// Set allowed headers
header("Access-Control-Allow-Headers: Authorization, Content-Type");

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  http_response_code(204); // No Content
  exit;
}

require_once __DIR__ . '/../vendor/autoload.php';

$router = new AltoRouter();

require_once __DIR__ . '/../src/Routes/auth.php';
require_once __DIR__ . '/../src/Routes/profile.php';
require_once __DIR__ . '/../src/Routes/logout.php';
require_once __DIR__ . '/../src/Routes/registration.php';
require_once __DIR__ . '/../src/Routes/favorites.php';
require_once __DIR__ . '/../src/Routes/orgs.php';
require_once __DIR__ . '/../src/Routes/reporting.php';
require_once __DIR__ . '/../src/Routes/references.php';
require_once __DIR__ . '/../src/Routes/submitted.php';
require_once __DIR__ . '/../src/Routes/approved.php';
require_once __DIR__ . '/../src/Routes/status.php';
require_once __DIR__ . '/../src/Routes/searchOrganization.php';
require_once __DIR__ . '/../src/Routes/referrals.php';
require_once __DIR__ . '/../src/Routes/discovery.php';
require_once __DIR__ . '/../src/Routes/user/registration.php';
require_once __DIR__ . '/../src/Routes/user/profile.php';
require_once __DIR__ . '/../src/Routes/user/logout.php';
require_once __DIR__ . '/../src/Routes/user/favorites.php';
require_once __DIR__ . '/../src/Routes/user/basic.php';
require_once __DIR__ . '/../src/Routes/user/auth.php';
require_once __DIR__ . '/../src/Routes/user/interests.php';

$match = $router->match();

if ($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    http_response_code(404);
    echo json_encode(['message' => 'Route not found']);
}
