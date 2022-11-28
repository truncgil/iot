<?php
	$u = u();
	$seviye = user_levels();
	$request = null;

	$users = db("users")->where("level","Kullanıcı")->orderBy("id","DESC")->simplePaginate(20);
	
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

			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped">
					<tr>
						<td>{{e2("ID")}}</td>
						<td>{{e2("Adı")}}</td>
						<td>{{e2("Soyadı")}}</td>
						<td>{{e2("E-Mail")}}</td>
						<td>{{e2("Telefon")}}</td>
						<td>{{e2("Kurtarma Şifresi")}}</td>
						<td>{{e2("Etki Alanı")}}</td>
						<td>{{e2("İşlem")}}</td>
					</tr>
					@foreach($users AS $u)

					<tr>
						<td>{{$u->id}}</td>
						<td><input type="text" name="name" value="{{$u->name}}" table="users" id="{{$u->id}}" class="name{{$u->id}} form-control edit" /></td>
						<td><input type="text" name="surname" value="{{$u->surname}}" table="users" id="{{$u->id}}" class="surname{{$u->id}} form-control edit" /></td>
					
						<td><input type="text" name="email" value="{{$u->email}}" table="users" id="{{$u->id}}" class="email{{$u->id}} form-control edit" /></td>
						<td><input type="text" name="phone" value="{{$u->phone}}" table="users" id="{{$u->id}}" class="phone{{$u->id}} form-control edit" /></td>
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
                                <a class="dropdown-item d-none" href="?user-detay={{$u->id}}"><i class="fa fa-list"></i> {{e2("Detaylar")}}</a>
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
