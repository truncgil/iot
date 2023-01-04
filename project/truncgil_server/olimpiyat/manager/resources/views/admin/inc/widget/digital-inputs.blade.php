 {{col("col-md-12 order-1","")}} 
 <div class="table-responsive digital-inputs">
   <table class=" table table-bordered table-rounded w-100 m-0 mx-auto text-center">
      <tr>
         <th style="">Digital Inputs</th>
         <?php foreach($digitalInputs AS $i)  {
               $value = substr(trim($i->sonuc),$i->bas,$i->son - $i->bas);
               // echo $value;
               $value = intval($value, 16); 
            ?>
            <td class="<?php if($value!=0) echo "bg-success";
            else echo "bg-dark" ?> text-white" title="{{$value}}">{{$i->title}}
            
            
         </td> 
            <?php } ?>
            <td style="">
               <div 
                  style="font-size:16px"
                     class="btn btn-primary"
                     id="digital-inputs-guncelle"
                     >
                     <i class="fa fa-refresh"></i> 
                     Digital Inputları Güncelle
               </div>
            </td>
      </tr>
   </table>
</div>
<style>
   .digital-inputs td, .digital-inputs th {
      vertical-align:middle !important;
   }
   .digital-inputs {
      min-height: 0px; 
   }
</style>
  
 {{_col()}}