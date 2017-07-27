<div class="row">
<h3><a href="<?=$this->Html->url('/posts/'.$slug)?>"><?=h($category_name)?></a></h3>
</div>
<div class="row">
	<div class="span8">
		<div class="row">
		<h3><?=h($post['Page']['title'])?></h3>
		<span class="date">Posted on : <?=date("d/m/Y H:i:s",strtotime($post['Post']['post_dt']))?></span>
		</div>

		<div class="row">
			<?=($post['Page']['content'])?>
		</div>
			
		
	</div>
	<div class="span4">
		<?php
			echo $this->element('Ccake.widget_posts_related');
		?>
	</div>
</div>