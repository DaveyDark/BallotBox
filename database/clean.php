
<?php

require_once __DIR__ . '/../includes/dbh.inc.php';

try {
  $sql = $pdo->prepare('DROP DATABASE IF EXISTS ballot_box;');
  $sql->execute();

  echo "Database wiped\n";
} catch (PDOException $e) {
  die("DB ERROR: " . $e->getMessage());
}
