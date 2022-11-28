<script src="https://code.jscharting.com/latest/jscharting.js"></script>
<?php for($k=1;$k<10;$k++)  { 
  ?>
 <div id="chartDiv{{$k}}" style="max-width: 450px;height: 250px;margin: 0px auto">
 </div>
 <script>
     // JS 
 var chart{{$k}} = JSC.chart('chartDiv{{$k}}', { 
   debug: false, 
   type: 'gauge', 
   animation_duration: 1000, 
   legend_visible: false, 
   xAxis: { spacingPercentage: 0.25 }, 
   yAxis: { 
     defaultTick: { 
       padding: -5, 
       label_style_fontSize: '14px'
     }, 
     line: { 
       width: 9, 
       color: 'smartPalette', 
       breaks_gap: 0.06 
     }, 
     scale_range: [0, 100] 
   }, 
   palette: { 
     pointValue: '{%value/100}', 
     colors: ['green', 'yellow', 'red'] 
   }, 
   defaultTooltip_enabled: false, 
   defaultSeries: { 
     angle: { sweep: 180 }, 
     shape: { 
       innerSize: '70%', 
   
       label: { 
         text: 
           '<span color="%color">{%sum:n1}</span><br/><span color="#696969" fontSize="20px">kW</span>', 
         style_fontSize: '46px', 
         verticalAlign: 'middle', 
         offset: '0,50'
       } 
     } 
   }, 
   series: [ 
     { 
       type: 'column roundcaps', 
       points: [{ id: '1', x: 'speed', y: 0 }] 
     } 
   ], 
   toolbar_items: { 
     Stop: { 
       type: 'option', 
       icon_name: 'system/default/pause', 
       margin: 10, 
       boxVisible: true, 
       label_text: 'Pause', 
       events: { change: playPause{{$k}} }, 
       states_select: { 
         icon_name: 'system/default/play', 
         label_text: 'Play'
       } 
     } 
   } 
 }); 
 var INTERVAL_ID{{$k}}; 
   
 playPause{{$k}}(); 
   
 function setGauge{{$k}}(max, y) { 
   chart{{$k}} 
     .series(0) 
     .options({ 
       points: [{ id: '1', x: 'speed', y: y }] 
     }); 
   //chart.annotations('anVal').options({ label_text: JSC.formatNumber(y, 'n1') }); 
 } 
   
 function playPause{{$k}}(val) { 
   if (val) { 
     clearInterval(INTERVAL_ID{{$k}}); 
   } else { 
     update{{$k}}(); 
   } 
 } 
window.setTimeout(function(){
    setGauge{{$k}}(100, Math.random() * 100); 
},100);
 
 function update{{$k}}() { 
   INTERVAL_ID{{$k}} = setInterval(function() { 
     setGauge{{$k}}(100, Math.random() * 100); 
   }, 5000*{{$k}}); 
 } 
 </script> 
 <?php } ?>