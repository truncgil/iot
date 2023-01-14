<?php 
$tur_donusumu = db("tur_donusumleri")->where("title",$c2->title)->first();
if(!isset($lastValue)) { 
   $lastValue = "000000000";
   }?>
<div id="widget{{$c2->id}}">
<small><div class="badge badge-info d-none">Son güncelleme: {{zf($c2->sonuc_date)}}</div></small>
<p id="container{{$c2->id}}" class="font-size-h1 text-corporate">
                                        <strong></strong>
                                    </p>


<script type="text/javascript">
var lastValue = "{{$lastValue}}"
                    .trim()
                    .substring(
                            {{$c2->bas}}, 
                            {{$c2->son}}
                        );
                        console.log("lastValue="+lastValue);
var decimal = Math.round(parseInt(
                    lastValue, 
                    16
                ));
              
      
                    var maskingDecimal = decimal;
                   <?php if($tur_donusumu) {
                   
                    ?>
                    var donusum_data = `{{$tur_donusumu->html}}`.split("\n");
                    var donusum_map = [];
                    donusum_data.forEach((item, index)=>{
                        item = item.split(":");
                        donusum_map[item[0]] = item[1];
                        if(eval(maskingDecimal) == item[0]) {
                            console.log(item[1]);

                            $("#container{{$c2->id}}").html(item[1].replace(",", "<br>"));
                        }
                    });
                    console.log(donusum_map);
                    /*
                    donusum_data = explode("\n",);
                    donusum_map = [];
                    foreach($donusum_data AS $data) {
                        $data = explode(":",$data);
                        $donusum_map[$data[0]] = $data[1];
                    }
                    if(isset($donusum_map[$maskingDecimal])) {
                        $maskingDecimal = $donusum_map[$maskingDecimal];
                    }
                    */
                    <?php  } ?>
                 //    $("#container{{$c2->id}}").html(maskingDecimal); 
</script>

              <div class="block-footer">
           <div>{{$c2->title}}</div>
           </div>
           <h2><div id="decimal{{$c2->id}}"></div></h2>
</div>
