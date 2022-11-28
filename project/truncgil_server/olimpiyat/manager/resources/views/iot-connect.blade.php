<?php 
//izin verilen server adresleri
$secret_key = "olimpiyat_truncgil1854sa!";
$hash = get("hash");
$current_hash = hash("sha256",$secret_key . get("imei"));
//echo "$hash $current_hash ";
$allow = explode(",","185.149.103.78");
$this_remote = $_SERVER['REMOTE_ADDR'];
$imei = (int) get("imei");

if($hash == $current_hash) {
    if(getisset("log")) {
        $log = get("log");
        if($log!="" && $imei!="") {
            ekle([
                'imei' => $imei,
                'html' => $log
            ],"cihaz_log");
            echo "$imei=>$log is add";
            
            $command = explode("->",$log);
            Log::info($command);
            if(count($command)==2) {

                db("contents")
                    ->where("imei", $imei)
                    ->where("json", $command[1])
                    ->update([
                        'sonuc'=> $command[1],
                        'sonuc_date' => date("Y-m-d H:i:s")
                    ]);

               // Log::info("test");
            }
            
        }

    } else {
        if(!getesit("imei","")) {
            if($imei!="") {
                try {
                    ekle([
                        'imei' => $imei,
                        'online' => date("Y-m-d H:i:s")
                    ],"cihazlar");
                    echo "insert";
                } catch (\Throwable $th) {
                    db("cihazlar")
                    ->where("imei",$imei)
                    ->update([
                        'online' => date("Y-m-d H:i:s")
                    ]);
                     ?>
                     @include("last-status")
                     <?php 
                   // echo "update";
                }
            } else {
                echo "error imei";
            }
            
        } else {
            echo "imei not null";
        }
    }
    
        

    
    
} else {
    echo "auth error";
}
 ?>