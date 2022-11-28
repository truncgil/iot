<?php 
if(!isset($imei)) $imei = get("imei");
$sql = db("contents")
    ->select("id","imei","json","json2","bag","sonuc","sonuc_date")
    ->where("imei",$imei)
    ->whereIn("alt_type",['onoff'])
    ->where("standup","1")
    ->whereNotNull("bag")
    ->orderBy("sonuc_date","ASC")
    ->get();

$send = [];
$data = [];
$data2 = [];
//dd($sql);

    //refactor from id
    foreach($sql AS $s) {
        $data[$s->id] = $s;
    }

    foreach($sql AS $s) {
        $on = str_replace(" ","",strtolower($s->json));
        $off = str_replace(" ","",strtolower($s->json2));
     //   echo "$on $off {$s->sonuc}";
        if($s->sonuc==$on) {
            $value = $s->json;
        } else {
            $value = $s->json2;
        }
        $data2[] = $value;
    }
    
echo json_encode_tr(array_values($data2));
?>