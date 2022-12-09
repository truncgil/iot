<script>
        
$(function(){
    var title = $("#modal{{$c2->id}} .title").html();
    var text = $("#modal{{$c2->id}} .text").html();
   $('#onoff{{$c2->id}}').on("click",function(){
        //$('#sonuc{{$c2->id}}').html('Komut gönderiliyor...');
        $("#modal{{$c2->id}}").modal({
                                 backdrop: 'static', 
                                 keyboard: false
                             });
        if($(this).is(":checked")) {
            $("#modal{{$c2->id}} .type").html("Aç");
        } else {
            $("#modal{{$c2->id}} .type").html("Kapa");
        }
        
   });

   $("#modal{{$c2->id}} .no").on("click", function(){
    
        if($('#onoff{{$c2->id}}').is(":checked")) {
            $('#onoff{{$c2->id}}').removeAttr("checked");
            $('#onoff{{$c2->id}}').prop("checked",false);
        } else {
            $('#onoff{{$c2->id}}').attr("checked","checked");
            $('#onoff{{$c2->id}}').prop("checked",true);
        }
        
   });
   
   function rollBack() {
        window.setTimeout(function(){
            $("#modal{{$c2->id}}").modal("hide");
            $("#modal{{$c2->id}} .text").html(text);
            $("#modal{{$c2->id}} .title").html(title);
            $("#modal{{$c2->id}}  .fa").removeClass(".fa-check-circle");
            $("#modal{{$c2->id}}  .fa").addClass(".fa-info-circle");
            $("#modal{{$c2->id}}  .no").removeClass("d-none").html("No");
            $("#modal{{$c2->id}}  .yes").removeClass("d-none");

        },1500);
   }
   $("#modal{{$c2->id}} .yes").on("click", function(){
            $("#modal{{$c2->id}} .fa").removeClass("fa-info-circle");
            $("#modal{{$c2->id}} .fa").addClass("fa-spin");
            $("#modal{{$c2->id}} .no").addClass("d-none");
            $("#modal{{$c2->id}} .yes").addClass("d-none");
            $("#modal{{$c2->id}} .fa").addClass("fa-spinner");
            $("#modal{{$c2->id}} .text").html("Lütfen bekleyiniz");
            $("#modal{{$c2->id}} .title").html("Değer yazılıyor...");
            var sendCommand = "{{$c2->json2}}";
            if($('#onoff{{$c2->id}}').is(":checked")) {
                sendCommand = "{{$c2->json}}";
            }
            $.get('https://app.olimpiyat.com.tr/client.php',{
                'imei' : '{{$c2->imei}}',
                '_' : $.now(),
                'command' : sendCommand
            }).done(function(d){
                if(d.trim()!=30) {
                    var decimal = parseInt(
                            d
                            .trim()
                            .substring(
                                    {{$c2->bas}}, 
                                    {{$c2->son}}
                                ), 
                            16
                        );
                        $("#hexSonuc").val(d);         
                        $('#sonuc{{$c2->id}}').html(decimal);

                        $("#modal{{$c2->id}} .fa").removeClass("fa-spin");
                        $("#modal{{$c2->id}} .fa").removeClass("fa-spinner");
                        $("#modal{{$c2->id}} .fa").addClass("fa-check-circle");
                        //$("#modal{{$c2->id}} .no").removeClass("d-none").html("OK");

                        $("#modal{{$c2->id}} .text").html("Yazılan değer: "+decimal);
                        $("#modal{{$c2->id}} .title").html("Yazma tamamlandı!");
                        
                        rollBack();

                        $.get("?ajax=komut-son-durum-guncelle",{
                            'imei' : '{{$c2->imei}}',
                            'command' : '{{$c2->json}}',
                            'sonuc' : d
                        });
                } else {
                    $("#modal{{$c2->id}} .fa").removeClass("fa-spin");
                    $("#modal{{$c2->id}} .fa").removeClass("fa-spinner");
                    $("#modal{{$c2->id}} .fa").addClass("fa-check-info");
                    $("#modal{{$c2->id}} .no").removeClass("d-none").html("OK");

                    $("#modal{{$c2->id}} .text").html("Cihaz aktif olmadığından yazma yapılamadı");
                    $("#modal{{$c2->id}} .title").html("Yazma başarısız!");

                    rollBack();
                }
                
            }).fail(function(){
                $("#modal{{$c2->id}} .fa").removeClass("fa-spin");
                $("#modal{{$c2->id}} .fa").removeClass("fa-spinner");
                $("#modal{{$c2->id}} .fa").addClass("fa-check-info");
                $("#modal{{$c2->id}} .no").removeClass("d-none").html("OK");

                $("#modal{{$c2->id}} .text").html("Cihaz aktif olmadığından yazma yapılamadı");
                $("#modal{{$c2->id}} .title").html("Yazma başarısız!");

                rollBack();
            });
    });
   
});
</script>

<div class="row">
    <div class="col-12 text-center">
    <label
    style="    "
    class="float-none css-control css-control-lg css-control-primary css-switch">
    <input id="onoff{{$c2->id}}" on="{{$c2->json}}" off="{{$c2->json2}}" type="checkbox" class="css-control-input">
    <span class="css-control-indicator indicator{{$c2->id}}"></span> 

    
</label>
<div class="text-center">{{$c2->title}}</div>
    </div>
</div>
    <div id="sonuc{{$c2->id}}" class="d-none"></div>

    <div class="modal" id="modal{{$c2->id}}">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">{{$c2->title}}</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body text-center">
        
        <i class="fa fa-info-circle fa-2x"></i> 
        <h2 class="title">Uyarı</h2>
        <div class="text"><strong><span class="type"></span></strong> değeri yazılacak. Devam etmek istiyor musunuz?</div> 

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary no" data-dismiss="modal">Hayır</button>
        <button type="button" class="btn btn-danger yes">Evet</button>
      </div>

    </div>
  </div>
</div>   

