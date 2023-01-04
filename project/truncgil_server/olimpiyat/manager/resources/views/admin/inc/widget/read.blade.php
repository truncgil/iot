<?php 
if(!isset($lastValue)) { 
   $lastValue = "000000000";
   }?>
<div id="widget{{$c2->id}}">
<small><div class="badge badge-info d-none">Son güncelleme: {{zf($c2->sonuc_date)}}</div></small>
<div id="container{{$c2->id}}" class="truncgil-gauge" style="width: 100%;height:250px;"></div>

<script type="text/javascript">
var lastValue = "{{$lastValue}}"
                    .trim()
                    .substring(
                            {{$c2->bas}}, 
                            {{$c2->son}}
                        );
                        console.log("lastValue="+lastValue);
var decimal = ((Math.round(parseInt(
                    lastValue, 
                    16
                )) / {{$c2->mask}} )* {{$c2->carpan}}).toFixed(2);
//console.log(decimal);
              <?php if($c2->carpan!="") {
                 ?>
                 decimal = decimal ;
                 <?php 
              } ?>
                var i = 0;
                    var v = decimal.toString();
                    var maskingDecimal = decimal;
                    <?php if($c2->mask!="")  { 
                      ?>
                        var maskingDecimal = "{{$c2->mask}}".replace(/#/g, _ => v[i++]);
                    //    $("#decimal{{$c2->id}}").html(maskingDecimal); 
                     <?php } ?>
                    console.log(maskingDecimal);
   var dom = document.getElementById('container{{$c2->id}}');
   var myChart{{$c2->id}} = echarts.init(dom, null, {
     renderer: 'canvas',
     useDirtyRect: false
   });
   var app = {};
   
   var option;

   option = {
 series: [
   {
     type: 'gauge',
     center: ['50%', '60%'],
     startAngle: 200,
     endAngle: -20,
     min: 0,
     max: {{$c2->maks}},
     splitNumber: 10,
     itemStyle: {
       color: '#1c9'
     },
     progress: {
       show: true,
       width: 30
     },
     pointer: {
       show: true
     },
     axisLine: {
       lineStyle: {
         width: 30
       }
     },
     axisTick: {
       distance: -45,
       splitNumber: 5,
       lineStyle: {
         width: 2,
         color: '#999'
       }
     },
     splitLine: {
       distance: -52,
       length: 14,
       lineStyle: {
         width: 3,
         color: '#999'
       }
     },
     axisLabel: {
       distance:  0,
       color: '#999',
       fontSize: 12
     },
     anchor: {
       show: false
     },
     title: {
       show: false
     },
     detail: {
       valueAnimation: true,
       width: '60%',
       lineHeight: 40,
       borderRadius: 8,
       offsetCenter: [0, '50%'],
       fontSize: 20,
       fontWeight: 'bolder',
       formatter: '{value} {{$c2->birim}}',
       color: 'auto'
     },
     data: [
       {
         value: decimal
       }
     ]
   },
   {
     type: 'gauge',
     center: ['50%', '60%'],
     startAngle: 200,
     endAngle: -20,
     min: 0,
     max: {{$c2->maks}},
     itemStyle: {
       color: '#1f8'
     },
     progress: {
       show: true,
       width: 8
     },
     pointer: {
       show: false
     },
     axisLine: {
       show: false
     },
     axisTick: {
       show: false
     },
     splitLine: {
       show: false
     },
     axisLabel: {
       show: false
     },
     detail: {
       show: false
     },
     data: [
       {
         value: decimal
       }
     ]
   }
 ]
};

//httpClient();




   if (option && typeof option === 'object') {
     myChart{{$c2->id}}.setOption(option);
   }

   window.addEventListener('resize', myChart{{$c2->id}}.resize);
 </script>
           <div>{{$c2->title}}</div>
           <h2><div id="decimal{{$c2->id}}"></div></h2>
</div>
