<?php
$filename ="excelreport.xls";
$contents = "çşğüĞŞİÇÇİŞĞP \t testdata2 \t testdata3 \t \n";
$contents .= "çşğüĞŞİÇÇİŞĞP \t testdata2 \t testdata3 \t \n";
$contents .= "çşğüĞŞİÇÇİŞĞP \t testdata2 \t testdata3 \t \n";
$contents .= "çşğüĞŞİÇÇİŞĞP \t testdata2 \t testdata3 \t \n";
$contents .= "çşğüĞŞİÇÇİŞĞP \t testdata2 \t testdata3 \t \n";
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$filename);
echo $contents;
 ?>