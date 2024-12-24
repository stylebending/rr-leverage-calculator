<?php

require_once 'config.php';

$statements = [
  'ALTER TABLE `users`
ADD COLUMN `resetpw` TEXT DEFAULT NULL;'
];

// connect to the SQLite databse
$dsn = "sqlite:$db";

// create a PDO instance
try {
  $pdo = new \PDO($dsn);

  // create tables
  foreach ($statements as $statement) {
    $pdo->exec($statement);
  }
} catch (\PDOException $e) {
  echo $e->getMessage();
}
