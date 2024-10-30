<?php

// Check if everything neccessary is set
if (isset($_GET['entry']) && isset($_GET['sl'])) {
  // Entry en SL input in een variable zetten
  $entry = $_GET['entry'];
  $sl = $_GET['sl'];
  if (isset($_GET['fees'])) {
    $fees = $_GET['fees'];
    unset($_GET['fees']);
  }

  // Remove Entry and SL from the GET superglobal
  unset($_GET['entry']);
  unset($_GET['sl']);

  // Define Tp arrays and wp (profit percentage)
  $tpArr = [];
  $tppArr = [];
  $result = [];
  $wp = 0;

  // Fill tpArr
  foreach ($_GET as $key => $value) {
    if (str_contains($key, 'tp-input')) {
      array_push($tpArr, ((($value - $entry) / $entry) * 100));
    }
  }

  // Fill tppArr
  foreach ($_GET as $key => $value) {
    if (str_contains($key, 'tpp-input')) {
      array_push($tppArr, ($value / 100));
    }
  }

  // Multiply tpArr and tppArr
  foreach ($tpArr as $key => $value) {
    $result[$key] = $value * $tppArr[$key];
  }

  // Calculate total profit percentage
  $wp = array_sum($result);

  // Calculate total profit percentage including fees
  $wpf = array_sum($result) * 0.93;

  // Calculate final RR
  $rr = $wp / $sl;

  // Calculate final RR including fees
  $rrf = $wpf / $sl;

  // Return JSON response with data
  if (array_sum($tppArr) >= 0.0001 && array_sum($tppArr) <= 1 && !isset($fees)) {
    echo json_encode([
      'resdata' => true,
      'wp' => abs(round($wp, 2)),
      'rr' => abs(round($rr, 2))
    ]);
  } else if (array_sum($tppArr) >= 0.0001 && array_sum($tppArr) <= 1 && $fees == "on") {
    echo json_encode([
      'resdata' => true,
      'wp' => abs(round($wpf, 2)),
      'rr' => abs(round($rrf, 2))
    ]);
  } else {
    echo json_encode(['error' => 'Het totaal van de TPs % moet tussen de 0.01% en 100% zijn.']);
  }
} else if (isset($_GET['risk']) && isset($_GET['stoploss'])) {  
  if (isset($_GET['levfees'])) {
    $levfees = $_GET['levfees'];
    unset($_GET['levfees']);
  }
  if (!isset($levfees)) {
    $leverage = round(($_GET['risk'] / $_GET['stoploss']), 2);
    echo json_encode([
      'levdata' => true,
      'lev' => $leverage
    ]);
  } else if ($levfees == "on") {
    $leverage = round(($_GET['risk'] / ($_GET['stoploss'] + 0.08)), 2);
    echo json_encode([
      'levdata' => true,
      'lev' => $leverage
    ]);
  }
} else {
  // If all the fields are not set return an error message
  echo json_encode(['error' => 'Er is iets fout gegaan, voeg één of meerdere TPs toe, vul alle velden in en probeer het opnieuw.']);
}
