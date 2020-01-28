<!DOCTYPE html>
<html>
<head>
	<title>GigaCloud</title>
	<link rel="stylesheet" type="text/css" href="<?php echo ROOT_URL; ?>assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo ROOT_URL; ?>assets/css/style.css">
</head>
<body>
	<nav class="navbar navbar-default">
		
		<div class="container">
			
			<div class="navbar-header">
				<a class="navbar-brand">GigaCloud</a>
			</div>

			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="<?php echo ROOT_URL; ?>">Home</a></li>
					<li><a href="<?php echo ROOT_URL; ?>mydrive/index/">My Drive</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<?php if (isset($_SESSION["is_logged_in"])) : ?>
						<li><a href="">Storage: <?php echo Message::format(Message::folderSize(ROOT_PWD."/".$_SESSION["user_data"]["email"]));?></a></li>
						<li><a href="<?php echo ROOT_URL; ?>">Welcome <?php echo $_SESSION["user_data"]["name"]?></a></li>
						<li><a href="<?php echo ROOT_URL; ?>users/logout">Logout</a></li>
					<?php else : ?>
						<li><a href="<?php echo ROOT_URL; ?>users/login">Login</a></li>
						<li><a href="<?php echo ROOT_URL; ?>users/register">Register</a></li>
					<?php endif; ?>
				</ul>
			</div>

		</div>
	</nav>

	<div class="container">
		<div class="row">
			<?php Message::display(); ?>
			<?php require($view) ?>;
		</div>
	</div>

</body>
</html>
