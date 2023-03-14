<div class="content">
    <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title"><i class="fa fa-{{$c->icon}}"></i> {{e2($c->title)}}</h3>
            </div>
            <div class="block-content">
                <?php if(getisset("hesapla")) {
                    ?>
                    <h1>{{crc16_modbus(post("command"))}}</h1>
                    <?php 
                } ?>
                <form action="?hesapla" method="post">
                    @csrf
                    Komut Satırı
                    <input type="text" name="command" value="{{post("command")}}" id="" class="form-control">
                    <br>
                    <button class="btn btn-primary">Hesapla</button>
                </form>
            </div>

            

        </div>

    </div>
</div>
