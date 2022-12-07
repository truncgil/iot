
<div class="chart" id="container" >
	<canvas id="{{$type}}{{($id)}}" style="position: relative; height:500px; width:100%"></canvas>
</div>
<div id="ajax{{$type}}{{($id)}}"></div>
<script>
<?php 
$multi = array();
foreach($data AS $a) {
	$r = rand(1,255);
	 array_push($multi,"
		{
			label: '{$a['label']}',
			stack: '{$a['stack']}',
			data: [{$a['data']}],
			backgroundColor: [
				{$a['color']}
                
			]
		}

");
	
}
$multi = implode(",",$multi);
 ?>
var ctx = document.getElementById('{{$type}}{{($id)}}').getContext('2d');
var myChart = new Chart(ctx, {
	type: '{{$type}}',
	data: {
		labels: [<?php echo(implode(",",$labels)); ?>],
		datasets: [<?php echo($multi) ?>]
	},
	options: {
		responsive:true,
		onClick: function(evt, element) {
			  var activePoints = myChart.getElementAtEvent(evt);
			  var label = activePoints[0]._model.label
			  $("#ajax{{$type}}{{($id)}}").load("{{$url}}&label="+encodeURI(label));
		}
	}
});
</script>

