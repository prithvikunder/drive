<?php
class Home extends Controller
{
	public function index()
	{
		$viewmodel = new HomeModel();
		$this->returnView($viewmodel->index(),true);
	}
}
?>