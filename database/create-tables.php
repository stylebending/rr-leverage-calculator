<?php

require_once 'config.php';

$statements = [
  'CREATE TABLE IF NOT EXISTS `users` (
	`id` int(11) NOT NULL UNIQUE,
  `email` varchar(100) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `apiks` text UNIQUE,
   PRIMARY KEY (`id`)
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
