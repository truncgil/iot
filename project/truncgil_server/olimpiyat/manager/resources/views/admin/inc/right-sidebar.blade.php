<?php $u = u(); ?>
<aside id="side-overlay">
            <div class="content-header content-header-fullrow d-none">
                <div class="content-header-section align-parent">
                   
                    <button type="button" class="btn btn-circle btn-dual-secondary align-v-r" data-toggle="layout" data-action="side_overlay_close">
                        <i class="fa fa-times text-danger"></i>
                    </button>
                    <div class="content-header-item">
                       
                    </div>
                </div>
            </div>
           <div class="row">
               <div class="col-12">
               <div class="block text-center p-5" href="javascript:void(0)">
                    <div class="block-content block-content-full ">
                        <img class="img-avatar img-avatar-thumb" src="{{profile_pic()}}" alt="">
                    </div>
                    <div class="block-content block-content-full">
                        <h3 class="font-w600 mb-5">{{ $u->name }}  {{ $u->surname }}</h3>
                        <h4 class="font-size-sm text-muted">{{ $u->level }}</h4>
                    </div>
                    <div class="block-content block-content-full profil-btn">
                        
                        <a href="#profil-ayarlari" type="button" class="btn  btn-alt-success mr-5 mb-5 js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Profile">
                            <i class="fa fa-2x fa-user"></i>
                            <div>{{e2("Profil Ayarları")}}</div>
                        </a>
                        <a href="#uygulama-ayarlari" type="button" class="btn  btn-alt-danger mr-5 mb-5 js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Settings">
                            <i class="fa fa-2x fa-cog"></i>
                            <div>{{e2("Uygulama Ayarları")}}</div>
                        </a>
                        <a href="{{url("logout")}}" class="btn  btn-alt-warning mr-5 mb-5 js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
                            <i class="fa fa-2x fa-sign-out-alt"></i>
                            <div>{{e2("Çıkış Yap")}}</div>
                        </a>
                    </div>
                    <style>
                        .profil-btn .btn div {
                            font-size:12px;
                            margin-top:5px;
                        }
                    </style>
                </div>
               </div>
           </div>
           <a name="profil-ayarlari"></a>
            <div class="content-side pb-10">
				<div class="block pull-r-l">
                    <div class="block-header bg-body-light">
                        <h3 class="block-title">
                            <i class="fas fa-file"></i>
                            {{__('Profil Ayarları')}}
                        </h3>
                        <div class="block-options">
                            
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                        </div>
                    </div>
                    <div class="block-content">
                        <?php if(getisset("profile-update")) {

                            $post = $_POST;
                            $varmi = db("users")
                            ->where(function($query) use($post){
                                $query = $query->orWhere("email",post("email"));
                                $query = $query->orWhere("phone",post("phone"));
                            })
                            ->where("id","<>",u()->id)
                            ->first();
                            if(!$varmi) {
                                
                                unset($post['_token']);
                                 $post['json'] = json_encode_tr($post);
                                 if(!postesit("password","")) {
                                     $post['password'] = Hash::make($post['password']);
                                     bilgi("Şifreniz güvenli bir şekilde değiştirildi");
                                 } else {
                                     unset($post['password']);
                                 }
                                 if($_FILES['file']['name']!="") {
                                     $post['file'] = upload("file",$u->alias."/profile/");
                                 }
                                read_only_exit();
                                db("users")
                                ->where("id",u()->id)
                                ->update($post);
                                bilgi("Bilgileriniz başarılı bir şekilde güncellendi");
                                
                                 
                            } else {
                                bilgi("Bu telefon veya e-mail adresi ile daha önce bir kayıt oluşturulmuştur. Lütfen farklı bilgiler girerek tekrar deneyiniz");
                            }
                           
                            
                        } 
                        $u = db("users")->where("id",u()->id)->first();
                        ?> 
						<form action="?profile-update" enctype="multipart/form-data" method="post">
							@csrf 
                            
							{{__('Profil Görseli (Değiştirmek istemiyorsanız boş bırakın)')}}
								<input type="file" name="file"  id="" class="form-control"  />
							{{__('Adı')}}
								<input type="text" name="name" required id="" class="form-control" value="{{$u->name}}" />
							{{__('Soyadı')}}
								<input type="text" name="surname" required id="" class="form-control" value="{{$u->surname}}" />
							{{__('E-Mail')}}
								<input type="text" name="email" required id="" class="form-control" value="{{$u->email}}" />
							<?php if($u->level=="Öğrenci")  { 
                              ?>
                                {{__('Adresiniz')}}
                                    <input type="text" name="address" required id="" class="form-control" value="{{$u->address}}" />
                                {{__('İl')}}
                                    <input type="text" name="il" readonly disabled id="" class="form-control" value="{{$u->il}}" />
                                {{__('İlçe')}}
                                    <input type="text" name="ilce" readonly disabled  id="" class="form-control" value="{{$u->ilce}}" />
                                    {{__('Okul')}}
                                    <input type="text" name="okul" readonly disabled  id="" class="form-control" value="{{$u->okul}}" />
                                {{__('Sınıf')}}
                                    <input type="number" name="sinif" readonly disabled  id="" class="form-control" value="{{$u->sinif}}" />
                                <?php if($u->sinif!=8)  { 
                                  ?>   
                                 {{__('Alan')}}
                                 <input type="text" name="alan" readonly disabled  id="" class="form-control" value="{{$u->alan}}" />
                                 <?php } ?>						 
                             <?php } ?>
							{{__('Telefon')}}
								<input type="text" name="phone" required id="" class="form-control" value="{{$u->phone}}" />
							{{__('Şifre')}} <small>{{__('(Değiştirmek istemiyorsanız boş bırakın)')}}</small>
								<input type="text" name="password" id="" class="form-control" value="" />
							<br />
							<button class="btn btn-primary">{{__('Bilgilerimi Güncelle')}}</button>

						</form>
                    </div>
                    
               
                
                
                
            </div>
            </div>
            <a name="uygulama-ayarlari"></a>
            <div class="content-side pb-10">
				<div class="block pull-r-l">
                    <div class="block-header bg-body-light">
                        <h3 class="block-title">
                            <i class="fas fa-cog"></i>
                            {{__('Uygulama Ayarları')}}
                        </h3>
                        <div class="block-options">
                            
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                        </div>
                    </div>
                        <div class="block-content">
                            <div class="text-center">
                            <?php $dizi = glob("resources/{,*/,*/*/,*/*/*/}*.php", GLOB_BRACE);  
                            array_multisort(array_map('filemtime', $dizi), SORT_NUMERIC, SORT_DESC, $dizi);
                            //echo $dizi[0];
                            //$ver = filemtime($dizi[0]); 
                            $ver = date("y.d.h.is",filemtime($dizi[0])); 
                            $last = date("d.m.Y H:i:s",filemtime($dizi[0])); 

                            $ver = str_replace("0","",$ver); 
                            $ver = "2.30";
                            ?>
                            
                            <div class="btn"> <i class="fa fa-clock"></i> {{e2("Server Time:")}}  {{date("d.m.Y H:i")}}</div>
                            <div class="btn" title="{{e2("Last Update:")}} {{$last}}"> <i class="fa fa-code-branch"></i> {{e2("Version:")}}  {{$ver}} RC</div>
                                </div>
                        </div>
                    </div>
                    
                </div>
               
                
                
                
           
        </aside>