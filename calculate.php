<?php

// Checken of alles is ingevuld
if (isset($_GET['entry']) && isset($_GET['tp']) && isset($_GET['tpp']) && isset($_GET['risk'])) {
  // foreach ($tps as $tp) {
  //   $startBedragKeerDitVoorEindbedrag = 1 + ((((($entry - $tp) / $tp) * 100) * ($tpp / 100)) / 100);
  // }

  // JSON response terug geven met data
  echo json_encode(['error' => 'Data passing is gelukt']);
} else {
  // Als niet alles is ingevuld een error terug sturen
  echo json_encode(['error' => 'Er is iets fout gegaan, voeg één of meerdere TPs toe, vul alle velden in en probeer het opnieuw.']);
}
