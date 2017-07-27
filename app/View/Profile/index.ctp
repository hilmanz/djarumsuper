<div id="container">
    <div id="content" class="meetingpostPage">
    	
    	<div class="title">
    		<div class="titleBox title">
			<h1>Profile Kamu</h1>
			<?php if(isset($first_time) && $first_time == true):?>
			<h4>
				Silahkan lengkapi terlebih dahulu profil kamu dibawah ini !
			</h4>
			<?php endif;?>
			</div>
			<div class="content">
				<form action="<?=$this->Html->url('/profile')?>" 
						method="post" 
						enctype="application/x-www-form-urlencoded">
					<?php echo $this->Session->flash();?>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableForum">
						<tr>
							<td><div class="pad10">Nama</div></td>
							<td>
								<div class="pad10">
									<input type="text" name="name" value="<?=h($user['name'])?>"/>
								</div>
							</td>
						</tr>
						<tr>
							<td><div class="pad10">Email</div></td>
							<td>
								<div class="pad10">
									<input type="text" name="email" value="<?=h($user['email'])?>"/>
								</div>
							</td>
						</tr>
						<tr>
							<td><div class="pad10">No. Telp / Hp</div></td>
							<td>
								<div class="pad10">
									<input type="text" name="no_hp" value="<?=h($user['no_hp'])?>"/>
								</div>
							</td>
						</tr>
						<tr>
							<td><div class="pad10">Propinsi</div></td>
							<td>
								<div class="pad10">
									<select name="province_id">
										<?php foreach($provinces as $province):?>
										<option value="<?=h($province['Provinces']['id'])?>">
											<?=h($province['Provinces']['name'])?>
										</option>
										<?php endforeach;?>
									</select>
									<script>
									$('select[name=province_id]').val(<?=$user['province_id']?>);
									</script>
								</div>
							</td>
						</tr>
						<tr>
							<td><div class="pad10">Kota</div></td>
							<td>
								<div class="pad10">
									<input type="text" name="city" value="<?=h($user['city'])?>"/>
								</div>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<div class="pad10">
									<input type="submit" name="btn" value="UPDATE"/>
								</div>
							</td>
						</tr>

					</table>
				</form>
			</div>
    	</div>

    </div>
</div>