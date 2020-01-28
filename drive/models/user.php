<?php
class UserModel extends Model
{
	public function register()
	{
		$post = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

		if (isset($post['submit'])) {

			if ($post['name'] == "" || $post['email'] == "" || $post['password'] == "") {
				Message::setMsg("Please Fill all the details","error");
				return;
			}

			$password = md5($post['password']);
			$this->query('INSERT INTO users(name,email,password) VALUES(:name,:email,:password)');
			
			$this->bind(':name',$post['name']);
			$this->bind(':email',$post['email']);
			$this->bind(':password',$password);

			$this->execute();
			mkdir(ROOT_PWD."/".$post['email']);
			header('Location: '.ROOT_URL.'users/login');
			return;
		}
	}

	public function login()
	{
		$post = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

		if (isset($post['submit'])) {

			if ($post['email'] == "" || $post['password'] == "") {
				Message::setMsg("Please Fill all the details","error");
				return;
			}

			$password = md5($post['password']);
			$this->query('SELECT * FROM users WHERE email=:email AND password=:password');
			
			$this->bind(':email',$post['email']);
			$this->bind(':password',$password);

			$row = $this->fetch();
			if($row) {
				$_SESSION["is_logged_in"] = true;
				$_SESSION["user_data"] = array(
												'id' => $row['id']	, 
												'name' => $row['name']	,
												'email' => $row['email']	
											);
				$_SESSION["directory"] = array(
												"MyDrive" => "http://localhost/drive/mydrive/index/"
											);
				header('Location: '.ROOT_URL);
			}
			else {
				Message::setMsg("Incorrect Login","error");
			}

			return;
		}
	}

	public function resetPassword()
	{
		$post = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

		if (isset($post['submit'])) {

			if ($post['np'] == "" || $post['cp'] == "") {
				Message::setMsg("Please Fill all the details","error");
				return;
			}

			if ($post['np'] != $post['cp'] ) {
				Message::setMsg("Both fields should match","error");
				return;
			}

			$password = md5($post['cp']);
			$this->query('UPDATE users SET password=:password WHERE email=:email');
			$this->bind(':email',$post['email']);
			$this->bind(':password',$password);

			$this->execute();
			mkdir(ROOT_PWD."/".$post['email']);
			header('Location: '.ROOT_URL.'users/login');
			return;
		}
	}
}
?>