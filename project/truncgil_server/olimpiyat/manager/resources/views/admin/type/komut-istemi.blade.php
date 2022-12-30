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