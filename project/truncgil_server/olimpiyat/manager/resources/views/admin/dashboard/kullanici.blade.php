@include("admin.dashboard.inc.dashboard-css")
<div class="modal" id="tumunu-guncelle-modal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">


      <!-- Modal body -->
      <div class="modal-body text-center">
        <i style="font-size:50px;" class="fa fa-spin fa-spinner"></i> <br>
        Güncelleniyor. Lütfen bekleyiniz...
      </div>



    </div>
  </div>
</div>
<div class="content">    
    <div class="row komutlar">
        <?php $yetkilerim = cihaz_yetkilerim();
        $cihazlar = db("cihazlar")->whereIn("imei",$yetkilerim)
        ->orderBy("online","DESC")
        ->get();
        $komutlar = db("komut_istemi")
            
            ->where("y",1)
            ->whereIn("imei",$yetkilerim);
        if(!getesit("imei","")) {
            $komutlar = $komutlar->where("imei",get("imei"));
        }
        $komutlar = $komutlar
            ->orderBy("s","ASC")->get();
         ?>
          {{col("col-12","Cihaz Bilgisi")}} 
          <div class="row">
            <div class="col-md-2">
                <div class="btn btn btn-secondary is-online btn-block"><i class="fa fa-spin fa-spinner"></i></div>
            </div>
            <div class="col-md-4">
                <select name="" onchange="location.href='?imei='+$(this).val()" id="" class="form-control">
                    <option value="">Cihaz seçiniz</option>
                    <?php foreach($cihazlar AS $c)  { 
                    ?>
                    <option value="{{$c->imei}}" <?php if(getesit("imei",$c->imei)) echo "selected"; ?>>{{$c->title}} {{$c->imei}} ({{zf($c->online)}})</option> 
                    <?php } ?>
                </select>
            </div>
            <?php if(getisset("imei"))  { 
              ?>
                <div class="col-12 col-xl-6 col-centered">
                        <div 
                            class="btn  btn-info btn-block"
                            id="tumunu-guncelle"
                        >
                            <i class="fa fa-refresh"></i> Göstergeleri Güncelle
                        </div>
                        
                </div>
                 <script>
                     $(function(){
                            function isOnline() {
                                $.get("?ajax=is-online",{
                                    imei : "{{get("imei")}}",
                                    command : "0"
                                }, function(d){
                                    if(d.trim()=="30") {
                                        $("#tumunu-guncelle").hide();
                                        $("#digital-inputs-guncelle").hide();
                                        $(".is-online").removeClass("btn-secondary");
                                        $(".is-online").removeClass("btn-success");
                                        $(".is-online").addClass("btn-danger").html("Pasif");
                                        $(".css-control,.reset").addClass("disabled");
                                    } else {
                                        $("#tumunu-guncelle").show();
                                        $("#digital-inputs-guncelle").show();
                                        $(".is-online").removeClass("btn-secondary");
                                        $(".is-online").removeClass("btn-danger");
                                        $(".is-online").addClass("btn-success").html("Aktif");
                                        $(".css-control,.reset").removeClass("disabled");
                                    }
                                });
                            }

                            isOnline();

                            setInterval(function(){
                                isOnline();
                            },60000);
                            
                         $("#tumunu-guncelle").on("click", function(){
                             var bu = $(this);
                             var html = bu.html();
                             bu.html("Güncelleniyor...");
 
                             $('#tumunu-guncelle-modal').modal({
                                 backdrop: 'static', 
                                 keyboard: false
                             });
                               
                             $.get('?ajax=tumunu-guncelle',{
                                 imei : "{{get("imei")}}"
                             },function(d){
                                location.reload();
                                 bu.html(html);
                                
                                 console.log(d);
                             })
                         });
                         $("#digital-inputs-guncelle").on("click", function(){
                             var bu = $(this);
                             var html = bu.html();
                             bu.html("Güncelleniyor...");
 
                             $('#tumunu-guncelle-modal').modal({
                                 backdrop: 'static', 
                                 keyboard: false
                             });
                               
                             $.get('?ajax=digital-inputs-guncelle',{
                                 imei : "{{get("imei")}}"
                             },function(d){
                                    location.reload();
                                 bu.html(html);
                                 
                                 console.log(d);
                             });
                         });
                     });
                 </script>
 
              
             <?php } ?>
          </div>
                


            
          {{_col()}}
          <?php if(getisset("imei"))  { 
            ?>
          <?php 
          $digitalInputs = [];
         foreach($komutlar AS $c)  { 
             $lastValue = $c->sonuc;
             $imei = $c->imei;
 
             $commandClass = "command" . strtolower(str_replace(" ","",$c->json));
          ?>
          <?php 
if($c->alt_type=="") {
    $type = "read";
} else {
    $type = $c->alt_type;
}

if($type=="digital-input") {
    $digitalInputs[] = $c;
}
 ?>
    @if(View::exists("admin.inc.widget.$type"))
            {{col("col-md-4 col-12 widget order-2 {$c->alt_type}-widget text-center widget-".$c->id . " $commandClass", $c->title)}} 
           
            <?php if($c->alt_type=="read" || $c->alt_type=="") { ?>
                    <div class="btn btn-default  widget-guncelle" 
                        data-imei="{{$c->imei}}" 
                        data-command="{{$c->json}}" 
                        data-id="{{$c->id}}" 
                        data-maks="{{$c->maks}}" 
                        data-mask="{{$c->mask}}" 
                        data-carpan="{{$c->carpan}}" 
                        data-bas="{{$c->bas}}" 
                        data-son="{{$c->son}}" 
                        
                        
                        style="position: absolute;
                        right: 25px;
                        z-index:1000;
                        top: 10px;"><i class="fa fa-refresh"></i></div>
            <?php } ?>

            <div class="bag d-none">{{$c->bag}}</div>
            <?php $c2 = $c; ?>
            @include("admin.inc.widget.$type")
            {{_col()}} 
    @endif

          <?php } ?> 
          <?php if(count($digitalInputs)>0) {
             ?>
             @include("admin.inc.widget.digital-inputs")
             <?php 
          } ?>
           <?php } else {
             ?>
                <?php foreach($cihazlar AS $y) {
                ?>

                
                    <div class="col-12 col-md-4 col-xl-4">
                        <a class="block block-link-shadow text-center" href="?imei={{$y->imei}}">

                            <div class="block-content block-sticky-options">
                                <div class="block-options">
                                    <?php $durum = strtotime(date("Y-m-d H:i:s")) - strtotime($y->online);
                                    if($durum<500)  {  ?>
                                     <i title="Cihaz şu an aktif" class="si si-globe fa-2x text-success"></i> 
                                     <?php } ?>
                                </div>
                                <p class="mt-5">
                                    <i class="fa fa-wifi fa-4x text-info"></i> <br>
                                    <small>{{zf($y->online)}}</small>
                                </p>

                               
                            </div>
                            <div class="block-content bg-body-light">
                               
                                <p class="font-w600">{{$y->title}} {{$y->imei}}</p>
                            </div>
                        </a>
                    </div>
                <?php 
                } ?>
             <?php  
           } ?>
    </div>
</div>

<style>

    .chart table {
        margin: 0 auto !important;
    }
</style>
@include("admin.dashboard.inc.anlik-guncelle")