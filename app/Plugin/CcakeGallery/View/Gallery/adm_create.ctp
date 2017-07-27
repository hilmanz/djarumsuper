<?php $this->Html->css(array('Ccake.ccake',"CcakeGallery.CcakeGallery"),null,array('inline'=>false)); ?>
<?php
	$this->Html->script(array('Ccake.ccake'),array('inline'=>false));
?>
<div class='container'>
	<div class="row gallery-header">
		<div class="span12">
			<h3 class="fl">Create Gallery</h3>
		</div>
	</div>
	<div class="row">
		<div class="span12 gl-form">
			<form action="<?=$this->Html->url('/adm/ccake_gallery/gallery/create')?>"
				method="post" enctype="application/x-www-form-urlencoded">
				<table>
					<tr><td><label>Gallery Name</label></td></tr>
					<tr><td><input type="text" name='name' placeholder="type a name here.."/></td></tr>
					<tr><td>Description</td></tr>
					<tr><td><input type="text" name='description' placeholder="a little description about these gallery"/></td></tr>
					<tr>
						<td>
							<input type="submit" name="btn" value="Create" class="btn btn-success"/>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>