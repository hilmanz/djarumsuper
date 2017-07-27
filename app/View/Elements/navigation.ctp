<?php

if(!isset($curr_page)){
	$curr_page = "HOME";
}

?>
<div id="navBar" class="grad">
   <ul class="sf-menu" id="navigations">
        <li <?php if($curr_page=='HOME'):?>class="active"<?php endif;?>><?php echo $this->Html->link("Home",'/',array('class'=>'home','escape'=>false));?></li>
        <li <?php if($curr_page=='ADVENTURE'):?>class="active"<?php endif;?>><?php echo $this->Html->link('SuperAdventure','/articles/journals/index');?>
            <ul>
                <li><?php echo $this->Html->link('land','/articles/land');?></li>
				<li><?php echo $this->Html->link('water','/articles/water');?></li>
                <li><?php echo $this->Html->link('air','/articles/air');?></li>
            </ul>
        </li>
         <li <?php if($curr_page=='TRIP'):?>class="active"<?php endif;?>><?php echo $this->Html->link('Destinasi','/articles/trip');?>
            <!--
            <ul>
                <li><?php echo $this->Html->link('land','/articles/destinations/land');?></li>
				<li><?php echo $this->Html->link('water','/articles/destinations/water');?></li>
                <li><?php echo $this->Html->link('air','/articles/destinations/air');?></li>
            </ul>
            -->
        </li>
       <!-- <li <?php if($curr_page=='MEETING'):?>class="active"<?php endif;?>><?php echo $this->Html->link('Meeting Post','/forum');?></li>
        <li <?php if($curr_page=='OTG'):?>class="active"<?php endif;?>><?php echo $this->Html->link('On The Go','/otg');?></li>
        <li><?php echo $this->Html->link('events','/articles/events/index');?></li>-->
        <li <?php if($curr_page=='MUSIC'):?>class="active"<?php endif;?>><?php echo $this->Html->link('SuperMusic','/articles/music/');?></li>
        <li <?php if($curr_page=='GALLERY'):?>class="active"<?php endif;?>><?php echo $this->Html->link('Galeri','/gallery/index');?>
            <ul>
                <li><?php echo $this->Html->link('Photo','/gallery/index');?></li>
				<li><?php echo $this->Html->link('Video','/video');?></li>
            </ul>
        </li>
        <li<?php if($curr_page=='AKTIFITAS'):?> class="active"<?php endif;?>><?php echo $this->Html->link('Aktifitas','/articles/aktifitas');?></li>
        <li<?php if($curr_page=='PRODUCT'):?> class="active"<?php endif;?>><?php echo $this->Html->link('The Brand','/articles/products');?></li>
    </ul>
</div><!-- end #navBar -->