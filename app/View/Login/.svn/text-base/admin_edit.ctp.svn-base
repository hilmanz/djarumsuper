<div class="content">
	<h3>Member</h3>
	<form action="<?=$this->Html->url('/admin/login/edit/'.$rs['Login']['id'])?>"
		  method="post" enctype="application/x-www-form-urlencoded">
		<table width="100%" class="tablestyle">
			<tr>
				<td colspan="2">Modify Details</td>
			</tr>
			<tr>
				<td>Name</td>
				<td><?=h($rs['Login']['name'])?></td>
			</tr>
			<tr>
				<td>Facebook ID</td>
				<td><?=h($rs['Login']['fb_id'])?></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><?=h($rs['Login']['email'])?></td>
			</tr>
			<tr>
				<td>Role</td>
				<td>
					<select name="role">
						<option value="0" <?php if($rs['Login']['role']==0):echo 'selected="selected"';endif;?>>Member</option>
						<option value="1" <?php if($rs['Login']['role']==1):echo 'selected="selected"';endif;?>>Contributor</option>
						<option value="2" <?php if($rs['Login']['role']==2):echo 'selected="selected"';endif;?>>Administrator</option>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" name='btnSave' value="Save"/>
				</td>
			</tr>
		</table>
	</form>
</div>