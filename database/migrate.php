<?php

require_once __DIR__ . '/../includes/dbh.inc.php';

try {
  $creationFile = __DIR__ . '/creation.sql';
  $sql = file_get_contents($creationFile);

  $pdo->exec($sql);

  echo "Database created successfully\n";

  // $sampleDataFile = __DIR__ . '/sample.sql';
  // $sql = file_get_contents($sampleDataFile);

  // $dataFile = __DIR__ . '/data.sql';
  // $sql .= file_get_contents($dataFile);

  // $pdo->exec($sql);
  // echo "Data added successfully\n";
} catch (PDOException $e) {
  die("DB ERROR: " . $e->getMessage());
}
