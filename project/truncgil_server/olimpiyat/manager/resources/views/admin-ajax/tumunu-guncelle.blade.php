<?php 

$db = db("contents")->where("type","Komut İstemi")
->where("imei",get("imei"))
->where("alt_type","read")
->get();
$dizi = [];
foreach($db AS $d) {
    $d->imei = trim($d->imei);
    $d->json = trim($d->json);
    $dizi[$d->id]['info'] = $d;
    $dizi[$d->id]['command'] = $d->json;
    $params = ("imei={$d->imei}&command={$d->json}");
    $data = [
        'imei'=>$d->imei,
        'command' => $d->json
    ];
    $return =  httpClient("http://app.olimpiyat.com.tr/client.php",$data);
    $dizi[$d->id]['sonuc'] = $return;
     
    $_GET['imei'] = $d->imei;
    $_GET['command'] = $d->json;
    $_GET['sonuc'] = $return;

     ?>

     @include("admin-ajax.komut-son-durum-guncelle")
     <?php 
}
//dump($dizi);
echo json_encode_tr($dizi);

?>