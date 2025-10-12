<?php

class SessionManager {
  private $pdo;

  public function __construct($pdo) {
    $this->pdo = $pdo;
  }

  public function generateSessionToken($userId) {
    $sessionToken = $this->createUUID();
    
    // Check if a session already exists for the user
    $checkSessionSql = "SELECT session_token FROM session WHERE user_id = :user_id";
    $checkSessionStmt = $this->pdo->prepare($checkSessionSql);
    $checkSessionStmt->execute([':user_id' => $userId]);
    $existingSession = $checkSessionStmt->fetch(PDO::FETCH_ASSOC);

    if ($existingSession) {
      // Update the existing session
      $updateSessionSql = "UPDATE session SET session_token = :session_token, updated_at = NOW() WHERE user_id = :user_id";
      $updateSessionStmt = $this->pdo->prepare($updateSessionSql);
      $updateSessionStmt->execute([
        ':session_token' => $sessionToken,
        ':user_id' => $userId
      ]);
    } else {
      // Insert a new session
      $insertSessionSql = "INSERT INTO session (session_token, user_id, created_at, updated_at) VALUES (:session_token, :user_id, NOW(), NOW())";
      $insertSessionStmt = $this->pdo->prepare($insertSessionSql);
      $insertSessionStmt->execute([
        ':session_token' => $sessionToken,
        ':user_id' => $userId
      ]);
    }

    return $sessionToken;
  }

  private function createUUID() {
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
      mt_rand(0, 0xffff), mt_rand(0, 0xffff),
      mt_rand(0, 0xffff),
      mt_rand(0, 0x0fff) | 0x4000,
      mt_rand(0, 0x3fff) | 0x8000,
      mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
  }

  public function validateSessionToken($sessionToken) {
    $sql = "SELECT user_id FROM session WHERE session_token = :session_token";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':session_token' => $sessionToken]);
    return $stmt->fetchColumn();
  }

  public function deleteSessionToken($sessionToken) {
    $sql = "DELETE FROM session WHERE session_token = :session_token";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':session_token' => $sessionToken]);
  }
}