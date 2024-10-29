<?php

// Checken of alles is ingevuld
if (isset($_GET['entry']) && isset($_GET['sl'])) {
  // Entry en SL input in een variable zetten
  $entry = $_GET['entry'];
  $sl = $_GET['sl'];

  // Entry en SL uit de GET superglobal halen
  unset($_GET['entry']);
  unset($_GET['sl']);

  // Tp arrays en wp definen
  $tpArr = [];
  $tppArr = [];
  $result = [];
  $wp = 0;

  // tpArr vullen
  foreach ($_GET as $key => $value) {
    if (str_contains($key, 'tp-input')) {
      array_push($tpArr, ((($value - $entry) / $entry) * 100));
    }
  }

  // tppArr vullen
  foreach ($_GET as $key => $value) {
    if (str_contains($key, 'tpp-input')) {
      array_push($tppArr, ($value / 100));
    }
  }

  // tpArr en tppArr met elkaar vermenigvuldigen
  foreach ($tpArr as $key => $value) {
    $result[$key] = $value * $tppArr[$key];
  }

  // Totale winstpercentage berekenen
  $wp = array_sum($result);

  // Uiteindelijke RR berekenen
  $rr = $wp / $sl;

  // JSON response terug geven met data
  if (array_sum($tppArr) == 1) {
    echo json_encode([
      'resdata' => true,
      'wp' => abs(round($wp, 2)),
      'rr' => abs(round($rr, 2))
    ]);
  } else {
    echo json_encode(['error' => 'Het totaal van de TP % moet 100% zijn.']);
  }
} else if (isset($_GET['risk']) && isset($_GET['stoploss'])) {
  $leverage = round(($_GET['risk'] / $_GET['stoploss']), 2);
  echo json_encode([
    'levdata' => true,
    'lev' => $leverage
  ]);
} else {
  // Als niet alles is ingevuld een error terug sturen
  echo json_encode(['error' => 'Er is iets fout gegaan, voeg één of meerdere TPs toe, vul alle velden in en probeer het opnieuw.']);
}
