<?php 
echo db("komut_istemi")
    ->where("imei",get("imei"))
    ->where("json",get("command"))
    ->update(
            [
                'sonuc' => get("sonuc"),
                'sonuc_date' => simdi()
            ]
        );
 ?>