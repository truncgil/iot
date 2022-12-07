<?php 
if(!isset($tutar)) $tutar = $paketler['LGS'];
if(oturumesit("paket","YKS"))  { 
  ?>
 <div class="areas-of-practice__single">
     <div class="areas-of-practice__icon-box">
         <div class="areas-of-practice__icon">
             <p align="center"><font style="font-size: 30px;" color="#474747"><del>1598 ₺</del></font>
             <strong></strong></p><p align="center"><strong><font style="font-size: 70px;" class="price" color="#005d69">{{price($tutar)}}</font></strong><br>
             <font size="+2" color="#e94e1b">/paket</font><br>
             Öğrenci Başına</p>
         </div>
         <div align="center" class="areas-of-practice__title" style="margin-bottom: 20px">
             <a href="https://app.dijimind.com/odeme?paket=YKS" class="thm-btn "><span>YKS PAKETİ</span></a>
         </div>
     </div>
     <?php $html = c("yks-paket-icerigi");
                                 ?>
                                 <?php echo $html->html ?>
     
 </div>  
 <?php } else {
      ?>
      <div class="areas-of-practice__single">
        <div class="areas-of-practice__icon-box">
            <div class="areas-of-practice__icon">
                <p align="center"><font style="font-size: 30px;" color="#474747"><del>1598 ₺</del></font>
                <strong></strong></p><p align="center"><strong><font style="font-size: 70px;" class="price"  color="#005d69">{{price($tutar)}}</font></strong><br>
                <font size="+2" color="#e94e1b">/paket</font><br>
                Öğrenci Başına</p>
            </div>
            <div align="center" class="areas-of-practice__title" style="margin-bottom: 20px">
                <a href="https://app.dijimind.com/odeme?paket=LGS" class="thm-btn "><span>LGS PAKETİ</span></a>
            </div>
        </div>
        <?php $html = c("lgs-paket-icerigi");
                                 ?>
                                 <?php echo $html->html ?>
    </div>
      <?php 
 } ?>