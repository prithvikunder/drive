<?php 
class MyDrive extends Controller
{
	public function index()
	{
		$viewmodel = new MyDriveModel();
		$this->returnView($viewmodel->index($this->id),true);
	}

	public function upload()
	{
		$viewmodel = new MyDriveModel();
		$this->returnView($viewmodel->upload($this->id),true);
	}

	public function create()
	{
		$viewmodel = new MyDriveModel();
		$this->returnView($viewmodel->create($this->id),true);
	}

	public function delete()
	{
		$viewmodel = new MyDriveModel();
		$this->returnView($viewmodel->delete(),true);
	}

	public function download()
	{
		$viewmodel = new MyDriveModel();
		$this->returnView($viewmodel->download(),true);
	}

	public function open() {
		$viewmodel = new MyDriveModel();
		$this->returnView($viewmodel->open(),false);
	}
}
?>