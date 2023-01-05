<?php if(getisset("send")) {
    $data = [
        'imei'=>post("imei"),
        'command' => post("command")
    ];
    $return =  httpClient("http://app.olimpiyat.com.tr/client.php",$data);
    dump($return);
    exit();
} ?>
<div class="content">
    <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title"><i class="fa fa-{{$c->icon}}"></i> {{e2($c->title)}}</h3>
            </div>
            <div class="block-content">
                
                <form action="?send" method="post" class="serialize">
                    @csrf
                        IMEI :
                        <input type="text" name="imei" required id="" class="form-control">
                        Komut: 
                        <textarea name="command" required id="" cols="30" rows="10" class="form-control"></textarea>
                        <button class="btn btn-primary btn-hero mt-5">Gönder Al</button>
                        
                </form>
                <div class="result-ajax mt-5"></div>
            </div>

            

        </div>

    </div>
</div>