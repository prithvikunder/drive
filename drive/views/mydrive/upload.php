<?php 
	if(!isset($_SESSION["is_logged_in"])) {
		header("Location: ".ROOT_URL."shares");
	}
?> 


<div class="panel panel-default">
	
	<div class="panel-heading">
		<h3 class="panel-title">Upload a file</h3>
	</div>

	<div class="panel-body">
		<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
			
			<div class="form-group">
				<label>Directory Name</label>
				<input type="text" name="dirname" value="<?php echo Message::idDecode($this->id);?>/"class="form-control" readonly/>
			</div>

			<div class="form-group">
				<input type="file" name="fileUpload" />
			</div>

			<input type="submit" name="submit" value="Submit" class="btn btn-primary">
			<a href="<?php echo ROOT_URL; ?>mydrive" class="btn btn-danger">Cancel</a>
		</form>
	</div>

</div>