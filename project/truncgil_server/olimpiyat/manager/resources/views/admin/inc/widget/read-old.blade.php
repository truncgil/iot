<?php 
if(!isset($lastValue)) { 
   $lastValue = "000000000";
   }?>
<div id="widget{{$c2->id}}">
<small><div class="badge badge-info d-none">Son güncelleme: {{zf($c2->sonuc_date)}}</div></small>
<script type="text/javascript">
           
           google.charts.load('current', {'packages':['gauge']});
           google.charts.setOnLoadCallback(drawChart{{$c2->id}});
           
           function drawChart{{$c2->id}}() {
           var decimal = parseInt(
                       "{{$lastValue}}"
                       .trim()
                       .substring(
                               {{$c2->bas}}, 
                               {{$c2->son}}
                           ), 
                       16
                   );
               $("#decimal{{$c2->id}}").html(decimal)
                   .unmask()
                   .mask("{{$c2->mask}}");

               var data = google.visualization.arrayToDataTable([
               ['Label', 'Value'],
               ['', eval($("#decimal{{$c2->id}}").html())]
               ]);
               
               var maks = {{$c2->maks}};
               var options = {
                       max: maks,
                       redFrom: maks*90/100, 
                       redTo: maks,
                       yellowFrom: maks*75/100, 
                       yellowTo: maks*90/100,
                       minorTicks: 5
                   };

               var chart = new google.visualization.Gauge(document.getElementById('chart_div{{$c2->id}}'));

               chart.draw(data, options);

               function resizeHandler () {
                   chart.draw(data, options);
               }
               if (window.addEventListener) {
                   window.addEventListener('resize', resizeHandler, false);
               }
               else if (window.attachEvent) {
                   window.attachEvent('onresize', resizeHandler);
               }

           }
           </script>
           
           <style>
               #chart_div{{$c2->id}} {
                   width: 100%;
               }
           </style>
           <div class="gauge">
               <div class="chart" id="chart_div{{$c2->id}}" ></div>
           </div>
           <div>{{$c2->title}}</div>
           <h2><div id="decimal{{$c2->id}}"></div></h2>
</div>
