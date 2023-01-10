<?php 

$read_only = false;
if(oturumisset("ust_id")) {
   $read_only = true;
}
define("read_only",$read_only);
if(getisset("ajax")) {
	?>
	@include("admin-ajax.{$_GET['ajax']}")
	<?php
	exit();
} ?>
<?php if(getisset("ajax2")) { //blade ajax system
	?>
	@include("{$_GET['ajax2']}")
	<?php
	exit();
} ?>
@php
	$permissions = @explode(",",Auth::user()->permissions);
    
@endphp

<!DOCTYPE HTML>
<html lang="tr">

<head>	

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, user-scalable=no">
    <title>{!! strip_tags($__env->yieldContent('title','')) !!}</title>
    <meta name="description" content="">
    <meta name="author" content="Olimpiyat">
    <meta property="og:title" content="">
    <meta property="og:site_name" content="https://app.olimpiyat.com.tr/manager/">
    <meta property="og:description" content="">
    <meta property="og:type" content="app">
    <meta property="og:url" content>
    <meta property="og:image" content>
	<div class="header-zone">
		<!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="{{ asset('assets/admin/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/admin/js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/admin/js/plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/admin/js/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/admin/js/plugins/jquery-auto-complete/jquery.auto-complete.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/admin/js/plugins/ion-rangeslider/css/ion.rangeSlider.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/admin/js/plugins/ion-rangeslider/css/ion.rangeSlider.skinHTML5.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/admin/js/plugins/dropzonejs/dist/dropzone.css') }}">

    <link rel="stylesheet" id="css-main" href="{{ asset('assets/admin/css/pelinom6.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/admin/css/icons.css?v1.0') }}">
	
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<script type="text/javascript" src="{{asset("assets/html2canvas.min.js")}}"></script>
   


    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/jquery.datetimepicker.min.css" />
    <script src="{{ asset('assets/admin/js/pelinom6.core.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/pelinom6.app.min.js') }}"></script>
	<link rel="stylesheet" href="{{asset('assets/admin/css/custom.css?'.rand(1,1))}}" />
	<link rel="stylesheet" href="{{asset('assets/admin/css/olimpiyat.css?'.rand(1111,9999))}}" />
	<link rel="stylesheet" href="{{asset('assets/admin/css/tree.css')}}" />
	<link rel="stylesheet" href="{{asset('assets/admin/css/theme.css')}}" />

	<script type="text/javascript" src="{{asset("assets/chart/dist/Chart.min.js")}}"></script>
	<script type="text/javascript" src="{{asset("assets/chart/samples/utils.js")}}"></script>
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
<script type="text/javascript" src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>


<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/clusterize.js/0.18.0/clusterize.min.js"></script>
<script type="text/javascript" src="{{url('assets/barcode.js')}}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/clusterize.js/0.18.0/clusterize.min.css" />
<script type="text/javascript" src="{{url("assets/hammer.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/debounce.js")}}"></script>
<script src="{{ asset('assets/admin/js/plugins/dropzonejs/dropzone.min.js') }}"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<script type="text/javascript" src=" https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script type="text/javascript" src="https://fastly.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>

<script>	
	function ExportToExcel(type, fn, dl) { 
	var elt = document.getElementById('excel'); 
	var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" }); 
	return dl ? 
	XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) : 
	XLSX.writeFile(wb, fn || ('{!! trim(strip_tags($__env->yieldContent('title',''))) !!}.' + (type || 'xlsx'))); 
	} 
   
	</script>

</div>
<?php if(!Auth::check())  { 
  ?>
 <?php } ?>
</head>
<script>
     function onload() {
        $(".preloader").addClass("d-none");
    }
</script>
<body onload="onload()"> 

