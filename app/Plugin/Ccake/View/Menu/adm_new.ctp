<?php
if(isset($parent_menu)){
	$parent_name = "`".h($parent_menu['name'])."`";
}else{
	$parent_name = "";
}
?>
<div class="row-fluid">
	<div class="span2 adm-sidebar">
		<?php echo $this->element('adm_menu_sidebar');?>
	</div>
	<div class="span10">
		<div>
			<h4><?php echo $this->Html->getCrumbs(' < ', array('text'=>'Back to Menu List','url'=>'/adm/ccake/menu'));?></h4>
		</div>
		<div>
			<p>Add a Page to Menu <a href="<?=$this->Html->url('/adm/ccake/menu/index/'.intval(@$parent_menu['id']))?>"><?=$parent_name?></a></p>
			<form action="<?=$this->Html->url('/adm/ccake/menu/new')?>" method="post" enctype="application/x-www-form-urlencoded">
				<table width="100%" cellpadding="10" class="table table-striped table-bordered table-hover table-condensed">
					<tbody>
						<tr>
							<td><label>Page Name</label></td>
						</tr>
						<tr>
							<td><input type="text" name="name" value=""/></td>
						</tr>
						<tr>
							<td><label>Url</label></td>
						</tr>
						<tr>
							<td>
								<input type="text" name="url" value=""/>
								<span>Example : /pages/about-us </span>
							</td>
						</tr>
						<tr>
							<td>
								<input type="hidden" name="pid" value="<?=intval(@$parent_menu['id'])?>">
								<input type="submit" name="btn" value="Attach Page to Menu" class="btn btn-warning"/></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</div>
