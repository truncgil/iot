
<style>
    .komutlar .widget .block-content {
        height:300px;
    }
    .komutlar .widget .block-header {
        display:none;
    }
    .css-switch {
        transform: scale(2);
        margin: 70px 0;
    }   
    @media screen and (max-width:768px) {
        .komutlar .widget .block-content {
            height:220px;
        }
        .css-switch {
            transform: scale(1.5);
            margin: 40px 0;
        } 

    }
</style>
<div class="content">    
    <div class="row komutlar">
        <?php $yetkilerim = cihaz_yetkilerim();
        $komutlar = db("contents")
            ->where("type","Komut İstemi")
            ->where("y",1)
            ->whereIn("imei",$yetkilerim)
            ->orderBy("s","ASC")->get();
         ?>
         
         <?php 
        foreach($komutlar AS $c)  { 
            $lastValue = $c->sonuc;
            $imei = $c->imei;

            $commandClass = "command" . strtolower(str_replace(" ","",$c->json));
         ?>
         {{col("col-md-4 col-6 widget {$c->alt_type}-widget text-center widget-".$c->id . " $commandClass", $c->title)}} 
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
<script>
    
    
    
    $(function(){

    var interval;
    var stop = false;
    var position = 0;
    var total = $(".read-widget").length;
    console.log("total "+total);
    function httpClient(gauge, imei, command, bas, son, mask) {
        stop = true;
     //   clearInterval(interval);
        $.get('{{env('TCP_CLIENT_URL')}}',{
            imei : imei,
            command: command
        },function(d){
            
            let decimal = parseInt(
                            d
                            .trim()
                            .substring(
                                    bas, 
                                    son
                                ), 
                            16
                        )/ mask;
            console.log(d);
            var random = decimal;//+(Math.random() * 60).toFixed(2);

            var dom = document.getElementById(gauge);
            var myChart = echarts.init(dom, null, {
                renderer: 'canvas',
                useDirtyRect: false
            });

            myChart.setOption({
            series: [
                {
                data: [
                    {
                    value: random
                    }
                ]
                },
                {
                data: [
                    {
                    value: random
                    }
                ]
                }
            ]
            });
            

        }).done(function( data ) {
            devam();
            
        }).fail(function() {
            devam();
        });
    }

    function devam() {
        stop = false;
        console.log("done");
        console.log(position);
        if(position<total-1) {
            position++;
        } else {
            console.log("reset position");
            position = 0;
        }
    }

    interval = window.setInterval(function(){
        if(!stop) {
            console.log("position " + position);
            var widget = $(".read-widget:eq("+position+") .widget-guncelle");
            var gauge = $(".read-widget:eq("+position+") .truncgil-gauge").attr('id');
            var imei = widget.attr('data-imei');
            var command = widget.attr('data-command');
            var bas = widget.attr('data-bas');
            var son = widget.attr('data-son');
            var mask = widget.attr('data-mask');
            console.log(gauge);
            httpClient(gauge, imei, command, bas, son, mask);
            console.log("send " + command);
        }
    },1000);

        var k = 0;

        window.setInterval(() => {
           // $(".widget-guncelle").trigger("click");
        }, 30000);
        <?php if(isset($imei))  { 
          ?>
         window.setTimeout(function(){
             $.getJSON('{{url("last-status")}}',{
                 imei : "{{$imei}}"
             },function(d){
                 console.log(d);
                 d.forEach(function(command, e,i){
                    console.log(command);
                    $("[on='"+command+"']").attr("checked","checked");
                    $("[on='"+command+"']").prop("checked",true);
                    $("[off='"+command+"']").removeAttr("checked");
                    $("[off='"+command+"']").prop("checked",false);
                     let selector = command.replaceAll(" ","").toLowerCase();
                     let activeCommand = $(".command"+selector);
                     let bagWidget = activeCommand.children().find('.bag').text();
                     console.log(bagWidget);
                  //   activeCommand.addClass("d-none");
                  //   $(".widget-"+bagWidget).removeClass("d-none");
                     
                 });
             });
         },3000); 
         <?php } ?>
        

    });
    
</script>