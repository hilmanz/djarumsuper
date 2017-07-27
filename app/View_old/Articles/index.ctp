<div id="header">
   <div id="banner" class="grad">
  <div class="slider">
  	<?php if(isset($top_banners)):foreach($top_banners as $top_banner):?>
    		<?php 
				$image =  $this->Html->image("/content/banner/big_{$top_banner['Banner']['filename']}");
				if(@eregi("http://",$banners['Banner']['urlto'])){
					//this is an external link. so we add attribute target=_blank
					echo "<div>".$this->Html->link($image,$top_banner['Banner']['urlto'],array("target"=>"_blank","escape"=>false))."</div>";
				}else{
					echo "<div>".$this->Html->link($image,$top_banner['Banner']['urlto'],array("escape"=>false))."</div>";
				}
			?>
	<?php endforeach;endif;?>
  	<?php if(@$land[0]['MainImg'][0]['filename']):?>
    <div><?php echo $this->Html->image("/content/images/{$land[0]['MainImg'][0]['filename']}", array(
    									'url' => array('controller' => 'articles', 'action' => 'land',$land[0]['Category']['name_str'],'view',$land[0]['Article']['id'])
										));
							?>
	</div>
	<?php endif;?>
	<?php if(@$air[0]['MainImg'][0]['filename']):?>
     <div>
     	
     	<?php echo $this->Html->image("/content/images/{$air[0]['MainImg'][0]['filename']}", array(
    									'url' => array('controller' => 'articles', 'action' => 'air',$air[0]['Category']['name_str'],'view',$air[0]['Article']['id'])
										));
							?>
	</div>
	<?php endif;?>
	<?php if(@$water[0]['MainImg'][0]['filename']):?>
     <div><?php echo $this->Html->image("/content/images/{$water[0]['MainImg'][0]['filename']}", array(
    									'url' => array('controller' => 'articles', 'action' => 'water',$water[0]['Category']['name_str'],'view',$water[0]['Article']['id'])
										));
							?>
	</div>
	<?php endif;?>
    
  </div><!-- end .slider -->
</div><!-- end #banner -->
</div><!-- end #header -->
<div id="container">
    <div id="content" class="homePage">
        <div id="ring"></div>
        <div class="paper">
            <div class="content">
            	<?php if(isset($land[0])):?>
                <div class="row">
                    <h1 class="cat-title"><?php echo $this->Html->link("FEATURED LAND STORIES","/articles/land");?></h1>
                    <div class="post">
                    	<?php if(@$land[0]['MainImg'][0]['filename']):?>
                        <div class="thumb">
                        	<?php echo $this->Html->image("/content/images/thumb_{$land[0]['MainImg'][0]['filename']}", array(
    									'url' => array('controller' => 'articles', 'action' => 'land',$land[0]['Category']['name_str'],'view',$land[0]['Article']['id'])
										));
							?>
                           
                        </div><!-- end .thumb -->
                        <?php endif;?>
                        <div class="entry">
                            <h1 class="title">
                            	<?php echo $this->Html->link(strip_tags($land[0]['Article']['title']),
                            							array('controller' => 'articles', 'action' => 'land',
                            								  $land[0]['Category']['name_str'],
                            								  'view',
                            								  $land[0]['Article']['id'])
														);?>
                            </h1>
                            <p><?php echo strip_tags($land[0]['Article']['summary']);?></p>
                        </div><!-- end .entry -->
                    </div><!-- end .post -->
                    <?php echo $this->Html->link('Daftar berita selengkapnya','/articles/land/',array('class'=>'readmore'));?>
                </div><!-- end .row -->
                <?php endif;?>
                <?php if(isset($air[0])):?>
                <div class="row">
                    <h1 class="cat-title"><?php echo $this->Html->link("FEATURED AIR STORIES","/articles/air");?></h1>
                     <div class="post">
                     	<?php if(@$air[0]['MainImg'][0]['filename']):?>
                        <div class="thumb">
                        	<?php echo $this->Html->image("/content/images/thumb_{$air[0]['MainImg'][0]['filename']}", array(
    									'url' => array('controller' => 'articles', 'action' => 'air',$air[0]['Category']['name_str'],'view',$air[0]['Article']['id'])
										));
							?>
                        </div><!-- end .thumb -->
                        <?php endif;?>
                        <div class="entry">
                            <h1 class="title">
                            	
                            	<?php echo $this->Html->link(strip_tags($air[0]['Article']['title']),
                            							array('controller' => 'articles', 'action' => 'air',
                            								  $air[0]['Category']['name_str'],
                            								  'view',
                            								  $air[0]['Article']['id'])
														);?>
                            </h1>
                              <p><?php echo strip_tags($air[0]['Article']['summary']);?></p>
                        </div><!-- end .entry -->
                    </div><!-- end .post -->
                   <?php echo $this->Html->link('Daftar berita selengkapnya','/articles/air/',array('class'=>'readmore'));?>
                </div><!-- end .row -->
                <?php endif;?>
                <?php if(isset($water[0])):?>
                <div class="row">
                    <h1 class="cat-title"><?php echo $this->Html->link("FEATURED WATER STORIES","/articles/water");?></h1>
                     <div class="post">
                     	<?php if(@$water[0]['MainImg'][0]['filename']):?>
                        <div class="thumb">
                        	<?php echo $this->Html->image("/content/images/thumb_{$water[0]['MainImg'][0]['filename']}", array(
    									'url' => array('controller' => 'articles', 'action' => 'water',$water[0]['Category']['name_str'],'view',$water[0]['Article']['id'])
										));
							?>
                           
                        </div><!-- end .thumb -->
                        <?php endif;?>
                        <div class="entry">
                            <h1 class="title">
                            	<?php echo $this->Html->link(strip_tags($water[0]['Article']['title']),
                            							array('controller' => 'articles', 'action' => 'water',
                            								  $water[0]['Category']['name_str'],
                            								  'view',
                            								  $water[0]['Article']['id'])
														);?>
                            </h1>
                             <p><?php echo strip_tags($water[0]['Article']['summary']);?></p>
                        </div><!-- end .entry -->
                    </div><!-- end .post -->
                   <?php echo $this->Html->link('Daftar berita selengkapnya','/articles/water/',array('class'=>'readmore'));?>
                </div><!-- end .row -->
                <?php endif;?>
            </div><!-- end .content -->
        </div><!-- end .paper -->
    </div><!-- end #content -->
    <div id="sidebar">
    	<!--merchandise-->
        <?php echo $this->element('merchandise');?>
        <!--bannerSmall-->
    	 <div class="box grad bannerSmall">
         <?php echo $this->Html->image("/content/banner/trip_advisor.jpg", array(
    									'url' => array('controller' => 'articles', 'action' => 'trip','index')
										));
			?>
        </div><!-- end .box -->
         <div class="box grad bannerSmall">
         <?php echo $this->Html->image("/content/banner/onthego.jpg", array(
    									'url' => array('controller' => 'articles', 'action' => 'on_the_go','index')
										));
		  ?>
        </div><!-- end .box -->
    </div><!-- end #sidebar -->
</div><!-- end #container -->