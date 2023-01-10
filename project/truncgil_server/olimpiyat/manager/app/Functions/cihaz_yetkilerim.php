<?php function cihaz_yetkilerim() {
    $u = u();
    return db("yetkiler")->where("alias",$u->alias)
    ->groupBy("imei")
    ->pluck("imei")->toArray();
} ?>