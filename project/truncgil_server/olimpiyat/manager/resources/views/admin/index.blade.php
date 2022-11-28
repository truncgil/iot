<?php 
$u = u();
if(oturumisset("redirect")) {
    $url = oturum("redirect");
    unset($_SESSION['redirect']);
    yonlendir($url);
}

?>
@extends('admin.master')

@section('content')

<?php 
 $level = str_slug($u->level); 
if(getisset("t")) {
              
$t = get("t");

?>
              
@if(View::exists("admin.$level.$t"))
    @include("admin.$level.$t")
@endif

<?php } else  {  ?>
    @if(View::exists("admin.dashboard.$level"))
        @include("admin.dashboard.$level")
    @endif

<?php } ?>          


			
@endsection
