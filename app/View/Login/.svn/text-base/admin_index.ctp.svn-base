<?php
if(isset($rs)){
	$pageParams = $this->Paginator->params();
	$currPage = $pageParams['page'];
	$pageLimit = $pageParams['limit'];
}
?>
<div class="content">
	<h3>Members</h3>
	<table width="100%" class="tablestyle">
		<tr>
			<td>No</td>
			<td><?=$this->Paginator->sort('name')?></td>
			<td><?=$this->Paginator->sort('email')?></td>
			<td><?=$this->Paginator->sort('role')?></td>
			<td><?=$this->Paginator->sort('register_date')?></td>
			<td></td>
		</tr>
		<?php
		foreach($rs as $n=>$r):
		?>
		<tr>
			<td><?=($n+1+(($currPage-1)*$pageLimit))?></td>
			<td><?=h($r['Login']['name'])?></td>
			<td><?=h($r['Login']['email'])?></td>
			<td>
				<?php
					$roles = array('Member','Contributor','Administrator');
					echo h($roles[$r['Login']['role']]);
				?>
			</td>
			<td><?=date("d/m/Y H:i:s",strtotime($r['Login']['register_date']))?></td>
			<td><a href="<?=$this->Html->url('/admin/login/edit/'.$r['Login']['id'])?>" class="btnEdit">Edit</a></td>
		</tr>
		<?php endforeach;?>
	</table>
	<div class="paging">
		<?php if(isset($rs)):?>
		<?php echo $this->Paginator->numbers();?>
		<?php endif;?>
	</div>
</div>