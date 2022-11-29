<script>
        
$(function(){
   $('#buton{{$c2->id}}').on("click",function(){
        $('#sonuc{{$c2->id}}').html('Komut gönderiliyor...');
        $.get('https://app.olimpiyat.com.tr/client.php',{
            'imei' : '{{$c2->imei}}',
            'command' : '{{$c2->json}}'
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
                    $(".widget-{{$c2->bag}}").removeClass("d-none");
                    $(".widget-{{$c2->id}}").addClass("d-none");
                    $.get("?ajax=komut-son-durum-guncelle",{
                        'imei' : '{{$c2->imei}}',
                        'command' : '{{$c2->json}}',
                        'sonuc' : d
                    });

                    
            } else {
                $('#sonuc{{$c2->id}}').html("{{$c2->imei}} cihazı aktif olmadığından komut gönderilemedi");
            }
            
        }).fail(function(){
            $('#sonuc{{$c2->id}}').html('Lütfen tekrar deneyiniz...');
        });
   });
    <?php if($c2->bag!="") { ?>
/*
        if(!$(".widget-{{$c2->id}}").hasClass("d-none")) {
            $(".widget-{{$c2->bag}}").addClass("d-none");
        }
        
*/
        
    <?php } ?>
});
</script>
<div class="text-center">
    <div class="btn btn-secondary" style="
    height: 254px;" id="buton{{$c2->id}}" onclick="
    ">
        <img class="img-fluid"  src="{{picture2($c2->cover,192)}}" width="192" alt="">
        <br>
        {{$c2->title}}
    </div>
    <div id="sonuc{{$c2->id}}"></div>
</div>
