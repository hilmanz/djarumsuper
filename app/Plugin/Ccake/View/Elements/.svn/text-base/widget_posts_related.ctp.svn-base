<?php
if(isset($CATEGORY_SLUG)){
	$POST_ID = intval(@$POST_ID);
	$posts = $this->requestAction('/ccake/posts/widget_related_posts/'.$CATEGORY_SLUG.'?id='.$POST_ID);
}else{
	$posts = $this->requestAction('/ccake/posts/widget_related_posts');	
}

?>
<h4>Related Posts</h4>
<div class="widget">
	
		<?php if(isset($posts)):foreach($posts as $post):?>
		<div class="item">
		<a href="<?=$this->Html->url('/posts/'.$post['PostCategory']['slug'].'/read/'.$post['Post']['id'])?>">
			<?=h($post['Page']['title'])?>
		</a>
		<p class="dt"><?=h(date("F d, Y",strtotime($post['Post']['post_dt'])))?></p>
		</div>
		<?php endforeach;
		      else: 
		?>
		<div class="item">
		<p>No Post Available</p>
		</div>
		<?php endif;?>
	
</div>