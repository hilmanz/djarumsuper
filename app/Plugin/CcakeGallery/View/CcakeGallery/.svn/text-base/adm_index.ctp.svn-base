<?php $this->Html->css(array('Ccake.ccake',"CcakeGallery.CcakeGallery"),null,array('inline'=>false)); ?>
<?php
	$this->Html->script(array('Ccake.ccake','bootstrap-dropdown'),array('inline'=>false));
?>

<div class='container'>
	<div class="row gallery-header">
		<div class="span12">
			<h3 class="fl">Gallery</h3>
			<a href="<?=$this->Html->url('/adm/ccake_gallery/gallery/create')?>" class="btn btn-large btn-info fr btn-create">Create Gallery</a>
		</div>
	</div>
	<div class="row search">
		<form class="form-search" action="<?=$this->Html->url('/adm/pages/search')?>" method="get" enctype="application/x-www-form-urlencoded">
			<input type="text" name="q" class="form-control" placeholder="Search a gallery.."/>
			<input type="submit" name="btn" value="Search" class="btn"/>
		</form>
	</div>
	<div class="row">
		<div class="span12 gl-content">
			<div class="gallery-list">
				<?php if(isset($galleries)) : foreach($galleries as $gallery):?>
				<div class="gallery-panels" data-id="<?=intval($gallery['id'])?>">
					<div class="thumb">
						<?php if($gallery['thumb']== null):?>
						<p class="nophoto"></p>
						<?php else: ?>
							<img src="<?=h($gallery['thumb'])?>"/>
						<?php endif;?>
					</div>
					<div class="caption">
						<p><a href="<?=$this->Html->url('/adm/ccake_gallery/gallery/view/'.$gallery['id'])?>"><?=h($gallery['name'])?></a></p>
					</div>
					
						<a href="#" data-id='<?=intval($gallery['id'])?>' class="btn-delete"><p class="opsi icon-trash"></p></a>
					
				</div>
				<?php endforeach;endif;?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="span12 center">
			<div class="pagination">
			  <ul>
			    <!--<a href="#" class="fui-arrow-right"></a>-->
			    <?php echo $this->Paginator->prev('',
			    									array('tag'=>'li','class'=>'previous','escape'=>false),
			    								  '<a href="#"></a>',
			    								  array('tag'=>'li','class'=>'previous','escape'=>false));?>
			    <?php echo $this->Paginator->numbers(array('tag'=>'li','currentClass'=>'active')); ?>
			   	<?php echo $this->Paginator->next('',
			    									array('tag'=>'li','class'=>'next','escape'=>false),
			    								   '<a href="#"></a>',
			    								  	array('tag'=>'li','class'=>'next','escape'=>false)
			    								  );?>
			   <script>
			   	$('li.previous').find('a').addClass('fui-arrow-left');
			   	$('li.next').find('a').addClass('fui-arrow-right');
			   </script>
			  </ul>
			</div>
		</div>
	</div>
</div>


<div id="confirmDelete" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 id="myModalLabel">Confirmation</h4>
  </div>
  <div class="modal-body">
  	<div class="confirmtext">
	    <p>Do you really want to delete these gallery ? </p>
	</div>
	<div class="result">
		<p></p>
	</div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
    <button class="btn-confirm-delete btn btn-primary">Yes</button>
  </div>
</div>

<script>
var selected_id = 0;
$('.btn-delete').click(function(e){
	selected_id = parseInt($(this).attr('data-id'));
	$("#confirmDelete").find('div.confirmtext').show();
	$("#confirmDelete").find('div.result').hide();
	$('.modal-footer').show();
	$("#confirmDelete").modal('show');

});
$('.btn-confirm-delete').click(function(e){
	//$("#confirmDelete").modal('hide');
	$("#confirmDelete").find('div.confirmtext').hide();
	$("#confirmDelete").find('div.result').show();
	$("#confirmDelete").find('div.result').find('p').html('Deleting the gallery, please wait..');
	
	api_call('<?=$this->Html->url('/adm/ccake_gallery/gallery/delete?id=')?>'+selected_id,
		function(response){
			if(response.status==1){
				$("#confirmDelete").find('div.result').find('p').html('The gallery has been deleted successfully !');
			}else{
				$("#confirmDelete").find('div.result').find('p').html('Sorry, something is wrong, please try again later !');
			}
			$('.modal-footer').hide();
			$(".gallery-panels").each(function(i,v){
				if($(v).attr('data-id')==selected_id){
					$(this).remove();
				}
			});
			selected_id = 0;
	});
});

</script>