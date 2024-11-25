<?php
session_start();

require_once 'config.php';

$con = "sqlite:$db";

try {
  $pdo = new PDO($con);
} catch (PDOException $e) {
  echo $e->getMessage();
}

$pdo = new PDO($con);

$result = false;

$cipher_algo = 'AES-256-CBC';
$key = 'fejJoPDtzZF7u6gwGYzS8QOIRK0A8c0r';

if (!empty($_POST['apikey']) || !empty($_POST['apisecret'])) {
  if ($stmt = $pdo->prepare('SELECT apiks FROM users')) {
    // Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
    $stmt->execute();
    $apiks = $stmt->fetchAll();
    foreach ($apiks as $newapiks) {
      $dbapiks = $newapiks['apiks'];
      if ($dbapiks !== null) {
        $explodeddbapiks = explode('}', $dbapiks);
        foreach ($explodeddbapiks as $explodeddbkey => $value) {
          $valuetodecode = json_decode($value . "}");
          if ($valuetodecode !== null) {
            foreach ($valuetodecode as $dbkey => $value) {
              if (openssl_decrypt($dbkey, $cipher_algo, $key) === $_POST['apikey']) {
                $result = true;
              }
            }
          }
        }
      }
    }
    if ($result !== false) {
      // API Key already exists
      $_SESSION['message'] = 'Deze API Key is al gekoppeld aan een account.';
      header('Location: ../addaccount.php');
    } else {
      // API Key doesn't exists, insert new account
      $stmt = $pdo->prepare('SELECT apiks FROM users WHERE email = :email');
      $stmt->execute([
        ':email' => $_SESSION['email']
      ]);
      $apiks = $stmt->fetchAll();
      $dbapiks = $apiks[0]['apiks'];
      $newapiks = json_encode([openssl_encrypt($_POST['apikey'], $cipher_algo, $key) => openssl_encrypt($_POST['apisecret'], $cipher_algo, $key)]);
      // $newapiks = json_encode([password_hash($_POST['apikey'], PASSWORD_DEFAULT) => password_hash($_POST['apisecret'], PASSWORD_DEFAULT)]);
      $newdbapiks = $dbapiks . $newapiks;
      if ($stmt = $pdo->prepare('UPDATE users SET apiks = :apiks WHERE email = :email')) {
        // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
        $stmt->execute([
          ':apiks' => $newdbapiks,
          ':email' => htmlspecialchars($_SESSION['email'])
        ]);
        $_SESSION['success'] = 'Account toegevoegd!';
        header('Location: ../');
      } else {
        // Something is wrong with the SQL statement, so you must check to make sure your accounts table exists with all three fields.
        $_SESSION['message'] = 'Er is iets fout gegaan, probeer het opnieuw.';
        header('Location: ../addaccount.php');
      }
    }
  } else {
    // Something is wrong with the SQL statement, so you must check to make sure your accounts table exists with all 3 fields.
    $_SESSION['message'] = 'Er is iets fout gegaan, probeer het opnieuw.';
    header('Location: ../addaccount.php');
  }
} else {
  $_SESSION['message'] = 'Vul beide velden in.';
  header('Location: ../addaccount.php');
}
