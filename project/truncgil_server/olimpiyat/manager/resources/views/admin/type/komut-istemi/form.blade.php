<form action="?duzenle={{get("duzenle")}}&guncelle" id="Form" method="post">

                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                Başlık
                                <input type="text" name="title" value="{{$c2->title}}" id="title{{$c2->id}}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                IMEI
                                <input type="text" name="imei" value="{{$c2->imei}}" id="imei{{$c2->id}}" class="form-control imei{{$c2->id}}">
                            </div>
                            <div class="col-md-6">
                                Komut Satırı
                                <input type="text" name="json" value="{{$c2->json}}" id="json{{$c2->id}}" class="form-control json{{$c2->id}}">
                            </div>
                            <div class="col-md-6">
                                Komut Satırı 2 (On Off Toggle ve Reset için geçerlidir)
                                <input type="text" name="json2" value="{{$c2->json2}}" id="json2{{$c2->id}}" class="form-control json{{$c2->id}}">
                            </div>
                            <div class="col-md-6">
                                Komut Türü
                                <select name="alt_type" id="" value="{{$c2->alt_type}}" id="json{{$c2->id}}" class="form-control json{{$c2->id}}">
                                    <option value="read" <?php if($c2->alt_type=="read") echo "selected"; ?>>Okuma Komutu</option>
                                  <option value="write"  <?php if($c2->alt_type=="write") echo "selected"; ?>>Yazma Komutu</option>
                                  <option value="onoff"  <?php if($c2->alt_type=="onoff") echo "selected"; ?>>On Off Toggle</option>
                                  <option value="reset"  <?php if($c2->alt_type=="reset") echo "selected"; ?>>Reset</option>
                                  <option value="digital-input"  <?php if($c2->alt_type=="digital-input") echo "selected"; ?>>Digital Input</option>
                                </select>

                            </div>
                            <div class="col-md-6">
                                Veri Maskesi
                                <input type="text" name="mask" value="{{$c2->mask}}" id="mask{{$c2->id}}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                Veri Birimi
                                <input type="text" name="birim" value="{{$c2->birim}}" id="mask{{$c2->id}}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                Dönüş Hex Başlangıcı
                                <input type="text" name="bas" value="{{$c2->bas}}" id="bas{{$c2->id}}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                Dönüş Hex Bitişi
                                <input type="text" name="son" value="{{$c2->son}}" id="son{{$c2->id}}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                Gösterge Paneli Maksimum Sınır
                                <input type="text" name="maks" value="{{$c2->maks}}" id="maks{{$c2->id}}" class="form-control">
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-md-6">
                                İlişkişli Toggle Komut <br> (Yalnızca yazma komutlarında geçerlidir.)
                                <select name="bag" id="" class="form-control">
                                    <option value="">Seçiniz</option>
                                    <?php 
                                    $komutlar = db("komut_istemi")
                                        ->where("imei",$c2->imei)
                                            ->where("alt_type","write")
                                            ->where("id","<>",$c2->id)
                                            ->get();
                                    foreach($komutlar AS $a)  { 
                                         
                                       ?>
                                      <option value="{{$a->id}}" <?php if($c2->bag==$a->id) echo "selected"; ?>>{{$a->title}} ({{$a->json}})</option>  
                                     <?php } ?>
                                </select>

                            </div>
                            <div class="col-md-6">
                                Konumu Hatırla <br> (Yalnızca yazma komutlarında geçerlidir.)
                                <select name="standup" id="" class="form-control">
                                    <option value="0" <?php if($c2->standup==0) echo "selected"; ?>>Pasif</option>
                                    <option value="1" <?php if($c2->standup==1) echo "selected"; ?>>Aktif</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            
                            <div class="col-12 text-center">
                                <div class="btn btn-warning btn-hero send"  data-id="{{$c2->id}}"><i class="fa fa-refresh"></i> Test Et</div>
                                <button class="mt-5 btn btn-success btn-hero">Güncelle</button>
                            </div>
                        </div>

                        <hr>
                        <?php //dump($c2) ?>
                        <div class="row">
                            <div class="col-md-6">
                                Hex Sonuç
                                <div id="sonuc{{$c2->id}}"></div>
                                <input type="text" name="" disabled id="hexSonuc" class="form-control d-none">                          
                            </div>
                            <div class="col-md-6">
                                Decimal Sonuç
                                <div id="decimal{{$c2->id}}"></div>
                                
                            </div>
                        </div>
                    </form>