<?php 

$except = ['2d31','30'];

if(!in_array(get("sonuc"),$except)) {

    db("komut_istemi")
    ->where("imei",get("imei"))
    ->where("json",get("command"))
    ->update(
            [
                'sonuc' => get("sonuc"),
                'sonuc_date' => simdi()
            ]
        );
        
}

 ?>