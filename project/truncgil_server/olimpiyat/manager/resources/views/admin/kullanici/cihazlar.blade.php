<div class="content">
    <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Yetkili Cihazlarım</h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <tr>
                            <th>Mac Adresi</th>
                            <th>Son bağlantı</th>
                        </tr>
                        <?php 
                        $yetkiler = cihaz_yetkilerim();
                        
                        $cihazlar = db("cihazlar")
                            ->whereIn("imei",$yetkiler)
                            ->get();

                        foreach($cihazlar AS $c)  { 
                         
                         ?>
                         <tr>
                             <td>{{$c->imei}}</td>
                             <td>{{df($c->online)}}
                                <div class="badge badge-success">{{zf($c->online)}}</div>
                             </td>
                         </tr> 
                         <?php } ?>
                    </table>
                </div>
            </div>

            

        </div>

    </div>
</div>