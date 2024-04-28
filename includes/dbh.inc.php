<?php
$dsn = "mysql:host=localhost;dbname=ballot_box";
$dbusername = "root";
$dbpassword = "";

try {
  $pdo = new PDO($dsn, $dbusername, $dbpassword);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("DB ERROR: " . $e->getMessage());
}

function getPoll($pdo, $poll) {
  $stmt = $pdo->prepare("SELECT * FROM boxes WHERE id = :id");
  $stmt->bindParam(':id', $poll);
  $stmt->execute();
  return $stmt->fetch();
}

function getBallots($pdo, $box) {
  $stmt = $pdo->prepare("SELECT * FROM ballots WHERE box_id = :box_id");
  $stmt->bindParam(':box_id', $box);
  $stmt->execute();
  return $stmt->fetchAll();
}

function getBallotById($pdo, $ballot) {
  $stmt = $pdo->prepare("SELECT name FROM ballots WHERE id = :id");
  $stmt->bindParam(':id', $ballot);
  $stmt->execute();
  return $stmt->fetch();
}

function getUserPolls($pdo, $user) {
  $stmt = $pdo->prepare("SELECT * FROM boxes WHERE user_id = :user_id");
  $stmt->bindParam(':user_id', $user);
  $stmt->execute();
  return $stmt->fetchAll();
}

function countVotes($pdo, $box) {
  $stmt = $pdo->prepare("SELECT COUNT(*) FROM votes WHERE box_id = :box_id");
  $stmt->bindParam(':box_id', $box);
  $stmt->execute();
  return $stmt->fetchColumn();
}