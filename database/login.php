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
  $_SESSION['message'] = 'Vul alle velden in.';
}

$pdo = new PDO($con);
if (isset($_POST['registercheckbox']) == "on") {
  // Register a user
  // We need to check if the account with that username exists.
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $_SESSION['message'] = 'Vul een correct email adres in.';
    header('Location: ../login.php');
  }
  if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
    $_SESSION['message'] = 'Wachtwoord moet tussen de 5 en 20 tekens bevatten.';
    header('Location: ../login.php');
  }
  if ($stmt = $pdo->prepare('SELECT id, password FROM users WHERE email = :email')) {
    // Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
    $stmt->execute([
      ':email' => htmlspecialchars($_POST['email'])
    ]);
    $result = $stmt->fetch();
    // Store the result so we can check if the account exists in the database.
    if ($result !== false) {
      // Username already exists
      $_SESSION['message'] = 'Dit email adres heeft al een account, probeer in te loggen.';
      header('Location: ../login.php');
    } else {
      // Username doesn't exists, insert new account
      if ($stmt = $pdo->prepare('INSERT INTO users (email, password, activation_code) VALUES (:email, :password, :activation_code)')) {
        // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $uniqid = uniqid();
        $stmt->execute([
          ':email' => htmlspecialchars($_POST['email']),
          ':password' => $password,
          ':activation_code' => $uniqid
        ]);
        $from    = 'activation@besterestaurantsnederland.nl';
        $subject = 'Account Activatie';
        $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
        // Update the activation variable below
        $activate_link = 'https://besterestaurantsnederland.nl/database/activate.php?email=' . htmlspecialchars($_POST['email']) . '&code=' . $uniqid;
        $message = '<p>Klik op deze link om je account te activeren: <a href="' . $activate_link . '">' . $activate_link . '</a></p>';
        mail($_POST['email'], $subject, $message, $headers);
        $_SESSION['success'] = 'Check je email adres om je account te activeren!';
        header('Location: ../');
      } else {
        // Something is wrong with the SQL statement, so you must check to make sure your accounts table exists with all three fields.
        $_SESSION['message'] = 'Er is iets fout gegaan, probeer het opnieuw.';
        header('Location: ../login.php');
      }
    }
  } else {
    // Something is wrong with the SQL statement, so you must check to make sure your accounts table exists with all 3 fields.
    $_SESSION['message'] = 'Er is iets fout gegaan, probeer het opnieuw.';
    header('Location: ../login.php');
  }
} else if (!isset($_POST['registercheckbox']) && $stmt = $pdo->prepare('SELECT id, password, activation_code FROM users WHERE email = :email')) {
  // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
  // Bind :email to user input email
  $stmt->execute([
    ':email' => htmlspecialchars($_POST['email'])
  ]);
  $result = $stmt->fetch();

  if ($result !== false) {

    $id = $result['id'];
    $password = $result['password'];

    // Account exists, now we verify the password.
    // Note: remember to use password_hash in your registration file to store the hashed passwords.
    if ($result['activation_code'] == 'activated') {
      // Account is activated
      if (password_verify($_POST['password'], $password)) {
        // Verification success! User has logged-in!
        // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
        session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['email'] = htmlspecialchars($_POST['email']);
        $_SESSION['id'] = $id;
        header('Location: ../dashboard.php');
      } else {
        // Incorrect password
        $_SESSION['message'] = 'Verkeerd wachtwoord.';
        header('Location: ../login.php');
      }
    } else {
      // Account is not activated
      $_SESSION['message'] = 'Activeer je account voordat je verder kunt, check je email.';
      header('Location: ../login.php');
    }
  } else {
    // Incorrect email 
    $_SESSION['message'] = 'Verkeerd email adres ingevoerd of nog geen account aangemaakt.';
    header('Location: ../login.php');
  }
}
