<?php 
if($c2->alt_type=="") {
    $type = "read";
} else {
    $type = $c2->alt_type;
}

 ?>
@include("admin.inc.widget.$type")
