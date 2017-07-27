<?php $this->Html->css("Ccake.ccake",null,array('inline'=>false)); ?>
<?php $this->Html->script("Ccake.ccake",array('inline'=>false)); ?>
<div class="row-fluid">
	<div class="span2 adm-sidebar">
		<?php echo $this->element('adm_layouts_sidebar');?>
	</div>
	<div class="span10">
		<div class="content">
			<div class="row">
				<h4>Layout Manager</h4>
			</div>
			
			<div class="row">
				<table width="100%" cellpadding="10" class="table table-striped table-bordered table-hover table-condensed">
				<thead>
					<th>
						Name
					</th>
					<th>
						Action
					</th>
				</thead>
				<?php if(isset($layouts)):?>
				<tbody>
					<?php foreach($layouts as $layout):?>
					<tr>
						
						<td>
							<?=h($layout['Layout']['name'])?>
						</td>
						
						<td>
							<a href="<?=$this->Html->url('/adm/ccake/layouts/edit/'.$layout['Layout']['id'])?>" class="btn btn-warning">Edit</a> 
							<a href="<?=$this->Html->url('/adm/ccake/layouts/delete/'.$layout['Layout']['id'])?>" class="btn btn-danger">Delete</a>
						</td>
					</tr>
					<?php endforeach;?>
				</tbody>
				<?php else:?>
				<tbody>
					<tr>
						<td colspan='4'>
							No Layout available yet
						</td>
					</tr>
				</tbody>
				<?php endif;?>	
			</table>
			<?php 
				if(isset($layouts)):
			?>
			<div class="pagination">
			  <ul>
			  	<?php echo $this->Paginator->prev(h('Previous'),array('tag'=>'li',
			  													  'disabledTag'=>'a'),'',
			  												array('tag'=>'li',
			  														'class' => 'disabled',
			  														'disabledTag'=>'a'));?>
			  	<?php echo $this->Paginator->numbers(array('tag'=>'li',
			  											  'separator'=>'',
			  											  'currentTag'=>'a',
			  											  'currentClass'=>'active'));?>
			    <?php echo $this->Paginator->next(h('Next'),array('tag'=>'li',
			  													  'disabledTag'=>'a'),'',
			  												array('tag'=>'li',
			  														'class' => 'disabled',
			  														'disabledTag'=>'a'));?>
			  </ul>
			</div>
			<?php endif;?>
			</div>
		</div>

	</div>
</div>
