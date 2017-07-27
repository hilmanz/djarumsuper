
<div class="row-fluid">
	<div class="span2 adm-sidebar">
		<?php echo $this->element('adm_menu_sidebar');?>
	</div>
	<div class="span10">
	<h3>Edit Menu</h3>
	<form action="<?=$this->Html->url('/adm/ccake/menu/edit/'.$rs['id'])?>" method="post" enctype="application/x-www-form-urlencoded">
		<table width="100%" cellpadding="10" class="table table-striped table-bordered table-hover table-condensed">
			<tbody>
				<tr>
					<td><h5>Page Name</h5></td>
				</tr>
				<tr>
					<td><input type="text" name="name" value="<?=h($rs['name'])?>"/></td>
				</tr>
				<tr>
					<td><h5>Url</h5></td>
				</tr>
				<tr>
					<td>
						<input type="text" name="url" value="<?=h($rs['url'])?>"/>
						<span>Example : /pages/about-us </span>
					</td>
				</tr>
				<tr>
					<td><input type="submit" name="btn" value="Save Changes" class="btn btn-warning"/></td>
				</tr>
			</tbody>
		</table>
	</form>
	</div>
</div>
