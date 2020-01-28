<?php
session_start();
require 'config.php';

require 'classes/Messages.php';
require 'classes/Bootstrap.php';
require 'classes/Controller.php';
require 'classes/Model.php';

require 'controller/home.php';
require 'controller/mydrives.php';
require 'controller/users.php';

require 'models/home.php';
require 'models/mydrive.php';
require 'models/user.php';

$bootstrap = new Bootstrap($_GET);
$controller = $bootstrap->createController();

if($controller)
{
	$controller->executeAction();
}

?>