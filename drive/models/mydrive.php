<?php
class MyDriveModel extends Model
{
	protected $dir_str;

	public function __construct()
	{
		$this->dir_str = ROOT_PWD."/".$_SESSION["user_data"]["email"]."/";
	}

	public function index($param)
	{
		$this->dir_str .= (base64_decode($param));
		$content = array_diff(scandir($this->dir_str), array(".",".."));
		$folders = array();
		$files = array();

		foreach ($content as $file) {
			$ext = pathinfo($file,PATHINFO_EXTENSION);
			
			if($ext == "") {
				$folders[] = $file;
			}
			else {
				$files[] = $file;
			}
		}

		$content = array(
							"folders" => $folders, 
							"files"	=>	$files
						);

		return $content;
	}

	public function upload($param)
	{
		$post = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

		if(isset($post["submit"])) {
			$file = $_FILES["fileUpload"];
			
			if ($post['dirname'] == "/") {
				$post['dirname'] = "";
			}

			if ($file['name'] == "") {
				Message::setMsg("Please Fill all the details","error");
				return;
			}

			if ($file["error"]) {
				Message::setMsg($file["error"],"error");
				return;
			}

			$targetPath = $this->dir_str.$post['dirname'].$file['name'];
			$sourcePath = $file["tmp_name"];

			move_uploaded_file($sourcePath, $targetPath);
			header("Location: ".ROOT_URL."mydrive/index/".$param);
			return;
		}		
	}

	public function create($param)
	{
		$post = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

		if(isset($post["submit"])) {

			if ($post['pdir'] == "/") {
				$post['pdir'] = "";
			}

			$newdir = $this->dir_str.$post['pdir'].$post['dirname'];
			mkdir($newdir);
			header("Location: ".ROOT_URL."mydrive/index/".$param);
			return;
		}
		return;
	}

	public function download()
	{
		$url = $_SERVER['REQUEST_URI'];
		$dir = Message::idDecode(basename($url));
		if($dir[0] == "/") {
			$dir = substr($dir,1);
		}

		$dir_str = explode("/",$dir);
		$file = $dir_str[count($dir_str) - 1];

		$downloadPath = "C:\Users\aspire\Downloads\\".$file;
		$filepath = $this->dir_str.$dir;

		file_put_contents($downloadPath,file_get_contents($filepath));
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}

	public function delete()
	{
		$url = $_SERVER['REQUEST_URI'];
		$dir = Message::idDecode(basename($url));
		if($dir[0] == "/") {
			$dir = substr($dir,1);
		}

		$filepath = $this->dir_str.$dir;
		unlink($filepath);
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}

	public function open() {
		$url = $_SERVER['REQUEST_URI'];
		$dir = Message::idDecode(basename($url));
		if($dir[0] == "/") {
			$dir = substr($dir,1);
		}

		$filepath = $this->dir_str.$dir;
		$ext = pathinfo($filepath,PATHINFO_EXTENSION);
		if($ext === "jpg" || $ext === "jpeg" || $ext === "png") {
			return "<img src=".$filepath." />";
		}
		else{
			$fp = fopen($filepath, "r");
			$content = fread($fp, filesize($filepath));
			fclose($fp);
			return basename($filepath)."\n".$content;
		}
	}
}
?>