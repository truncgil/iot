@include("admin.dashboard.inc.dashboard-css")
<div class="modal rounded" id="tumunu-guncelle-modal">
  <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-content rounded">


      <!-- Modal body -->
      <div class="modal-body text-center ">
        <i style="font-size:50px;" class="fa fa-spin fa-spinner"></i> <br>
        Güncelleniyor. Lütfen bekleyiniz...
        <div class="progress mt-5">
            <div class="progress-bar" style="width:0%">0%</div>
        </div>
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
          <div class="col-md-12">
                <select name="" onchange="location.href='?imei='+$(this).val()" id="" class="form-control">
                    <option value="">Cihaz seçiniz</option>
                    <?php foreach($cihazlar AS $c)  { 
                    ?>
                    <option value="{{$c->imei}}" <?php if(getesit("imei",$c->imei)) echo "selected"; ?>>{{$c->title}} {{$c->imei}} ({{zf($c->online)}})</option> 
                    <?php } ?>
                </select>
            </div>
          </div>
          <div class="row mt-10">
            
           
            
            <?php if(getisset("imei"))  { 
              ?>
               <div class="col-md-2">
                <a class="block block-link-shadow text-center" href="javascript:void(0)">
                    <div class="block-content">
                        <p class="mt-5">
                            <i class="fa fa-wifi fa-4x text-info"></i>
                        </p>
                        <p class="font-w600 rounded is-online"><i class="fa fa-spin fa-spinner"></i></p>
                    </div>
                </a>
              
            </div>
                <div class="col-12 col-xl-2 col-centered">
                        <a  href="javascript:void(0)" class="block block-link-shadow text-center"  id="tumunu-guncelle">
                            <div class="block-content">
                                <p class="mt-5">
                                    <i class="fa fa-refresh fa-4x text-primary"></i>
                                </p>
                                <p class="">Tümünü Güncelle</p>
                            </div>
                        </a>
                        
                        
                </div>
                <div class="col-12 col-xl-2 col-centered">
                        <a  href="javascript:void(0)" class="block block-link-shadow text-center"  id="tumunu-guncelle">
                            <div class="block-content">
                                <p class="mt-5">
                                    <i class="fa fa-clock fa-4x text-warning"></i>
                                </p>
                                <small>{{date("d/m/Y")}} <br>
                                    <span id="saat"></span>    
                                </small>
                                
                            </div>
                        </a>
                        
                        
                </div>
                <script>
                function startTime() {
                        const today = new Date();
                        let h = today.getHours();
                        let m = today.getMinutes();
                        let s = today.getSeconds();
                        m = checkTime(m);
                        s = checkTime(s);
                        document.getElementById('saat').innerHTML =  h + ":" + m + ":" + s;
                        setTimeout(startTime, 1000);
                }

                function checkTime(i) {
                    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
                        return i;
                }
                startTime()
                </script>
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
                            /*
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
                         */
                            var basla = true;
                            var sira = 0;
                            var toplam = $(".widget-guncelle").length;
                            var start = false;
                            var percentage = 0;

                            $("#tumunu-guncelle").on("click", function(){
                                start = true;
-                               $(".widget-guncelle:eq("+sira+")").trigger("click");


                                setTimeout(() => {
                                    percentage = Math.round((sira+1) * 100 / toplam);
                                    $(".progress-bar").css("width",percentage + '%').html(percentage + '%');
                                }, 1000);
                                
                             
    
                                $('#tumunu-guncelle-modal').modal({
                                    backdrop: 'static', 
                                    keyboard: false
                                });
                            });
                            
                            $( document ).ajaxStop(function() {
                                if(start) {
                                    if(sira<toplam) {
                                        
                                        setTimeout(() => {
                                            sira++;
                                            percentage = Math.round((sira) * 100 / toplam);
                                            $(".progress-bar").css("width",percentage + '%').html(percentage + '%');
                                            console.log(sira);
                                            $(".widget-guncelle:eq("+sira+")").trigger("click");
                                        }, 100);
                                        
                                        
                                    } else {
                                        sira = 0;
                                        start = false;
                                        $('#tumunu-guncelle-modal').modal("hide");
                                        
                                    }
                                    if(percentage>=90) {
                                        sira = 0;
                                        start = false;
                                        $('#tumunu-guncelle-modal').modal("hide");
                                    }
                                } else {
                                    sira = 0;
                                }
                                
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
                                <small title="Takip No" class="badge badge-success">{{$y->takip_no}}</small>
                                <small title="Firma Adı" class="badge badge-danger">{{$y->firma}}</small>
                                <small title="Kullanıcı Adı" class="badge badge-warning">{{$y->kullanici}}</small>
                                <small title="Cihaz Tipi" class="badge badge-info">{{$y->cihaz_tipi}}</small>
                                <small title="Güç" class="badge badge-primary">{{$y->guc}}</small>
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