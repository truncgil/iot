<?php if(getisset("send")) {
    $data = [
        'imei'=>post("imei"),
        'command' => post("command")
    ];
    oturumAc();
    oturum("imei",post("imei"));
    oturum("command",post("command"));
    $return =  httpClient("http://app.olimpiyat.com.tr/client.php",$data);
    dump($return);
    exit();
} 
?>
<script src="https://cdn.socket.io/4.5.4/socket.io.min.js"></script>
<script>
    var socket = io('https://app.olimpiyat.com.tr:3000');
    socket.on('messages', function(data){
        console.log(data);
    });
    socket.emit('data', {
        'imei' : "344041073520",
        'command' : "01 03 22 06 00 01 6E 73"
    },(answer) => {
        console.log(answer);
    });
</script>
<div class="content">
    <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title"><i class="fa fa-{{$c->icon}}"></i> {{e2($c->title)}}</h3>
            </div>
            <div class="block-content">
                
                <form action="?send" method="post" class="serialize">
                    @csrf
                        IMEI :
                        <input type="text" name="imei" value="{{oturum("imei")}}"  required id="" class="form-control">
                        Komut: 
                        <textarea name="command" required id="" cols="30" rows="10" class="form-control">{{oturum("command")}}</textarea>
                        <button class="btn btn-primary btn-hero mt-5">Gönder Al</button>
                        
                </form>
                <div class="result-ajax mt-5"></div>
            </div>

            

        </div>

    </div>
</div>