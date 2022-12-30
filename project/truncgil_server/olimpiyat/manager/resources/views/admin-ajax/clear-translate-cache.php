<?php 
$translate = db("translate")->get();
$translate2 = array();
$var = array();
foreach($translate AS $tr) {
    $translate2[$tr->dil][$tr->kr] = $tr->ceviri;
    array_push($var,$tr->dil.$tr->kr);
}
$translate = $translate2;

$_SESSION['translate'] = $translate;
$_SESSION['var'] = $var;

?>
Çeviri ön belleği temizlendi!