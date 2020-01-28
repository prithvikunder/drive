<?php 
		if(isset($_SESSION["is_logged_in"])) 
		{
			header("Location: ".ROOT_URL);
		}
?>

<div class="panel panel-default">
	
	<div class="panel-heading">
		<h3 class="panel-title">Login</h3>
	</div>

	<div class="panel-body">
		<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
		
			<div class="form-group">
				<label>Email</label>
				<input type="text" name="email" class="form-control" />
			</div>

			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password" class="form-control" />
			</div>

			<input type="submit" name="submit" value="Login" class="btn btn-primary">
			<a class="btn btn-link" href="<?php echo ROOT_URL."users/resetPassword";?>">Forgot Passoword</a>
		</form>
	</div>

</div>