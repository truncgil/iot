@extends('admin.master')

@section('content')
<div id="page-container" class="main-content-boxed side-trans-enabled">

            <!-- Main Container -->
            <main id="main-container" style="min-height: 969px;">

                <!-- Page Content -->
                <div class="bg-image" style="background-image: url('assets/back.jpg');">
                    <div class="row mx-0 bg-black-op">
                        <div class="hero-static col-md-6 col-xl-8 d-none d-md-flex align-items-md-end">
                            <div class="p-30 js-appear-enabled animated fadeIn" data-toggle="appear">
                                <p class="font-size-h3 font-w600 text-white">
                                    {{e2("Olimpiyat IOT")}}
                                </p>
                                <p class="font-italic text-white-op">
                                   {{e2("Her Hakkı Saklıdır")}} © <span class="js-year-copy js-year-copy-enabled">{{e2("Kuruluş Yılı")}} -{{date('Y')}}</span>
                                </p>
                            </div>
                        </div>
                        <div class="hero-static text-center col-md-6 col-xl-4 d-flex align-items-center bg-white ">
                            <div class="content content-full">
                                <!-- Header -->
                                <div class="px-30 py-10">
                                    <a class="link-effect font-w700" href="#">
                                        <img src="{{url('assets/img/logo2.svg')}}" width="150"  class="img-fluid" alt="" />
                                    </a>
                                    <h1 class="h3 font-w700 mt-30 mb-10">{{e2("Olimpiyat IOT")}}</h1>
                                    <h2 class="h5 font-w400 text-muted mb-0">{{e2("Lütfen Giriş Yapın")}}</h2>
                                </div>
                                <!-- END Header -->

                                <!-- Sign In Form -->
                                <!-- jQuery Validation functionality is initialized with .js-validation-signin class in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js -->
                                <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                <form class="js-validation-signin px-30" action="{{ route('login') }}" method="post" novalidate="novalidate">
								 @csrf
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="form-material floating">
                                                <input type="text" class="form-control" id="login-username" name="email">
                                                <label for="login-username">{{ __('Kullanıcı Adı') }}</label>
                                            </div>
											@error('email')
												<div class="alert alert-danger" >
													<strong>{{ $message }}</strong>
												</div>
											@enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="form-material floating">
                                                <input type="password" class="form-control" id="login-password" name="password">
                                                <label for="login-password">{{ __('Şifre') }}</label>
                                            </div>
											@error('password')
												<div class="alert alert-danger">
													<strong>{{ $message }}</strong>
												</div>
											@enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="login-remember-me" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="login-remember-me">{{ __('Beni Hatırla') }}</label>
												
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-sm btn-hero btn-alt-primary">
                                            <i class="si si-login mr-10"></i> {{e2("Giriş Yap")}}
                                        </button>
                    
                                        
                                    </div>
                                    <div class="form-group d-none">
                                        <button type="button" onclick="location.href='{{url("yeni-kayit")}}'" class="btn btn-sm btn-hero btn-alt-primary">
                                        <i class="si si-user mr-10"></i>     
                                        {{e2("Kaydol")}}</button>
                                        <hr>
                                        <a href="{{url("sifremi-unuttum")}}" >{{e2("Giriş Yapamıyorum")}}</a>
                                    </div>
                                </form>
                                <!-- END Sign In Form -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->
        </div>
@endsection
