<?php function col($size,$title="",$color="") {
    $colors = colors();
     if($color == 0) {
          $color = rand(0,count($colors)-1);
     }
     ?>
     <div class="<?php echo $size ?>">
        <div class="block block-themed">
            <?php if($title!="") {
                 ?>
                 <div class="block-header bg-<?php echo $colors[$color]; ?>"><?php echo $title ?></div>
                 <?php 
            } ?>
            
            <div class="block-content">
               
           
     <?php 
}
function _col() {
     ?>
      </div>
        </div>
    </div>
     <?php 
}
?><?php function col2($class="",$title="",$color="0") {
    $colors = colors();
   
     ?>
     
        <div class="<?php echo $class ?> block block-themed">
            <?php if($title!="") {
                 ?>
                 <div class="block-header bg-<?php echo $colors[$color]; ?>"><?php echo $title ?></div>
                 <?php 
            } ?>
            
            <div class="block-content">
               
           
     <?php 
}
function _col2() {
     ?>
      </div>
        </div>
   
     <?php 
}
?>