<?php 
$u = u();
if(getisset("add")) {
    try {
        if(post("imei")==12) {
            ekle(
                [
                    'imei' =>post("imei"),
                    'alias' => $u->alias
                ]
            , "yetkiler");

            ekle(
                [
                    'imei' => post("imei")
                ]
            , "cihazlar");
        }
        
    } catch (\Throwable $th) {
        //throw $th;
        dump($th);
    }

    
}

if(getisset("delete")) {
    $yetkilerim = cihaz_yetkilerim(); 
    db("yetkiler")->whereIn("imei",$yetkilerim)->where("imei",get("delete"))->delete();
    db("cihazlar")->whereIn("imei",$yetkilerim)->where("imei",get("delete"))->delete();
}

$yetkilerim = cihaz_yetkilerim(); ?>
<div class="content">
    <div class="row">
         {{col("col-12","Yeni Cihaz Kaydı")}} 
            <form action="?add" method="post">
                @csrf
                IMEI (12 Haneli):
                <input type="text" name="imei" required id="" class="form-control">
                <button class="btn btn-primary mt-5">Cihaz Ekle</button>


            </form>
          
         {{_col()}}
    </div>
    <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title"><i class="fa fa-{{$c->icon}}"></i> {{e2($c->title)}}</h3>
            </div>
            <div class="block-content">
                <?php if(getisset("logs")) {

                     ?>
                    <div class="col-12">
                        <h2>{{get("logs")}}</h2>
                    </div>
                      {{col("col-12","Loglar")}} 
                      <?php $logs = db("cihaz_log")->where("imei",get("imei"))->orderBy("id","DESC")->simplePaginate(50); ?>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-bordered">
                                    <tr>
                                        <th>ID</th>
                                        <th>Tarih</th>
                                        <th>Komut</th>
                                    </tr>
                                    <?php foreach($logs AS $l)  { 
                                      ?>
                                     <tr>
                                         <td>{{$l->id}}</td>
                                         <td>{{df($l->created_at)}}</td>
                                         <td>{{$l->html}}</td>
                                     </tr> 
                                     <?php } ?>
                                </table>
                            </div>
                      {{_col()}}
                     <?php 
                } ?>
                <?php if(getisset("alias")) {
                    if(getisset("ekle")) {
                        db("yetkiler")
                        ->where("alias",post("alias"))
                        ->where("imei",post("imei"))
                        ->delete();
                        ekle2([
                            'alias' => post("alias"),
                            'imei' => post("imei")
                        ],"yetkiler");
                        bilgi("{$_POST['alias']} etki alanına {$_POST['imei']} yetkilendirildi");
                    }
                     $yetkiler = db("yetkiler")->where("imei",get("imei"))
                     ->orderBy("id","DESC")
                     ->get();
                     

                     ?>
                     <div class="row">
                        <div class="col-12">
                            <h2>{{get("imei")}}</h2>
                        </div>
                      {{col("col-12","Yeni Yetkilendirme Ekle")}} 
                      <form action="?alias&imei={{get("imei")}}&ekle" method="post" class="text-center">
                        @csrf
                        <input type="hidden" name="imei" value="{{get("imei")}}">
                        {{get("imei")}} IMEI Aygıtını Yetkilendir: 
                        <select name="alias" required id="" class="form-control select2">
                                <option value="">Firma Seçiniz</option>
                            <?php foreach(contents("Firmalar") AS $f)  { 
                                ?>
                                <option value="{{$f->slug}}">{{$f->title}}</option> 
                                <?php } ?>
                        </select>
                        <br>
                        <button class="btn btn-primary btn-hero mt-1">Ekle</button>
                     </form>
                      {{_col()}}
                      {{col("col-12","Yetkilendirilmiş Etki Alanları")}} 
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered">
                                <tr>
                                    <th>Etki Alanı</th>
                                    <th>İşlem</th>
                                </tr>
                                <?php foreach($yetkiler AS $y)  { 
                                ?>
                                <tr>
                                    <td>{{$y->alias}}</td>
                                    <td></td>
                                </tr> 
                                <?php } ?>
                            </table>

                        </div>
                      {{_col()}}
                      </div>
                    
                     <?php 
                } ?>
                
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <tr>
                            <th>Mac Adresi</th>
                            <th>İsim</th>
                            <th>Son bağlantı</th>
                            <th>İşlem</th>
                        </tr>
                        <?php $cihazlar = db("cihazlar");
                        
                        $cihazlar = $cihazlar->whereIn("imei",$yetkilerim)->orderBy("online","DESC")->get();
                        foreach($cihazlar AS $c)  { 
                         
                         ?>
                         <tr>
                             <td>{{$c->imei}}</td>
                             <td>
                                <input type="text" name="title" value="{{$c->title}}" id="{{$c->id}}" table="cihazlar" class="form-control edit">
                             </td>
                             <td>{{df($c->online)}}
                                <div class="badge badge-success">{{zf($c->online)}}</div>
                             </td>
                             <td>
                                <a href="?alias&imei={{$c->imei}}" class="btn btn-primary"><i class="fa fa-globe"></i> Etki Alanları</a>
                                <a href="?logs&imei={{$c->imei}}" class="btn btn-info"><i class="fa fa-code"></i> Loglar</a>
                                <a href="?delete={{$c->imei}}" teyit="Bu cihazı sistemden kaldırmak istediğinizden emin misiniz?" class="btn btn-danger"><i class="fa fa-times"></i> Sil</a>
                             </td>
                         </tr> 
                         <?php } ?>
                    </table>
                </div>
            </div>

            

        </div>

    </div>
</div>