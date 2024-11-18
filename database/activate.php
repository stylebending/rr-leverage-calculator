<?php
session_start();
// Change this to your connection info.
require_once 'config.php';

$con = "sqlite:$db";

try {
  $pdo = new PDO($con);
} catch (PDOException $e) {
  echo $e->getMessage();
}
// Try and connect using the info above.
$pdo = new PDO($con);

// First we check if the email and code exists...
if (isset($_GET['email'], $_GET['code'])) {
  if ($stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email AND activation_code = :activation_code')) {
    $stmt->execute([
      ':email' => htmlspecialchars($_GET['email']),
      ':activation_code' => htmlspecialchars($_GET['code'])
    ]);
    $result = $stmt->fetch();
    // Store the result so we can check if the account exists in the database.
    if ($result !== false) {
      // Account exists with the requested email and code.
      if ($stmt = $pdo->prepare('UPDATE users SET activation_code = :newcode WHERE email = :email AND activation_code = :activation_code')) {
        // Set the new activation code to 'activated', this is how we can check if the user has activated their account.
        $newcode = 'activated';
        $stmt->execute([
          ':newcode' => $newcode,
          ':email' => htmlspecialchars($_GET['email']),
          ':activation_code' => htmlspecialchars($_GET['code'])
        ]);
        $_SESSION['success'] = 'Je account is geactiveerd, je kan nu inloggen.';
        header('Location: ../');
      }
    } else {
      echo 'The account is already activated or doesn\'t exist!';
      $_SESSION['message'] = 'Je account bestaat niet of is al geactiveerd, probeer in te loggen.';
      header('Location: ../');
    }
  }
}
