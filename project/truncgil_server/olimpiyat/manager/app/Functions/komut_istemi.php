<?php 
function komut_istemi($id) {
    return db("komut_istemi")->where("id",$id)->first();
}
?>