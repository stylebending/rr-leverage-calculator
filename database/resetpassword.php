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

if (isset($_GET['code']) && isset($_GET['email']) && !isset($_POST['password']) && !isset($_POST['cpassword'])) {
  if ($stmt = $pdo->prepare('SELECT resetpw FROM users')) {
    $stmt->execute();
    $result = $stmt->fetchAll();
    $exists = false;
    foreach ($result as $r) {
      if ($r['resetpw'] == $_GET['code']) {
        $exists = true;
      }
    }
    if ($exists !== true) {
      $_SESSION['message'] = 'This link is invalid.';
      header('Location: ../resetpassword.php');
      exit();
    }
  }
} else if (isset($_POST['email']) && !isset($_GET['code']) && !isset($_POST['password']) && !isset($_POST['cpassword'])) {
  if ($stmt = $pdo->prepare('SELECT email FROM users')) {
    $stmt->execute();
    $exists = false;
    $result = $stmt->fetchAll();
    foreach ($result as $r) {
      if ($r['email'] == $_POST['email']) {
        $exists = true;
      }
    }
    if ($exists == false) {
      $_SESSION['message'] = 'This email address does not have an account, please fill in your email address or sign up.';
      header('Location: ../resetpassword.php');
      exit();
    } else {
      if ($stmt = $pdo->prepare('UPDATE users SET resetpw = :activation_code WHERE email = :email')) {
        // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
        $uniqid = uniqid();
        $stmt->execute([
          ':email' => $_POST['email'],
          ':activation_code' => $uniqid
        ]);
        $from    = 'resetpassword@besterestaurantsnederland.nl';
        $subject = 'Reset Password';
        $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
        // Update the activation variable below
        $activate_link = 'https://besterestaurantsnederland.nl/reset-password.php?email=' . htmlspecialchars($_POST['email']) . '&code=' . $uniqid;
        $message = '<p>Click on this link to reset your password: <a href="' . $activate_link . '">' . $activate_link . '</a></p>';
        mail($_POST['email'], $subject, $message, $headers);
        $_SESSION['success'] = 'Check your mailbox to change your password!';
        header('Location: ../resetpassword.php');
        exit();
      } else {
        // Something is wrong with the SQL statement, so you must check to make sure your accounts table exists with all three fields.
        $_SESSION['message'] = 'Something went wrong, please try again.';
        header('Location: ../resetpassword.php');
        exit();
      }
    }
  }
} else if (isset($_POST['email']) && isset($_POST['code']) && isset($_POST['password']) && isset($_POST['cpassword'])) {
  if ($_POST['password'] !== $_POST['cpassword']) {
    $_SESSION['message'] = 'Passwords do not match, please try again.';
    header('Location: ../reset-password.php');
    exit();
  } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
    $_SESSION['message'] = 'Password must contain between 5 and 20 characters.';
    header('Location: ../reset-password.php');
    exit();
  }
  if ($stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email AND resetpw = :activation_code')) {
    $stmt->execute([
      ':email' => htmlspecialchars($_POST['email']),
      ':activation_code' => htmlspecialchars($_POST['code'])
    ]);
    $result = $stmt->fetch();
    // Store the result so we can check if the account exists in the database.
    if ($result !== false) {
      // Account exists with the requested email and code.
      if ($stmt = $pdo->prepare('UPDATE users SET resetpw = :newcode, password = :password WHERE email = :email AND resetpw = :activation_code')) {
        // Set the new activation code to 'activated', this is how we can check if the user has activated their account.
        $newcode = NULL;
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt->execute([
          ':newcode' => $newcode,
          ':password' => $password,
          ':email' => htmlspecialchars($_POST['email']),
          ':activation_code' => htmlspecialchars($_POST['code'])
        ]);
        $_SESSION['success'] = 'Your password has been reset, use it from now on to log in.';
        header('Location: ../login.php');
        exit();
      }
    } else {
      $_SESSION['message'] = 'Something went wrong, please try again.';
      header('Location: ../login.php');
      exit();
    }
  } else {
    $_SESSION['message'] = 'Something went wrong, please try again.';
    header('Location: ../login.php');
    exit();
  }
}
