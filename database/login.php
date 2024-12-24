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
  $_SESSION['message'] = 'Fill in all fields.';
}

$pdo = new PDO($con);
if (isset($_POST['registercheckbox']) == "on") {
  // Register a user
  // We need to check if the account with that username exists.
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $_SESSION['message'] = 'Fill in a correct email address.';
    header('Location: ../login.php');
    exit();
  }
  if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
    $_SESSION['message'] = 'Password must contain between 5 and 20 characters.';
    header('Location: ../login.php');
    exit();
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
      $_SESSION['message'] = 'This email address already has an account, try to login.';
      header('Location: ../login.php');
      exit();
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
        $subject = 'Account Activation';
        $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
        // Update the activation variable below
        $activate_link = 'https://besterestaurantsnederland.nl/database/activate.php?email=' . htmlspecialchars($_POST['email']) . '&code=' . $uniqid;
        $message = '<p>Click on this link to activate your account: <a href="' . $activate_link . '">' . $activate_link . '</a></p>';
        mail($_POST['email'], $subject, $message, $headers);
        $_SESSION['success'] = 'Check your mailbox to activate your account!';
        header('Location: ../');
        exit();
      } else {
        // Something is wrong with the SQL statement, so you must check to make sure your accounts table exists with all three fields.
        $_SESSION['message'] = 'Something went wrong, please try again.';
        header('Location: ../login.php');
        exit();
      }
    }
  } else {
    // Something is wrong with the SQL statement, so you must check to make sure your accounts table exists with all 3 fields.
    $_SESSION['message'] = 'Something went wrong, please try again.';
    header('Location: ../login.php');
    exit();
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
        exit();
      } else {
        // Incorrect password
        $_SESSION['message'] = 'Wrong password.';
        header('Location: ../login.php');
        exit();
      }
    } else {
      // Account is not activated
      $_SESSION['message'] = 'Activate your account before you can continue, check your mailbox.';
      header('Location: ../login.php');
      exit();
    }
  } else {
    // Incorrect email 
    $_SESSION['message'] = 'Wrong email address entered or no account associated with this email address.';
    header('Location: ../login.php');
    exit();
  }
}
