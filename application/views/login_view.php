<div>
	<h1>Log In</h1>
	<?php echo validation_errors(); ?>
	<?php echo form_open('verifylogin'); ?>
		<label style="display:inline-block;width:100px" for="username">Username:</label><input type="text" size="20" id="username" name="username"/><br/>
		<label style="display:inline-block;width:100px" for="password">Password:</label><input type="password" size="20" id="passowrd" name="password"/><br/>
		<input type="submit" value="Login"/>
	</form>
</div>