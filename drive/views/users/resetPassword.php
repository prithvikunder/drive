<?php 
		if(isset($_SESSION["is_logged_in"])) 
		{
			header("Location: ".ROOT_URL);
		}
?>

<div class="panel panel-default">
	
	<div class="panel-heading">
		<h3 class="panel-title">Reset Password</h3>
	</div>

	<div class="panel-body">
		<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">

			<div class="form-group">
				<label>Email</label>
				<input type="text" name="email" class="form-control" />
			</div>

			<div class="form-group">
				<label>New Password</label>
				<input type="password" name="np" class="form-control" />
			</div>

			<div class="form-group">
				<label>Confirm Password</label>
				<input type="password" name="cp" class="form-control" />
			</div>

			<input type="submit" name="submit" value="Reset" class="btn btn-primary">
		</form>
	</div>

</div>