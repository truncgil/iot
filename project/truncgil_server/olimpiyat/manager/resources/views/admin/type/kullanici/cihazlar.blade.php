<div class="content">
    <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title"><i class="fa fa-{{$c->icon}}"></i> {{e2($c->title)}}</h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <tr>
                            <th>Mac Adresi</th>
                            <th>Son bağlantı</th>
                            <th>İşlem</th>
                        </tr>
                        <?php $cihazlar = db("cihazlar")->orderBy("online","DESC")->get();
                        foreach($cihazlar AS $c)  { 
                         
                         ?>
                         <tr>
                             <td>{{$c->imei}}</td>
                             <td>{{df($c->online)}}
                                <div class="badge badge-success">{{zf($c->online)}}</div>
                             </td>
                             <td>
                                <a href="?alias&imei={{$c->imei}}" class="btn btn-primary"><i class="fa fa-globe"></i> Etki Alanları</a>
                                <a href="?logs&imei={{$c->imei}}" class="btn btn-info"><i class="fa fa-code"></i> Loglar</a>
                             </td>
                         </tr> 
                         <?php } ?>
                    </table>
                </div>
            </div>

            

        </div>

    </div>
</div>