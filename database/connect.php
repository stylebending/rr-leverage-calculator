<?php

session_start();

require_once 'config.php';

$con = "sqlite:$db";

try {
  $pdo = new PDO($con);
} catch (PDOException $e) {
  echo $e->getMessage();
}

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if (!isset($_POST['email'], $_POST['password'])) {
  // Could not get the data that should have been sent.
  exit('Please fill both the email and password fields!');
}

$pdo = new PDO($con);

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $pdo->prepare('SELECT id, password FROM users WHERE email = :email')) {
  // Bind :email to user input email
  $stmt->execute([
    ':email' => $_POST['email']
  ]);

  if ($stmt) {
    $result = $stmt->fetch();

    $id = $result['id'];
    $password = $result['password'];

    // Account exists, now we verify the password.
    // Note: remember to use password_hash in your registration file to store the hashed passwords.
    if (password_verify($_POST['password'], $password)) {
      // Verification success! User has logged-in!
      // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
      session_regenerate_id();
      $_SESSION['loggedin'] = TRUE;
      $_SESSION['email'] = $_POST['email'];
      $_SESSION['id'] = $id;
      header('Location: ../index.php');
    } else {
      // Incorrect password
      echo 'Incorrect username and/or password!';
    }
  } else {
    // Incorrect username
    echo 'Incorrect username and/or password!';
  }
}
