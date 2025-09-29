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

require_once __DIR__ . '/vendor/autoload.php'; // Load Composer autoloader
require_once 'SessionManager.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$host = $_ENV['DB_HOST'];
$dbname = $_ENV['DB_DATABASE'];
$user = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];

$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_PERSISTENT => true, PDO::ATTR_EMULATE_PREPARES => false]);
$sessionManager = new SessionManager($pdo); // Initialize the session manager

function handleServerError($message, $code = 500) {
  http_response_code($code);
  echo json_encode(["error" => $message]);
  exit;
}

