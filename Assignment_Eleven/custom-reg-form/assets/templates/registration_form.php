<?php ob_start(); ?>
<div class="main-w3layouts wrapper">
	<h1><?php echo __( 'Creative SignUp Form', 'crf' ); ?></h1>
	<div class="main-agileinfo">
		<div class="agileits-top">
			<form action="admin" method="post">
				<input class="text" type="text" name="name" placeholder="<?php echo __( 'Name', 'crf' ); ?>" required=""><br>
				<input class="text" type="text" name="username" placeholder="<?php echo __( 'Username', 'crf' ); ?>" required="">
				<input class="text email" type="email" name="email" placeholder="<?php echo __( 'Email', 'crf' ); ?>" required="">
				<input class="text" type="password" name="password" placeholder="<?php echo __( 'Password', 'crf' ); ?>" required="">
				<input class="text w3lpass" type="password" name="password" placeholder="<?php echo __( 'Confirm Password', 'crf' ); ?>" required="">

				<label for="role" class="changecolor"><?php echo __( 'Select Role:', 'crf' ); ?></label><br><br>
				<select name="role" id="roles">
					<option value="customer"><?php echo __( 'Customer', 'crf' ); ?></option>
					<option value="maintainer"><?php echo __( 'Maintainer', 'crf' ); ?></option>
					<option value="collaborator"><?php echo __( 'Collaborator', 'crf' ); ?></option>
				</select><br><br>
				<input type="submit" value="SIGNUP">
			</form>
		</div>
	</div>
	<ul class="colorlib-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>	
<?php return ob_get_clean(); ?>
