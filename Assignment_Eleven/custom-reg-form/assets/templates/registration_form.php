<?php ob_start(); ?>
<div class="main-w3layouts wrapper">
	<h1>Creative SignUp Form</h1>
	<div class="main-agileinfo">
		<div class="agileits-top">
			<form action="admin" method="post">
				<input class="text" type="text" name="name" placeholder="Name" required=""><br>
				<input class="text" type="text" name="username" placeholder="Username" required="">
				<input class="text email" type="email" name="email" placeholder="Email" required="">
				<input class="text" type="password" name="password" placeholder="Password" required="">
				<input class="text w3lpass" type="password" name="password" placeholder="Confirm Password" required="">

				<label for="role" class="changecolor">Select Role:</label><br><br>
				<select name="role" id="roles">
					<option value="Customer">Customer</option>
					<option value="Maintainer">Maintainer</option>
					<option value="Collaborator">Collaborator</option>
				</select><br><br>
				<input type="submit" value="SIGNUP">
			</form>
			<p>Don't have an Account? <a href="#"> Login Now!</a></p>
		</div>
	</div>
	<!-- copyright -->
	<div class="colorlibcopy-agile">
		<p>© 2021 weDevs Signup Form. All rights reserved | Design by <a href="#" target="_blank">Shakhawat</a></p>
	</div>
	<!-- //copyright -->
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