<div class="preloader d-none">
        <div class="lds-ring">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>

    </div> 

    <style>
        .preloader {
            position: fixed;
            top: 0px;
            left: 0px;
            width: 100%;
            height: 100%;
            background: #7a7a7a6b;
            z-index: 1000000;
        }
        .lds-ring {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
            position: absolute;
            left: calc(50% - 40px);
            top: calc(50% - 40px);
}
.lds-ring div {
  box-sizing: border-box;
  display: block;
  position: absolute;
  width: 64px;
  height: 64px;
  margin: 8px;
  border: 8px solid #fff;
  border-radius: 50%;
  animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
  border-color: #fff transparent transparent transparent;
}
.lds-ring div:nth-child(1) {
  animation-delay: -0.45s;
}
.lds-ring div:nth-child(2) {
  animation-delay: -0.3s;
}
.lds-ring div:nth-child(3) {
  animation-delay: -0.15s;
}
@keyframes lds-ring {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

    </style>   

    <script>
        $(function(){
         //   $(".preloader").removeClass("d-none");
            $(window).on('beforeunload', function() {
               // alert("beforeunload");
               console.log("beforeunload");
               $(".preloader").removeClass("d-none");
            });
            $( window ).on("load", function() {
                    // Handler for .load() called.
                    $(".preloader").addClass("d-none");
            });
            $(document).ajaxSuccess(function() {
                $(".preloader").addClass("d-none");
            });
          
         
        });
    </script>
@guest
	@yield("content")
@else
    <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-fixed page-header-glass side-trans-enabled">
       
		
		@include("admin.inc.right-sidebar")

        
        <nav id="sidebar">
            <div class="sidebar-content">
            <div class="text-center">
            <?php 
                                $u = u();
                                if($u->level=="Kurum") {
                                     ?>
                                    <img id="mainLogo" width="100%" style="        max-width: 100px;" data-theme="light" src="{{kurum_logo($u->alias)}}" class="h-full-w-auto" alt="{{$u->name}}"> 
                                     <?php 
                                } else {
                                     ?>
                                    <img id="mainLogo" width="100%" style="        max-width: 100px;" data-theme="light" src="{{asset('assets/img/logo.svg')}}" class="h-full-w-auto" alt="Olimpiyat">   
                                     <?php 
                                } ?>
            </div>
              
                <div class="content-side">
                   
                    <div class="sidebar-mini-hidden-b text-center">
                        
                        <ul class="list-inline mt-10">
                            <li class="list-inline-item">
                                <a class="link-effect text-dual-primary-dark font-size-xs font-w600 text-uppercase title"
                                    href="#">  </a>
									
									<h2 class="text-center">{{ Auth::user()->name }}  {{ Auth::user()->surname }}</h2>
									<div class="text-center badge badge-success">{{Auth::user()->level}}</div>
									<div class="text-center badge badge-info" title="{{e2("Etki Alanı")}}"><i class="fa fa-globe"></i>{{Auth::user()->alias}}</div>
                                    <!-- İsmin ilk harfi ve Soyisim -->
                            </li>
                           
                        </ul>
                    </div>
                </div>
               @include("admin.inc.menu");
            </div>
        </nav>

        
        <header id="page-header" class="">
            <div class="content-header">
                <div class="content-header-section">
                    <button type="button" class="btn btn-circle btn-dual-secondary sol-menu" data-toggle="layout"
                        data-action="sidebar_toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <img src="{{url("assets/img/logo.svg")}}" style="    width: 42px;
    display: block;
    margin: 0 auto;
    position: absolute;
    top: 6px;
    left: calc(50% - 42px/2);" alt="" class="show-mobile">
                    <button type="button" class="sag-menu btn btn-circle btn-dual-secondary hide-mobile" data-toggle="layout"
                        data-action="header_search_on">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <div class="content-header-section sag-menu">
                <?php if(u()->level=="Admin")  { 
                     ?>
                     <div class="btn-group hide-mobile d-none">
                        <div class="btn btn-info " onclick="window.print()"><i class="fa fa-print"></i> {{e2("Yazdır")}}</div>
                        <div class="btn btn-success " onclick="ExportToExcel('xlsx')"><i class="fa fa-file-excel"></i> {{e2("Excel'e Aktar")}}</div> 
                     </div>
                     <?php } ?>
                    <div class="btn-group hide-mobile " role="group">
                   
                        <button type="button" class="d-none btn btn-rounded btn-dual-secondary" id="language-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user d-sm-none"></i>
                            <span class="d-none d-sm-inline-block">{{e2(App::getLocale())}}</span>
                            <!-- Kullanıcı adı -->
                            <i class="fa fa-angle-down ml-5"></i>
                        </button>
                   
                        <div class="dropdown-menu dropdown-menu-right min-width-200 "
                            aria-labelledby="language-dropdown">
                            <h5 class="h6 text-center py-10 mb-5 border-b text-uppercase">{{ e2("Change Language") }}</h5>
                           
                            <div class="dropdown-divider"></div>
							<?php $dil = languages(); foreach($dil AS $d) { ?>
                            <a href="#" class="dropdown-item" onclick="$.get('{{url("ajax/set-locale?l=".$d)}}',function(){location.reload();})">
                                <i class="fa fa-language mr-5"></i> {{e2($d)}}
                            </a>
							<?php } ?>
                            <!-- Çıkış Yap -->
                        </div>
                  
                       <?php if(oturumisset("ust_id")) {
                           $ust = u2(oturum("ust_id"));
                            ?>
                            <div class="btn btn-danger" title="{{e2("Bu oturumda yalnızca okuyabilirsiniz. Herhangi bir bilgi değişikliğine müsadeniz yoktur.")}}">{{e2("Salt Okunur Modu")}}</div>
                            <a href="rollback-login" class="btn btn-primary success"><i class="fa fa-user"></i> {{$ust->name}} {{$ust->surname}} {{e2("Dön")}}</a>
                            <?php 
                       } ?>
						<div class="dropdown">
						  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							{{ Auth::user()->name }} {{ Auth::user()->surname }}
						  </button>
						  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<h5 class="h6 text-center py-10 mb-5 border-b text-uppercase">{{ Auth::user()->name }} {{ Auth::user()->surname }}</h5>
							<a class="dropdown-item" href="{{url('logout')}}">
                                <i class="si si-logout mr-5"></i> {{__('Çıkış Yap')}}
                            </a>
						  </div>
</div>
                    </div>

					<a href="{{ url('./') }}" target="_blank" class="btn btn-circle d-none"><i class="fa fa-globe"></i> {{__('Siteye Dön')}}</a>
                   <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout"
                        data-action="side_overlay_toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
            <div id="page-header-search" class="overlay-header">
                <div class="content-header content-header-fullrow">
                    <form action="{{url('admin/search')}}" method="get">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-secondary" data-toggle="layout"
                                    data-action="header_search_off">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control" value="{{@$q}}" placeholder="{{e2("Ara...")}}"
                                id="q" required  name="q">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id="page-header-loader" class="overlay-header bg-primary">
                <div class="content-header content-header-fullrow text-center">
                    <div class="content-header-item">
                        <i class="fa fa-sun-o fa-spin text-white"></i>
                    </div>
                </div>
            </div>
        </header>
		
		<div class="main-container">
			<div class="" style="margin-top:65px;">
				
				@if (View::hasSection('title'))
				<div class="bg-image" >
					<div class="bg-white-op-90">
						<div class="content content-full content-top">
							<h1 class="text-center">@yield("title")<br /> </h1>
							<div class="text-center d-none">@yield("desc")</div>
							
						</div>
					</div>
				</div>
				@endif
                <div class="content-layout">
                    <div class="content-ajax">
                        @yield("content")
                    </div>
                </div>
			</div>
		</div>
		<div class="clearfix"></div>
        @include("admin.inc.mobile-footer")
        <footer id="page-footer" class="opacity-0 t-center">
            <div class="content py-20 font-size-xs clearfix m-0-auto">
                <div class="m-0-auto">
                </div>
                
            </div>
        </footer>
    </div>
	@endguest
    <div class="script-zone">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script src="{{ asset('assets/admin/js/plugins/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/slick/slick.min.js') }}"></script>
	<!-- include summernote css/js -->
	<script src="{{ asset('assets/admin/js/plugins/summernote/summernote-bs4.min.js') }}"></script>
	<link rel="stylesheet" href="{{ asset('assets/admin/js/plugins/summernote/summernote-bs4.css') }}">

	<script src="{{ asset('assets/admin/js/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

	<link rel="stylesheet" href="{{ asset('assets/admin/js/plugins/magnific-popup/magnific-popup.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/admin/js/plugins/slick/slick.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/admin/js/plugins/slick/slick.css') }}">
	
	<!-- Page JS Plugins -->
        <!--<script src="{{ asset('assets/admin/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>-->
        <script src="{{ asset('assets/admin/js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/plugins/select2/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/plugins/jquery-auto-complete/jquery.auto-complete.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/plugins/masked-inputs/jquery.maskedinput.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/plugins/pwstrength-bootstrap/pwstrength-bootstrap.min.js') }}"></script>

        <script src="{{ asset('assets/admin/js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js"></script>
		<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
		<script type="text/javascript" src="{{ asset('assets/js/custom2.js') }}"></script>
		</div>
		<!--
<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
-->

<script src="{{asset('assets/admin/js/ckeditor/ckeditor.js')}}"></script>
@include("admin.inc.script")
<style type="text/css">
		.hidden {
			display:none !important;
		}
		.visible {
			display:block !important;
		}
		.hidden-upload {
			display:none;
			
		}
		.table-responsive {
       /*     background: url(back.png) white center center / contain no-repeat !important; */
            /* background-attachment: fixed !important; */
            background-size: 20% !important;
            background-position: center !important;
        }
		.dz-filename {
							white-space:normal !important;
							    height: 74px;
							
						}
		</style>
<div class="modal fade" id="modal-popin" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title"></h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                </div>
            </div>
            <div class="modal-footer">
                <button  class="btn btn-alt-secondary" data-dismiss="modal">{{__('Hayır')}}</button>
                <a href="#" class="btn btn-alt-success tamam" data-dismiss="modal">
                    <i class="fa fa-check"></i> {{__('Evet')}}
                </a>
            </div>
        </div>
    </div>
</div>

</body>

</html>
<style type="text/css">
.cke_button__easyimageupload {
	display:none !important;
}

</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.css">
<script type="text/javascript">

    Waves.init();

    Waves.attach('.waves');
    Waves.attach(".btn-primary");
    Waves.attach(".btn-success");
    Waves.attach(".btn-warning");
    Waves.attach(".btn-danger");
    Waves.attach(".btn-info");
  
    Waves.attach('.nav-main a');
  //  Waves.attach('.cevap-isaret span');

</script> 

