
<div id="nivo" >

         
       <?php
		  		$slider_flag = false;
		  		for ($i=1;$i<6;$i++) {
		  			$caption = ((of_get_option('slidetitle'.$i, true)=="")?"":"#caption_".$i);
					if ( of_get_option('slide'.$i, true) != "" ) {
						echo "<div class='slide'><a href='".of_get_option('slideurl'.$i, true)."'><img src='".of_get_option('slide'.$i, true)."' title='".$caption."'></a></div>"; 
						$slider_flag = true;
					}
				}
				?>  
        </div>
        
     <?php if(of_get_option('sldrtxt_checkbox') == "1"){ ?>    
<?php for ($i=1;$i<6;$i++) {
    				$caption = ((of_get_option('slidetitle'.$i, true)=="")?"":"#caption_".$i);
    				if ($caption != "")
    				{
	    				echo "<div id='caption_".$i."' class='nivo-html-caption'>";
	    				echo "<h2  href='".of_get_option('slideurl'.$i, true)."'></h2>
						
						<h3>".of_get_option('slidetitle'.$i, true)."</h3>" ;
							    				echo "<p>".of_get_option('slidedesc'.$i, true)."</p>"; 
						
	    				echo "</div>";  
    				}
    			}	
    	    
			?>
  
    </div>	</a>
	<?php 
			
		
		?>
                
    <?php } ?>    
    
