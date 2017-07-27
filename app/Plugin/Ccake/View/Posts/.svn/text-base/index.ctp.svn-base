<div class="row">
	<div class="span8">
		<div class="row">
		<h3><?=$category_name?></h3>
		</div>

		<div class="row">
			<?php if(isset($posts)):foreach($posts as $post):?>
			<div class="post">
				<div class="title">
					<h4><?=h($post['Page']['title'])?></h5>
				</div>
				<div class="summary">
					<p><?=h($post['Post']['summary'])?>
						<a href="<?=$this->Html->url('/posts/'.$slug.'/read/'.$post['Post']['id'])?>">Read More</a>
					</p>
				</div>
				<div class="foot">
					Posted on : <?=date("d/m/Y H:i:s",strtotime($post['Post']['post_dt']))?>
					
				</div>
			</div>
			<?php endforeach;endif;?>
		</div>
	</div>
	<div class="span4">
		
	</div>
</div>