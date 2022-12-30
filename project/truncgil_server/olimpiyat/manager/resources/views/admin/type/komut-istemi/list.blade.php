@include("admin.inc.table-search")
<?php $alt = db("komut_istemi");
$yetkilerim = cihaz_yetkilerim();
$alt = $alt->whereIn("imei",$yetkilerim);
if(!getesit("imei","")) {
	$alt = $alt->where("imei",get("imei"));
}
$alt = $alt->simplePaginate(20); ?>
            {{$alt->appends($_GET)->links()}}
				<select name="" onchange="location.href='?imei='+$(this).val()" id="" class="form-control">
					<option value="">Tüm Cihazların Komutları</option>
					<?php foreach($yetkilerim AS $y)  { 
					  ?>
 					<option value="{{$y}}" {{(getesit("imei",$y)) ? "selected" : ""}}>{{$y}}</option> 
					 <?php } ?>
				</select>
			
			<div class="table-responsive">
            <table class="table table-striped table-hover table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center">{{__("Komut Bilgisi")}}</th>
                        <th>{{__("IMEI")}}</th>
                        <th>{{__("Komut")}}</th>
                        <th>{{__("Tür")}}</th>
						<th>{{__("Sıra")}}</th>
						<th>{{__("Durum")}}</th>
                        <th class="text-center" style="width: 100px;">{{__("İşlemler")}}</th>
                    </tr>
                </thead>
                <tbody>
				
				@foreach($alt AS $a)
					<tr class="">
                        <th class="text-center ">
						@if($a->cover!='')
						<a href="{{picture2($a->cover)}}" class="img-link img-link-zoom-in img-thumb img-lightbox"  target="_blank" >
							<img src="{{picture2($a->cover,128)}}" alt="" />
						</a>
						<hr />
						@endif
						<div class="btn-group">
						<button type="button" class="btn  btn-secondary btn-sm" onclick="$('#c{{$a->id}}').trigger('click');" title="{{__('Resim Yükle')}}"><i class="fa fa-upload"></i></button>
						@if($a->cover!='')
						<a teyit="{{__('Resmi kaldırmak istediğinizden emin misiniz')}}" title="{{__('Resmi kaldır')}}" href="{{url('admin-ajax/cover-delete?id='.$a->id)}}" class="btn btn-secondary btn-sm "><i class="fa fa-times"></i></a>
						<div title="{{__('Resmi indir')}}" onclick="
						location.href='{{url('cache/download/'.$a->cover)}}';
						$('.preloader').addClass('d-none');
						" class="btn btn-secondary btn-sm"><i class="fa fa-download"></i></div>
						@endif
						</div>
						<form action="{{url('admin-ajax/cover-upload')}}" id="f{{$a->id}}"  class="hidden-upload" enctype="multipart/form-data" method="post">
							<input type="file" name="cover" id="c{{$a->id}}" onchange="$('#f{{$a->id}}').submit();" required />
							<input type="hidden" name="id" value="{{$a->id}}" />
							<input type="hidden" name="slug" value="{{$a->slug}}" />
							{{csrf_field()}}
						</form>
                            <input type="text" name="title" placeholder="Başlık" value="{{$a->title}}" table="komut_istemi" id="{{$a->id}}" class="title{{$a->id}} form-control edit" />
                            <textarea name="html" placeholder="Açıklama" value="{{$a->html}}" table="komut_istemi" id="{{$a->id}}" class="html{{$a->id}} form-control edit" cols="30" rows="2" class="form-control">{{$a->html}}</textarea>
						</th>
                        <td>
                            <input type="text" name="imei" value="{{$a->imei}}" table="komut_istemi" id="{{$a->id}}" placeholder="IMEI buraya giriniz" class="imei{{$a->id}} form-control edit" />

							<input type="text" name="mask" value="{{$a->mask}}" table="komut_istemi" id="{{$a->id}}" placeholder="Bölüm maskını buraya giriniz" class="mask{{$a->id}} form-control edit" />

							<input type="text" name="birim" value="{{$a->birim}}" table="komut_istemi" id="{{$a->id}}" placeholder="Birimi buraya giriniz" class="imei{{$a->id}} form-control edit" />
						</td>

                        <td>
                            <textarea  name="json" value="{{$a->json}}" table="komut_istemi" id="{{$a->id}}" placeholder="Komutu buraya giriniz" class="json{{$a->id}} form-control edit" >{{$a->json}}</textarea>
                            <div class="btn btn-info send" data-id="{{$a->id}}"><i class="fa fa-refresh"></i> Test Et</div>
                            <br>
                            <div class="badge badge-danger" id="sonuc{{$a->id}}"></div>
                            <div class="badge badge-success" id="decimal{{$a->id}}"></div>
						</td>
                        <td>
                            <input type="text" name="alt_type" value="{{$a->alt_type}}" table="komut_istemi" id="{{$a->id}}" class="alt_type{{$a->id}} form-control edit" />
						</td>
						<!--
                        <td class="d-none">
						<div class="input-group">
							<div class="input-group-prepend">
									<div class="btn btn-default" onclick="$.get('{{url('admin-ajax/slug?title='.$a->breadcrumb)}}'+$('.title{{$a->id}}').val(),function(d){
										$('.slug{{$a->id}}').val(d).blur();
									})"><i class="si si-refresh"></i></div>
								</div>
								<input type="text" name="slug" value="{{$a->slug}}" table="komut_istemi" id="{{$a->id}}" class="slug{{$a->id}} form-control edit" />
							</div>
							
						</td>
                        -->
                        <td>
                            <input type="number" name="s" value="{{$a->s}}" table="komut_istemi" id="{{$a->id}}" class="form-control edit" />
                        </td>
                       
						<td>
							<select name="y" id="{{$a->id}}" class=" form-control edit" table="komut_istemi" >
								<option value="0" @if($a->y==0) selected @endif>{{__("Aktif Değil")}}</option>
								<option value="1" @if($a->y==1) selected @endif>{{__("Aktif")}}</option>
							</select>
						</td>
						
						
					  <td class="text-center">
                            <div class="btn-group">
                                <a href="?duzenle={{$a->id}}" class="btn btn-primary"><i class="fa fa-pen"></i></a>
                                <a href="{{ url('admin/komut_istemi/'. $a->slug .'/delete') }}" teyit="{{$a->title}} {{__('içeriğini silmek istediğinizden emin misiniz?')}}" title="{{$a->title}} {{__('Silinecek!')}}" class=" btn  btn-secondary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Delete">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
				@endforeach
				
                                     
                                    </tbody>
            </table>
			
			</div>
            {{$alt->appends($_GET)->links() }}
			</div>