@extends('admin.master')
@section("title",__("Kullanıcılar"))
@section("desc",__("Sistemde yer alan kullanıcıları bu bölümden yönetebilirsiniz"))
@section('content')
<?php
	use Illuminate\Support\Facades\Request;
	use Illuminate\Support\Facades\Input;
	use App\Contents;
	use App\Types;
	use App\Fields;
	use App\User;
	
	$u = u();
	$seviye = user_levels();
	$request = null;

	if(getisset("q")) {
		  $q = get("q");
			
		  $searchFields = ['name','surname','email','phone','permissions'];
		  $users = db("users")->where(function($query) use($q, $searchFields){
			$searchWildcard = '%' . $q . '%';
			foreach($searchFields as $field){
			  $query->orWhere($field, 'like', $searchWildcard);
		//	  echo "$field $searchWildcard";
			}
		  })
		  //->where("id",">=",Auth::user()->id)
		  ->simplePaginate(5);

	} else {
		$users = db("users")->orderBy("id","DESC");

		if($u->level!="Admin" ) {
		//	$users = $users->where("uid",u()->id);
			$root_alias = root_alias();
			if(!in_array($u->alias,$root_alias)) {
				$users = $users->whereIn("id",$u->alias_ids);
			}
		}
		
		if(getisset("level")) {
			if(!getesit("level","")) {
				$users = $users->where("level",get("level"));
			}
			
		}
		$users = $users->simplePaginate(5);
		
	}
	
?>
<div class="content">
<div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">
			
				<form action="" method="get">
					<div class="row">
						<div class="col-md-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<button type="submit" class="btn btn-secondary">
										<i class="fa fa-search"></i>
									</button>
								</div>
								<input type="text" class="form-control"  name="q" value="{{@$request['q']}}" placeholder="{{e2("Kullanıcı Adı")}}">
							</div>
						</div>
					</div>
				</form>
			
			</h3>
            <div class="block-options">
                <div class="block-options-item">
                    <a href="{{ url('admin-ajax/user-add') }}" class="btn btn-default"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
		

        <div class="block-content">
			<select name="" onchange="location.href='?level='+$(this).val()" id="" class="form-control">
				<option value="">{{e2("Tümü")}}</option>
				<?php foreach($seviye AS $s)  { 
					$s = trim($s);
				  ?>
 				<option value="{{$s}}" <?php if(getesit("level",$s)) echo "selected"; ?>>{{$s}}</option> 
				 <?php } ?>
			</select>
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped">
					<tr>
						<td>{{e2("Kimlik")}}</td>
						<td>{{e2("Üst")}}</td>
						<td>{{e2("Adı")}}</td>
						<td>{{e2("Soyadı")}}</td>
						<td>{{e2("Seviye")}}</td>
						<td>{{e2("E-Mail")}}</td>
						<td>{{e2("Telefon")}}</td>
						<td>{{e2("Yetkiler")}}</td>
						<td>{{e2("Kurtarma Şifresi")}}</td>
						<td>{{e2("Etki Alanı")}}</td>
						<td>{{e2("İşlem")}}</td>
					</tr>
					@foreach($users AS $u)
						@php
							$permissions = explode(",",$u->permissions);
						@endphp
					<tr>
						<td>{{$u->id}}</td>
						<td><input type="text" name="ust" value="{{$u->ust}}" style="min-width:100px" table="users" id="{{$u->id}}" class="name{{$u->id}} form-control edit" /></td>
						<td><input type="text" name="name" value="{{$u->name}}" table="users" id="{{$u->id}}" class="name{{$u->id}} form-control edit" /></td>
						<td><input type="text" name="surname" value="{{$u->surname}}" table="users" id="{{$u->id}}" class="surname{{$u->id}} form-control edit" /></td>
						<td>
							<select name="level" id="{{$u->id}}" table="users" class="form-control edit">
							@if($seviye!=null)
								@foreach($seviye AS $l)
								<?php $l = trim($l); ?>
								<?php 
								if($l=="Admin") { //eğer admin kullanıcısı ise admin gösterimine izin ver.
									if(u()->level=="Admin") {  ?>
									<option value="{{$l}}" @if($u->level==$l) selected @endif>{{e2($l)}}</option>
									<?php } ?>
								<?php } else {
									 ?>
									 <option value="{{$l}}" @if($u->level==$l) selected @endif>{{e2($l)}}</option>
									 <?php 
								} ?>
								@endforeach
							@endif
							</select>
						</td>
						<td><input type="text" name="email" value="{{$u->email}}" table="users" id="{{$u->id}}" class="email{{$u->id}} form-control edit" /></td>
						<td><input type="text" name="phone" value="{{$u->phone}}" table="users" id="{{$u->id}}" class="phone{{$u->id}} form-control edit" /></td>
						<td>
			<?php // print_r( $permissions); ?>
						<form action="{{url('admin-ajax/permission-update')}}" method="post">
							@csrf
							<select name="permissions[]" multiple id="" class="select2" style="width:250px">
							@if($types!=null)
							@foreach($types AS $t)
							<?php 
							$ust = "";
							if($t->kid!="") {
								$ust = slugtotitle($t->kid). " / ";
							} ?>
								<option value="{{$t->title}}" @if(in_array($t->title,$permissions)) selected @endif>{{$ust}}{{$t->title}}</option>
							@endforeach
							@endif
							@foreach(diger_ayarlar() AS $d) 
							
								<option value="{{$d}}" @if(in_array($d,$permissions)) selected @endif>{{$d}}</option>
							@endforeach
							</select>
							<input type="hidden" name="id" value="{{$u->id}}" />
							<button class="btn btn-default" title="{{__('Kullanıcının yetkilerini güncelle')}}"><i class="fa fa-sync"></i></button>
						</form>
						</td>
					
						
						<td>
							{{$u->recover}}
							<a href="{{url('admin-ajax/password-update?id='.$u->id)}}" title="{{__('Kullanıcının şifresini sıfırla')}}" class="btn btn-default"><i class="fa fa-sync"></i> {{e2("Şifre Sıfırla")}}</a>

						</td>
						<td><input type="text" name="alias" value="{{$u->alias}}" table="users" id="{{$u->id}}" class="alias{{$u->id}} form-control edit" /></td>

						<td>
						<div class="dropdown">
						  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							{{e2("İşlemler")}}
						  </button>
						  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						  <a class="dropdown-item" href="{{url("?user-detay=".$u->id)}}"><i class="fa fa-list"></i> {{e2("Detaylar")}}</a>
						  <a class="dropdown-item" href="{{url("login-by-id?id=".$u->id)}}" target="_blank"><i class="fa fa-lock"></i> {{e2("Giriş Yap")}}</a>
							<a class="dropdown-item" teyit="{{$u->name}} {{$u->surname}} {{e2("Kullanıcısını silmek istediğinizden emin misiniz?")}}" href="{{url('admin-ajax/user-delete?id='.$u->id)}}">
							<i class="fa fa-times"></i>
							{{e2("Sil")}}</a>

						  </div>
						</div>
						</td>
					</tr>
					@endforeach
				</table>
				{{$users->appends($_GET)->links() }}
			</div>
		</div>
@endsection
