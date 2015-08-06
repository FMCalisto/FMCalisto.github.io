 <div class="clients">
        <div class="title">
          <h2 class="green1"><?php echo of_get_option('our_client'); ?></h2>
        </div>
        
        
        <div class="work-carousel">
              <div class="work-carousel-head"> <a class="prev" id="work-carousel-prev2" href="#" ><span>prev</span></a> <a class="next" id="work-carousel-next2" href="#"><span>next</span></a> </div>    
        <div class="carousel_content">
        <div class="caroufredsel_wrapper" >
        <ul id="work-carousels" >
        <li>
        <?php  if(of_get_option('client1')){ ?>
        <div class="client"> <a href="<?php echo of_get_option('clienturl1'); ?>"><img  src="<?php echo of_get_option('client1'); ?>" alt="" /> </a> </div></li>
         <?php } ?>
        <li>
        <?php  if(of_get_option('client2')){ ?>
         <div class="client"> <a href="<?php echo of_get_option('clienturl2'); ?>"><img  src="<?php echo of_get_option('client2'); ?>" alt="" /> </a></div> </li>
       <?php } ?>
    <li>
    <?php  if(of_get_option('client3')){ ?>
    <div class="client"> <a href="<?php echo of_get_option('clienturl3'); ?>"><img  src="<?php echo of_get_option('client3'); ?>" alt="" /> </a> </div> 
</li>
<?php } ?>
<li>
<?php  if(of_get_option('client4')){ ?>
 <div class="client"> <a href="<?php echo of_get_option('clienturl4'); ?>"><img  src="<?php echo of_get_option('client4'); ?>" alt="" /> </a> 
</div></li><?php } ?>
<?php  if(of_get_option('client5')){ ?>
 <div class="client"> <a href="<?php echo of_get_option('clienturl5'); ?>"><img  src="<?php echo of_get_option('client5'); ?>" alt="" /> </a> 
</div></li><?php } ?>

</ul></div>
      </div>
    </div>
  </div>