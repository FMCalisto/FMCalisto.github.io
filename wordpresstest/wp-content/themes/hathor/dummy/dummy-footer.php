
<!--FOOTER SIDEBAR-->
    <?php if ( is_active_sidebar( 'foot_sidebar' ) ) { ?>
    <div id="footer">
    <div class="row">
     <div class=" large-12">
    
    <div class="widgets"><?php if ( is_active_sidebar('dynamic_sidebar') || !dynamic_sidebar('Footer Widgets') ) : ?><?php endif; ?>
            </div>
   </div>  </div>
   </div>	
     <?php } ?> 
 


	<!--COPYRIGHT TEXT-->
    <div id="copyright">
    <div class="row">
    <div class="large-12">
    
            <div class="copytext">
           <?php echo of_get_option('footer_textarea'); ?>
		   <?php _e('Theme by', 'hathor');?> <a target="_blank" href="http://www.imonthemes.com/">Imon Themes</a>
            </div>
        <!--FOOTER MENU-->    
            <div class="social-profiles clearfix">
				
                <ul>
				<?php if ( of_get_option('fbsoc_text') ) { ?>

        <li class="facebook"> <a  href="<?php echo of_get_option('fbsoc_text');?>" title="facebook"></a></li><?php } ?>
         
                <?php if ( of_get_option('ttsoc_text') ) { ?>
                <li class="twitter"><a  href="<?php echo of_get_option('ttsoc_text'); ?>" target="_blank" title="twitter">twitter</a></li><?php } ?>
                
                <?php if ( of_get_option('gpsoc_text') ) { ?>
                <li class="google-plus"><a href="<?php echo of_get_option('gpsoc_text'); ?>" title=" Google Plus" target="_blank"> Google Plus</a></li><?php } ?>
                
                 <?php if ( of_get_option('pinsoc_text') ) { ?>
                <li class="pinterest"><a href="<?php echo of_get_option('pinsoc_text'); ?>" title=" Pinterest" target="_blank"> Pinterest</a></li>
                <?php } ?>
                
                 <?php if ( of_get_option('ytbsoc_text') ) { ?>
                <li class="you-tube"><a href="<?php echo of_get_option('ytbsoc_text'); ?>" title=" Youtube" target="_blank"> Youtube</a></li><?php } ?>
                
                <?php if ( of_get_option('linsoc_text') ) { ?>
                <li class="linked"><a href="<?php echo of_get_option('linsoc_text'); ?>" title=" linked" target="_blank"> linked</a></li><?php } ?>
                
                <?php if ( of_get_option('vimsoc_text') ) { ?>
                <li class="vimeo"><a href="<?php echo of_get_option('vimsoc_text'); ?>" title=" Vimeo" target="_blank"> Vimeo</a></li><?php } ?>
                
                  <?php if ( of_get_option('flisoc_text') ) { ?>
                <li class="flickr"><a href="<?php echo of_get_option('flisoc_text'); ?>" title=" flickr" target="_blank"> flickr</a></li><?php } ?>
                
                 <?php if ( of_get_option('rsssoc_text') ) { ?>
                <li class="rss"><a href="<?php echo of_get_option('rsssoc_text'); ?>" title="rss" target="_blank"> rss</a></li><?php } ?>
                
			</ul>
           
			</div>
           <a href="#" class="scrollup"> &uarr;</a>   
    </div>
</div>

</div>




