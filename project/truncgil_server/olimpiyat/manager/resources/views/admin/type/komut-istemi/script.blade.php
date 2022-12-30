<script>
        
            $(function(){
                $(".send").on("click",function(){
                    var bu = $(this);
                    var id = bu.attr("data-id");
                    var maks = $("#maks"+id).val();
                    var gauge = "#container"+id;
                    $("#sonuc"+id).html("");
                    $("#decimal"+id).html("");
                    bu.html("Sorgu gönderiliyor...");
                    $.ajaxSetup({
                        // Disable caching of AJAX responses
                        cache: false
                    });
                    $.get('https://app.olimpiyat.com.tr/client.php',{
                        'imei' : $(".imei"+ id).val(),
                        'command' : $(".json" + id).val()
                    }, function(d){
                        bu.html("Test Et");
                        if(d.trim()!="") {
                            var decimal = parseInt(
                                    d
                                    .trim()
                                    .substring(
                                            $('#bas'+id).val(), 
                                            $('#son'+id).val()
                                        ), 
                                    16
                                );
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
                                /*
                            $("#sonuc"+id).html(d);
                            console.log("#decimal"+id);
                            
                            $("#decimal"+id).html(decimal)
                                .unmask()
                                .mask($('#mask'+id).val());
                                
                            
                                console.log(decimal);
                                    var data = google.visualization.arrayToDataTable([
                                        ['Label', 'Value'],
                                        [$("#title"+id).val(), eval($("#decimal"+id).html())]
                                    ]);

                                    var options = {
                                        max: maks,
                                        width: 800, 
                                        height: 240,
                                        redFrom: maks*90/100, 
                                        redTo: maks,
                                        yellowFrom: maks*75/100, 
                                        yellowTo: maks*90/100,
                                        minorTicks: 5
                                    };
                                    var chart = new google.visualization.Gauge(document.getElementById('chart_div'+id));
                                    chart.draw(data, options);
                                    */
                                }
                        
                        
                    }).fail(function(jqXHR){
                        if(jqXHR.status==500 || jqXHR.status==0){
                            alert("Cihaza veri iletilemedi. Cihaz bağlı değil veya servis şu an uygun değil");
                            bu.html("Test Et");
                        }
                    }).done(function(jqXHR){
                        bu.html("Test Et");
                    });
                    
                });
                $.ajaxSetup({
                    timeout: 3000,
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        $('#send').html("Test Et");
                        if (textStatus == 'timeout') {
                            // timeout occured
                           
                            console.log("timeout");
                        } else {
                            // other error occured (see errorThrown variable)
                        }
                    }
                });
            });
        </script>