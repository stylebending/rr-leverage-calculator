<?php

require_once 'config.php';

$statements = [
  'CREATE TABLE IF NOT EXISTS `users` (
	`id` INTEGER PRIMARY KEY UNIQUE,
  `email` varchar(100) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `apiks` text UNIQUE
)'
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
