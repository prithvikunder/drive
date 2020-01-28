<?php 
class Users extends Controller
{
	public function register()
	{
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->register(),true);
	}

	public function login()
	{
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->login(),true);
	}

	public function resetPassword()
	{
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->resetPassword(),true);
	}

	public function logout()
	{
		if(isset($_SESSION["is_logged_in"]))
		{
			unset($_SESSION["is_logged_in"]);
			unset($_SESION["user_data"]);
			unlink($_SESSION);
		}
			
		header("Location:".ROOT_URL);
	}
}
?>