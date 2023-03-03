<?php 
$firstReadData = db("komut_istemi")->where("imei", get("imei"))->where("alt_type","read")->first();
$data = [
    'imei'=>get("imei"),
    'command' => $firstReadData->json
];
//dump($data);
$return =  httpClient("http://app.olimpiyat.com.tr/client.php",$data);
echo $return;
?>