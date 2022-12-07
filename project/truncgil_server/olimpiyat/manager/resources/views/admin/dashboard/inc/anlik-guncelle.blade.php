<script>
    
    
    
    $(function(){

    var interval;
    var stop = false;
    var position = 0;
    var total = $(".read-widget").length;
    //console.log("total "+total);
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
            console.log(command + ":" + d + ":" + decimal);
          //  //console.log("donen deger " + decimal);
            if(!isNaN(decimal)) {
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
            } else {
                devam();
            }


        }).done(function( data ) {
            devam();

        }).fail(function() {
            devam();
        });
            
            
    }

    function devam() {
        stop = false;
        //console.log("done");
        //console.log(position);
        if(position<total-1) {
            position++;
        } else {
          //  //console.log("reset position");
            position = 0;
        }
    }

    interval = window.setInterval(function(){
        if(!stop) {
            //console.log("position " + position);
            var widget = $(".read-widget:eq("+position+") .widget-guncelle");
            var gauge = $(".read-widget:eq("+position+") .truncgil-gauge").attr('id');
            var imei = widget.attr('data-imei');
            var command = widget.attr('data-command');
            var bas = widget.attr('data-bas');
            var son = widget.attr('data-son');
            var mask = widget.attr('data-mask');
            //console.log(gauge);
            httpClient(gauge, imei, command, bas, son, mask);
            //console.log("send " + command);
        }
    },5000);

        var k = 0;
/*
        window.setInterval(() => {
           // $(".widget-guncelle").trigger("click");
        }, 30000);
        */
        <?php if(isset($imei))  { 
          ?>
         window.setTimeout(function(){
             $.getJSON('{{url("last-status")}}',{
                 imei : "{{$imei}}"
             },function(d){
                 //console.log(d);
                 d.forEach(function(command, e,i){
                    //console.log(command);
                    $("[on='"+command+"']").attr("checked","checked");
                    $("[on='"+command+"']").prop("checked",true);
                    $("[off='"+command+"']").removeAttr("checked");
                    $("[off='"+command+"']").prop("checked",false);
                     let selector = command.replaceAll(" ","").toLowerCase();
                     let activeCommand = $(".command"+selector);
                     let bagWidget = activeCommand.children().find('.bag').text();
                     //console.log(bagWidget);
                  //   activeCommand.addClass("d-none");
                  //   $(".widget-"+bagWidget).removeClass("d-none");
                     
                 });
             });
         },1); 
         <?php } ?>
        

    });
    
</script>