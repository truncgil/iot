<?php 

$db = db("komut_istemi")
->where("imei",get("imei"))
->whereIn("alt_type",['digital-input'])
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
    $hex = substr(trim($return),$d->bas,$d->son - $d->bas);
 //   dump($d->title);
   // dump($hex);
    $decimal = intval($hex,16);
  //  dump($decimal);
    $dizi[$d->id]['decimal'] = $decimal;

     
    $_GET['imei'] = $d->imei;
    $_GET['command'] = $d->json;
    $_GET['sonuc'] = $return;
    sleep(3);
     ?>

     @include("admin-ajax.komut-son-durum-guncelle")
     <?php 
}
//dump($dizi);
echo json_encode_tr($dizi);

?>