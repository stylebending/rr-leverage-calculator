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

if (isset($_POST['email'])) {
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $_SESSION['message'] = 'Fill in a correct email address.';
    header('Location: ../profile.php');
    exit();
  }
  if ($stmt = $pdo->prepare('SELECT id, password FROM users WHERE email = :email')) {
    // Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
    $stmt->execute([
      ':email' => htmlspecialchars($_POST['email'])
    ]);
    $result = $stmt->fetch();
    // Store the result so we can check if the email exists in the database.
    if ($result !== false) {
      // EMail already exists
      $_SESSION['message'] = 'This email address already has an account, try another email address.';
      header('Location: ../profile.php');
      exit();
    } else {
      // Email doesn't exists, insert new email 
      if ($stmt = $pdo->prepare('UPDATE users SET activation_code = :activation_code WHERE email = :email')) {
        // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
        $uniqid = uniqid();
        $stmt->execute([
          ':email' => $_SESSION['email'],
          ':activation_code' => $uniqid
        ]);
        $from    = 'confirmation@besterestaurantsnederland.nl';
        $subject = 'Email confirmation';
        $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
        // Update the activation variable below
        $activate_link = 'https://besterestaurantsnederland.nl/database/confirmemail.php?email=' . htmlspecialchars($_POST['email']) . '&code=' . $uniqid;
        $message = '<p>Click on this link to confirm your email address: <a href="' . $activate_link . '">' . $activate_link . '</a></p>';
        mail($_POST['email'], $subject, $message, $headers);
        $_SESSION['success'] = 'Check your mailbox to confirm your email address!';
        header('Location: ../profile.php');
        exit();
      } else {
        // Something is wrong with the SQL statement, so you must check to make sure your accounts table exists with all three fields.
        $_SESSION['message'] = 'Something went wrong, please try again.';
        header('Location: ../profile.php');
        exit();
      }
    }
  } else {
    // Something is wrong with the SQL statement, so you must check to make sure your accounts table exists with all 3 fields.
    $_SESSION['message'] = 'Something went wrong, please try again.';
    header('Location: ../profile.php');
    exit();
  }
} else if (isset($_POST['password']) && isset($_POST['cpassword'])) {
  // Check for same criteria as in signup
  // If valid, change password in db and return to profile page with success message
  // Else return to profile page with password criteria
  if ($_POST['password'] == $_POST['cpassword']) {
    if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
      $_SESSION['message'] = 'Password must contain between 5 and 20 characters.';
      header('Location: ../profile.php');
      exit();
    } else if ($stmt = $pdo->prepare('UPDATE users SET password = :password WHERE email = :email')) {
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $stmt->execute([
        ':email' => htmlspecialchars($_SESSION['email']),
        ':password' => $password,
      ]);
      $_SESSION['success'] = 'Password has been changed, use it from now on to log in.';
      header('Location: ../profile.php');
      exit();
    }
  } else {
    $_SESSION['message'] = 'Passwords do not match, try again.';
    header('Location: ../profile.php');
    exit();
  }
}
