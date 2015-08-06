


<div class="our_team">
        <div class="title">
          <h2 class="blue1"><?php echo of_get_option('ourteam_work'); ?></h2>
          <p><?php echo of_get_option('ourteam_work2'); ?></p>
        </div>
        <div id="middle" class="cols2 sidebar_left box_white">
          <div class="content" role="main">
            <article class="post-detail">
              <div class="entry">
                <div class="work-carousel">
                  <div class="work-carousel-head"> <a class="prev" id="work-carousel-prev3" href="#" ><span>prev</span></a> <a class="next" id="work-carousel-next3" href="#"><span>next</span></a> </div>
                  <div class="carousel_content">
                    <div class="caroufredsel_wrapper" >
                      <ul id="work-carousel3" >
                        <li>
                        <?php  if(of_get_option('ourteam1')){ ?>
                          <div class="work">
                            <div class="main">
                           
                            
                              <div class="view_team view-fifth"> <img  src="<?php echo of_get_option('ourteam1'); ?>" alt="<?php echo of_get_option('ourteamtitle1'); ?>" />
                            <a href="<?php echo of_get_option('ourteamurl1'); ?>" >
                                <div class="mask">
                                
                                <?php  if(of_get_option('ourteamtitle1')){ ?>
                                  <h2><?php echo of_get_option('ourteamtitle1'); ?></h2>
                                  <?php } ?>
                                  <p><?php echo of_get_option('ourteamdesc1'); ?></p>
                                   </div>
                                   </a>
                              </div>
                            </div>
                            <p class="port_team"><a href="<?php echo of_get_option('ourteamurl1'); ?>"><?php echo of_get_option('ourteamtitle1'); ?></a></p>
                          </div>
                        </li>
                        <li>
						 <?php } ?>
                         
				<?php  if(of_get_option('ourteam2')){ ?>		
                          <div class="work">
                            <div class="main">
                              <div class="view_team view-fifth"> <img  src="<?php echo of_get_option('ourteam2'); ?>" alt="<?php echo of_get_option('ourteamtitle2'); ?>" />
                                <a href="<?php echo of_get_option('ourteamurl2'); ?>" >
                               <div class="mask">
                             
                                <?php  if(of_get_option('ourteamtitle2')){ ?>
                                  <h2><?php echo of_get_option('ourteamtitle2'); ?></h2>
                                  <?php } ?>
                                  <p><?php echo of_get_option('ourteamdesc2'); ?></p>
                                   </div>
                                   </a>
                              </div>
                            </div>
                            <p class="port_team"><a href="<?php echo of_get_option('ourteamurl2'); ?>"><?php echo of_get_option('ourteamtitle2'); ?></a></p>
                          </div>
                        </li>
                        <li>
						
						 <?php } ?>
                         
                        <?php  if(of_get_option('ourteam3')){ ?>	
                          <div class="work">
                            <div class="main">
                              
                              <div class="view_team view-fifth"> <img  src="<?php echo of_get_option('ourteam3'); ?>" alt="<?php echo of_get_option('ourteamtitle3'); ?>" />
                              <a href="<?php echo of_get_option('ourteamurl3'); ?>" >
                               <div class="mask">
                               
                                <?php  if(of_get_option('ourteamtitle3')){ ?>
                                  <h2><?php echo of_get_option('ourteamtitle3'); ?></h2>
                                  <?php } ?>
                                  <p><?php echo of_get_option('ourteamdesc3'); ?></p>
                                  </div>
                                  </a>
                              </div>
                            </div>
                            <p class="port_team"><a href="<?php echo of_get_option('ourteamurl3'); ?>"><?php echo of_get_option('ourteamtitle3'); ?></a></p>
                          </div>
                        </li>
                        <li >
						<?php } ?>
                        
                        <?php  if(of_get_option('ourteam4')){ ?>	 
                        
                          <div class="work">
                            <div class="main">
                              
                              <div class="view_team view-fifth"> <img  src="<?php echo of_get_option('ourteam4'); ?>" alt="<?php echo of_get_option('ourteamtitle4'); ?>" />
                              <a href="<?php echo of_get_option('ourteamurl4'); ?>" >
                                <div class="mask">
                               
                                <?php  if(of_get_option('ourteamtitle4')){ ?>
                                  <h2><?php echo of_get_option('ourteamtitle4'); ?></h2>
                                  <?php } ?>
                                  <p><?php echo of_get_option('ourteamdesc4'); ?></p>
                                 </div></a> 
                              </div>
                            </div>
                            <p class="port_team"><a href="<?php echo of_get_option('ourteamurl4'); ?>"><?php echo of_get_option('ourteamtitle4'); ?></a></p>
                          </div>
                        </li>
                        
						
						<?php } ?>
                        
                        
                       
                    
                         
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </article>
            </div></div>