
<?php $yetkilerim = cihaz_yetkilerim(); ?>
<div class="content">
    <div class="row">
        <?php 
        
        if(getisset("duzenle"))  { 
   
        ?>
        {{col("col-12","{$c->title} Düzenle")}} 
            <?php 

            if(getisset("guncelle")) {
                $post = $_POST;
                unset($post['_token']);
                db("komut_istemi")->where("id",get("duzenle"))
                ->update($post);
                bilgi("Bilgiler başarılı bir şekilde güncellenmiştir");
                yonlendir("?duzenle={$_GET['duzenle']}");
            }

            $c2 = komut_istemi(get("duzenle"));

            ?>
            <script>
                $(function(){
                    <?php foreach($c AS $i => $d) {
                         ?>
                         $("#guncelleForm [name='{{$i}}']").val("{{$d}}");
                         <?php 
                    } ?>
                });
            </script>
            <div class="row">
                <div class="col-md-9">
                    @include("admin.type.komut-istemi.form")
                </div>
                <div class="col-md-3 text-center">
                    <?php  $lastValue = $c2->sonuc; 

                    ?>
                    @include("admin.inc.widget")
                    <br>
                    

                </div>
            </div>    
        {{_col()}} 
        <?php } ?>

        {{col("col-6","Cihazdan Cihaza Komut Klonla")}} 
        <?php if(getisset("klonla")) {
            if(postesit("from",post("to"))) {
                bilgi("Lütfen iki farklı imei seçiniz.","warning");
            } else {
                $komutlar = db("komut_istemi")->where("imei",post("from"))->get();
                $k = 0;
                foreach($komutlar AS $komut) {
                    $komut->imei = post("to");
                    unset($komut->id);
                    unset($komut->slug);
                    $komut->slug = rand();
                    
                    ekle2((Array) $komut,"komut_istemi");
                    $k++;
                }
                bilgi("$k adet komut {$_POST['from']} cihazından {$_POST['to']} cihazına kopyalanmıştır");
            }
            
        } ?>
        <form action="?klonla" method="post">
            @csrf
            <div class="input-group">
                <label >
                    Kaynak
                    <select name="from" id="" required class="form-control">
                        <option value="">Seçiniz</option>
                        <?php foreach($yetkilerim AS $y)  { 
                        ?>
                        <option value="{{$y}}">{{$y}}</option> 
                        <?php } ?>
                    </select>
                </label>
                <label >
                    Hedef
                    <select name="to" id="" required class="form-control">
                        <option value="">Seçiniz</option>
                        <?php foreach($yetkilerim AS $y)  { 
                        ?>
                        <option value="{{$y}}">{{$y}}</option> 
                        <?php } ?>
                    </select>
                </label>
                <label>
                    <br>
                    <button class="btn btn-primary">Komutları kopyala</button>
                </label>
            </div>
        </form>
        
        {{_col()}}

        {{col("col-6","Komut Temizle")}} 
            <?php if(getisset("temizle")) {
            
                $komutlar = db("komut_istemi")
                                ->where("imei",post("from"))
                                ->delete();
                bilgi("$komutlar adet komut {$_POST['from']} cihazından silinmiştir");
                
            } ?>
            <form action="?temizle" method="post">
                @csrf
                <div class="input-group">
                    <label>
                        Kaynak
                        <select name="from" id="" required class="form-control">
                            <option value="">Seçiniz</option>
                            <?php foreach($yetkilerim AS $y)  { 
                            ?>
                            <option value="{{$y}}">{{$y}}</option> 
                            <?php } ?>
                        </select>
                    </label>
                    
                    <label>
                        <br>
                        <button class="btn btn-danger">Komutları sil</button>
                    </label>
                </div>
            </form>
        
        {{_col()}}
    </div>
    

<div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title"><i class="fa fa-{{$c->icon}}"></i> {{e2($c->title)}} {{__('İçerikleri')}}</h3>
            <div class="block-options">
                <div class="block-options-item"> 
                    <a href="?add{{getisset("imei") ? "&imei=".get("imei") : ""}}" class="btn btn-success" title="Yeni Komut İstemi Ekle"><i class="fa fa-plus"></i> </a>
                </div>
            </div>
        </div>
		

        <div class="block-content">
            <?php if(getisset("add")) {
                ekle2([
                    'imei' => get("imei")
                ],"komut_istemi");
                bilgi("Boş komut listeye eklendi. Oradan işlemlere devam edebilirsiniz. ");
            } ?>
			@include("admin.type.komut-istemi.list")
        </div>
		
    </div>
</div>

@include("admin.type.komut-istemi.script")