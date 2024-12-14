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

function checkAccount($actKey, $actSec)
{
  $now = time();
  $h = date("H", $now);
  $i = date("i", $now) + 1;
  $s = date("s", $now);
  $m = date("m", $now);
  $d = date("d", $now);
  $y = date("Y", $now);
  $expiry = mktime($h, $i, $s, $m, $d, $y);
  $startMonth = date("m", strtotime("-2 months"));
  $start = mktime($h, $i, $s, $startMonth, $d, $y);
  $requestPath = "/exchange/order/v2/orderList";
  $queryString = "?currency=USDT&ordStatus=7&start=" . $start . "000" . "&end=" . $now . "000" . "&offset=0&limit=200";
  $stringToHash = $requestPath . substr($queryString, 1) . $expiry;
  $signature = hash_hmac('sha256', $stringToHash, $actSec);
  $context = stream_context_create([
    'http' => [
      'method' => 'GET',
      'header' => [
        'Content-Type: application/json',
        'x-phemex-access-token: ' . $actKey,
        'x-phemex-request-expiry: ' . $expiry,
        'x-phemex-request-signature: ' . $signature
      ],
    ]
  ]);
  $response = file_get_contents('https://api.phemex.com' . $requestPath . $queryString, false, $context);
  $responseData = json_decode($response, true);
  if ($responseData['code'] !== NULL) {
    return true;
  } else {
    return false;
  }
}

if (!empty($_POST['apikey']) && !empty($_POST['apisecret']) && checkAccount($_POST['apikey'], $_POST['apisecret']) == true) {
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
    } else if ($result == false && checkAccount($_POST['apikey'], $_POST['apisecret']) == true) {
      // API Key doesn't exists, insert new account
      $stmt = $pdo->prepare('SELECT apiks FROM users WHERE email = :email');
      $stmt->execute([
        ':email' => $_SESSION['email']
      ]);
      $apiks = $stmt->fetchAll();
      $dbapiks = $apiks[0]['apiks'];
      $newapiks = json_encode([openssl_encrypt($_POST['apikey'], $cipher_algo, $key) => openssl_encrypt($_POST['apisecret'], $cipher_algo, $key)]);
      $newdbapiks = $dbapiks . $newapiks;
      if ($stmt = $pdo->prepare('UPDATE users SET apiks = :apiks WHERE email = :email')) {
        $stmt->execute([
          ':apiks' => $newdbapiks,
          ':email' => htmlspecialchars($_SESSION['email'])
        ]);
        $_SESSION['success'] = 'Account toegevoegd!';
        header('Location: ../dashboard.php');
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
  $_SESSION['message'] = 'Vul beide velden correct in.';
  header('Location: ../addaccount.php');
}
