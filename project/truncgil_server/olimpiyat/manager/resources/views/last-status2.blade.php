<?php 
if(!isset($imei)) $imei = get("imei");
$sql = db("contents")
    ->select("id","imei","json","bag","sonuc","sonuc_date")
    ->where("imei",$imei)
    ->whereIn("alt_type",['write','onoff'])
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
        if(isset($data2[$s->bag.$s->id])) {
            $key = $s->bag.$s->id;
        } else {
            $key = $s->id.$s->bag;
        }
        $data2[$key] = $s->json;
    }
    //print2($data2);
    /*

    foreach($data AS $d) {
        $toggle = $data[$s->bag];
        $thisDate = strtotime($d->sonuc_date);
        $toggleDate = strtotime($toggle->sonuc_date);

        if($thisDate<$toggleDate) {
            $sendData = $toggle->json;
            $key = array_search($d->json,$send);
            unset($send[$key]);

        } else {
            $sendData = $d->json;  
            $key = array_search($toggle->json,$send);
            unset($send[$key]);
        }

        if(!in_array($sendData, $send)) {
            array_push($send, $sendData);
        }

        
        
    }
    */
 //   dd($send);
echo json_encode_tr(array_values($data2));
?>