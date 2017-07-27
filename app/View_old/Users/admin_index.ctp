<h3>Please Login</h3>

	<?php echo $this->Form->create('User', array("action"=>"authenticate","admin"=>true,"type"=>"post")); ?>
	<div>
		<label>Username</label><br/>
		<input type="text" name="username" value="" onclick="$(this).val('');return false;">
	</div>
	<div>
		<label>Password</label><br/>
		<input type="password" name="password" value="" onclick="$(this).val('');return false;">
	</div>
	<div>
		<input type="submit" name="btnlogin" value="Login"/>
	</div>
</form>