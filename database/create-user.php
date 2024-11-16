<?php

require_once 'config.php';

$statements = [
  'INSERT INTO users (id, email, password)
  VALUES ("1", "washik@gmail.com", "$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa")'
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
