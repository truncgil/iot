<?php 
 function export_excel($dizi, $dosya_adi) {
    $dosya_adi = (String) $dosya_adi;
    $icerik = "";
    foreach($dizi[0] AS $column => $value) {
        $icerik .= "$column\t";
    }
    $icerik .= "\r\n";
    foreach($dizi AS $column) {
        foreach($column AS $value) {
            $icerik .= "$value\t";
        }
        $icerik .= "\r\n";
    }
    return response($icerik)
    ->header('Content-type','application/ms-excel')
    ->header('Content-Disposition','attachment; filename="'.$dosya_adi.'.xls"');
} ?>