@include("admin.dashboard.inc.dashboard-css")

<div class="content">    
    <div class="row komutlar">
        <?php $yetkilerim = cihaz_yetkilerim();
        $cihazlar = db("cihazlar")->whereIn("imei",$yetkilerim)
        ->orderBy("online","DESC")
        ->get();
        $komutlar = db("contents")
            ->where("type","Komut İstemi")
            ->where("y",1)
            ->whereIn("imei",$yetkilerim);
        if(!getesit("imei","")) {
            $komutlar = $komutlar->where("imei",get("imei"));
        }
        $komutlar = $komutlar
            ->orderBy("s","ASC")->get();
         ?>
          {{col("col-12","Cihaz Bilgisi")}} 
            <select name="" onchange="location.href='?imei='+$(this).val()" id="" class="form-control">
                <option value="">Tüm Cihazlar</option>
                <?php foreach($cihazlar AS $c)  { 
                  ?>
                 <option value="{{$c->imei}}" <?php if(getesit("imei",$c->imei)) echo "selected"; ?>>{{$c->title}} {{$c->imei}} ({{zf($c->online)}})</option> 
                 <?php } ?>
            </select>
          {{_col()}}
         <?php 
        foreach($komutlar AS $c)  { 
            $lastValue = $c->sonuc;
            $imei = $c->imei;

            $commandClass = "command" . strtolower(str_replace(" ","",$c->json));
         ?>
         {{col("col-md-4 col-12 widget {$c->alt_type}-widget text-center widget-".$c->id . " $commandClass", $c->title)}} 
        <?php if($c->alt_type=="read" || $c->alt_type=="") { ?>
            <div class="btn btn-primary d-none  widget-guncelle" 
                data-imei="{{$c->imei}}" 
                data-command="{{$c->json}}" 
                data-id="{{$c->id}}" 
                data-maks="{{$c->maks}}" 
                data-mask="{{$c->mask}}" 
                data-bas="{{$c->bas}}" 
                data-son="{{$c->son}}" 
                
                
                style="position: absolute;
    right: 25px;
    top: 10px;"><i class="fa fa-refresh"></i></div>
        <?php } ?>
        <div class="bag d-none">{{$c->bag}}</div>
         <?php $c2 = $c; ?>
            @include("admin.inc.widget")
                
                

         {{_col()}} 
         <?php } ?>
    </div>
</div>

<style>

    .chart table {
        margin: 0 auto !important;
    }
</style>
@include("admin.dashboard.inc.anlik-guncelle")