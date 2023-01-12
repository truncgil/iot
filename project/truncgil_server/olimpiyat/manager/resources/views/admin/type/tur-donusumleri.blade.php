<div class="content">
    <div class="row">
         {{col("col-12","Yeni Ekle")}} 
         <?php if(getisset("add")) {
            ekle2([
                'title' => post("title"),
                'html' => post("html")
            ],"tur_donusumleri");
            bilgi("{$_POST['title']} için tür dönüşüm haritası eklendi.");
         } ?>
            <form action="?add" method="post">
                @csrf
                <?php $komutlar = db("komut_istemi")->groupBy("title")->get(); ?>
                Komut
                <select name="title" required id="" class="form-control select2">
                        <option value="">Seçiniz</option>
                    <?php foreach($komutlar AS $komut) {
                         ?>
                         <option value="{{$komut->title}}">{{$komut->title}}</option>
                         <?php 
                    } ?>
                </select>
                Tür Dönüşüm Haritası <br>
                <div class="badge badge-info">Her bir değeri bir satıra gelecek şekilde giriniz. Ve karşılığındaki değeri belirtmek için : kullanınız</div>
                <textarea name="html" id="" cols="30" rows="10" class="form-control" placeholder="Örn: Değer:Karşılık"></textarea>
                <button class="btn btn-primary btn-hero mt-10">Ekle</button>

            </form>
          
         {{_col()}}
    </div>
    <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title"><i class="fa fa-{{$c->icon}}"></i> {{e2($c->title)}}</h3>
            </div>
            <div class="block-content">

            </div>

            

        </div>

    </div>
</div>