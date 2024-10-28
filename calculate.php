<?php

// Checken of alles is ingevuld
if (isset($_GET['entry']) && isset($_GET['risk'])) {
  // Entry en Risk input in een variable zetten
  $entry = $_GET['entry'];
  $risk = $_GET['risk'];

  // Entry en Risk uit de GET superglobal halen
  unset($_GET['entry']);
  unset($_GET['risk']);

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
  $rr = $wp / $risk;

  // JSON response terug geven met data
  echo json_encode([
    'resdata' => true,
    'entry' => $entry,
    'risk' => $risk,
    'wp' => $wp,
    'rr' => $rr
  ]);
} else {
  // Als niet alles is ingevuld een error terug sturen
  echo json_encode(['error' => 'Er is iets fout gegaan, voeg één of meerdere TPs toe, vul alle velden in en probeer het opnieuw.']);
}
