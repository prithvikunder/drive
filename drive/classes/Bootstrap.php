<?php
class Bootstrap 
{
	private $controller;
	private $action;
	private $request;

	public function __construct($request)
	{
		$this->request = $request;

		if ($this->request['controller'] == "") {
			$this->controller = "home";
		}
		else {
			$this->controller = $this->request['controller'];
		}

		if ($this->request['action'] == "") {
			$this->action = "index";
		}
		else {
			$this->action = $this->request['action'];
		}
	}

	public function createController()
	{
		//Check whether class exists
		if (class_exists($this->controller)) {
			$parents = class_parents($this->controller);
			
			//check whether class is extended
			if (in_array("Controller", $parents)) {

				//check whether method exists in that class
				if (method_exists($this->controller, $this->action)) {
					return new $this->controller($this->request,$this->action);
				}
				else {
					echo "<h3>Method does not exists</h3>";
					return;
				}
			}
			else {
				echo "<h3>Base Controller does not exists</h3>";
				return;
			}
		}
		else {
			echo "<h3>Class Controller does not exists</h3>";
			return;
		}
	}
}
?>