<?php 
$data = [
    'imei'=>get("imei"),
    'command' => 0
];
$return =  httpClient("http://app.olimpiyat.com.tr/client.php",$data);
echo $return;
?>