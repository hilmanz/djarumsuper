<div id="navBar" class="grad">
   <ul class="sf-menu">
        <li><?php echo $this->Html->link("&nbsp",'/',array('class'=>'home','escape'=>false));?></li>
        <li><a href="#">Adventure</a>
            <ul>
                <li><a href="#">By Activities</a>
                    <ul>
                        <li><?php echo $this->Html->link('land','/articles/land');?>
                        	<!--
                        	<ul>
                        		<li><?php echo $this->Html->link('Hiking','/articles/land/hiking');?></li>
                        		<li><?php echo $this->Html->link('Caving','/articles/land/caving');?></li>
                        		<li><?php echo $this->Html->link('Mountain Climbing',
                        										'/articles/land/mountain_climbing');?></li>
                        		<li><?php echo $this->Html->link('Rock Climbing','/articles/land/rock_climbing');?></li>
                        		<li><?php echo $this->Html->link('Biking','/articles/land/biking');?></li>
                        		<li><?php echo $this->Html->link('Offroad','/articles/land/offroad');?></li>
                        	</ul>-->
                        </li>
                        <li>
                        	<?php echo $this->Html->link('water','/articles/water');?>
                        	<!--
                        	<ul>
                        		<li><?php echo $this->Html->link('Snorkeling','/articles/water/snorkeling');?></li>
                        		<li><?php echo $this->Html->link('Diving','/articles/water/diving');?></li>
                        		<li><?php echo $this->Html->link('Surfing / Wind Surfing',
                        										'/articles/water/surfing');?></li>
                        		<li><?php echo $this->Html->link('Parasailing','/articles/water/parasailing');?></li>
                        		<li><?php echo $this->Html->link('Canoeing / Kayaking','/articles/water/canoeing');?></li>
                        		
                        	</ul>
                        	-->
                        </li>
                        <li><?php echo $this->Html->link('air','/articles/air');?>
                        	<!--
                        	<ul>
                        		<li><?php echo $this->Html->link('Paragliding','/articles/air/paragliding');?></li>
                        	</ul>
                        	-->
                        </li>
                    </ul>
                </li>
                <li><?php echo $this->Html->link('journals','/articles/journals/index');?></li>
                <li><?php echo $this->Html->link('on the go','/otg');?></li>
                <li><?php echo $this->Html->link('trip advisor','/articles/trip');?></li>
                <li><?php echo $this->Html->link('photography','/gallery/index');?></li>
            </ul>
        </li>
        <li><?php echo $this->Html->link('events','/articles/events/index');?></li>
        <li><?php echo $this->Html->link('product','/articles/products');?></li>
    </ul>
</div><!-- end #navBar -->