<?php $this->Html->css("Ccake.ccake",null,array('inline'=>false)); ?>
<?php $this->Html->script("Ccake.ccake",array('inline'=>false)); ?>
<div class="row-fluid">
	<div class="span2 adm-sidebar">
		<?php echo $this->element('adm_menu_sidebar');?>
	</div>
	<div class="span10">
	<h3>Menu Configuration</h3>
		<h4>
			<?php
				if(isset($parent_menu)){
					foreach($parent_menu as $pm){

						$this->Html->addCrumb(h($pm['name']), 
												'/adm/ccake/menu/index/'.intval($pm['id']));
					}
				}
			?>
			<?php echo $this->Html->getCrumbs(' &raquo; ', array('text'=>'Home','url'=>'/adm/ccake/menu/index'));?>
		</h4>
		<?php if(isset($menusets)):?>
		<ul class="sortable">
			<?php foreach($menusets as $menu):?>
			<li id="menu-<?=intval($menu['Menu']['id'])?>" class="menudnd">
				<span><?=h($menu['Menu']['name'])?> (<?=h($menu['Menu']['url'])?>)</span>
				<span class="options fr">
					<a href="<?=$this->Html->url('/adm/ccake/menu/index/'.$menu['Menu']['id'])?>" class="btn btn-info">Sub Menu</a> 
					<a href="<?=$this->Html->url('/adm/ccake/menu/edit/'.$menu['Menu']['id'])?>" class="btn btn-warning">Edit</a> 
					<a href="<?=$this->Html->url('/adm/ccake/menu/delete/'.$menu['Menu']['id'])?>" class="btn btn-danger">Delete</a>
				</span>
			</li>
			<?php endforeach;?>
		<?php else:?>
			No Page available yet
		<?php endif;?>
		</ul>
		<div>
			<a id="btn-save" href="#" class="btn btn-success fr">Save Changes</a>
			<a class="btn btn-success fr gsr-4" href="<?=$this->Html->url('/adm/ccake/menu/new?pid='.$parent_id)?>">Add Page</a>
		</div>
	</div>
</div>
 <script>
  $(function() {
  	$( "#btn-save").click(function(e){
  		var sortedIDs = $( ".sortable" ).sortable( "toArray" );
  		//do something here
  		var ids = [];
  		for(var i in sortedIDs){
  			ids.push(sortedIDs[i].split('menu-').join(''));
  		}
  		api_post("<?=$this->Html->url('/adm/ccake/menu/update_pos')?>",{sort:ids},function(response){});
  		sortedIDs = null;
  		//-->
  	});
    $( ".sortable" ).sortable();
    $( ".sortable" ).disableSelection();
  });
  </script>