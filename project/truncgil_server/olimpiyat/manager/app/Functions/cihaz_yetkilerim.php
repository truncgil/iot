<?php function cihaz_yetkilerim() {
    $u = u();
    return db("yetkiler")
        ->orWhere("alias",$u->alias)
        ->orWhere("alias",$u->id)
        ->groupBy("imei")
        ->pluck("imei")->toArray();
} ?>