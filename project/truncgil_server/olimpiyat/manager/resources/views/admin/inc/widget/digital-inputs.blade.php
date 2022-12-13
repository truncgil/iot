 {{col("col-md-12 order-1","Digital Inputs",1)}} 
 <table class="table table-bordered w-50 mx-auto text-center">
    <tr>
        <?php foreach($digitalInputs AS $i)  {
             $value = substr(trim($i->sonuc),$i->bas,$i->son - $i->bas);
             // echo $value;
              $value = intval($value, 16); 
           ?>
         <td class="<?php if($value!=0) echo "bg-success";
         else echo "bg-danger" ?> text-white">{{$i->title}}
        </td> 
         <?php } ?>
    </tr>
 </table>
  
 {{_col()}}