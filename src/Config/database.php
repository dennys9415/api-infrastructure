<?php

use Dotenv\Dotenv;

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

try {
    $envPath = dirname(__DIR__, 2);
    $dotenv = Dotenv::createImmutable($envPath);
    $dotenv->load();

    $host     = $_ENV['DB_HOST'] ?? null;
    $dbname   = $_ENV['DB_DATABASE'] ?? null;
    $user     = $_ENV['DB_USERNAME'] ?? null;
    $password = $_ENV['DB_PASSWORD'] ?? null;

    if (!$host || !$dbname || !$user || !$password) {
        throw new Exception("Missing DB credentials");
    }

    return new PDO(
        "pgsql:host=$host;dbname=$dbname",
        $user,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (Throwable $e) {
    error_log("❌ DATABASE ERROR: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'message' => 'Internal server error (DB connection)',
        'error' => $e->getMessage()
    ]);
    exit; // ✅ ensure this stops everything if it fails
}