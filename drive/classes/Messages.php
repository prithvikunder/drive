<?php
class Message 
{
	public static function setMsg($text,$type)
	{
		if ($type == "error") 
		{
			$_SESSION["errorMsg"] = $text;
		}
		else 
		{
			$_SESSION["successMsg"] = $text;
		}
	}

	public static function format($size)
	{
		if($size > 1073741824)
			return number_format($size/1073741824,2)." GB";
		else if($size > 1048576)
			return number_format($size/1048576,2)." MB";
		else if($size > 1024)
			return number_format($size/1024,2)." KB";
		else
			return "0 B";
	}

	public static function folderSize($dir)
	{
		$count_size = 0;
		$dir_arr = scandir($dir);
		foreach ($dir_arr as $key => $filename) {
			if($filename != ".." && $filename != ".") {
				if(is_dir($dir."/".$filename)) {
					$count_size += Message::folderSize($dir."/".$filename);
				}
				else {
					$count_size += filesize($dir."/".$filename);
				}
			}
		}

		return $count_size;
	}

	public static function display()
	{
		if (isset($_SESSION["errorMsg"])) {
			echo "<div class='alert alert-danger'>".$_SESSION["errorMsg"]."</div>";
			unset($_SESSION["errorMsg"]);
		}

		if (isset($_SESSION["successMsg"])) {
			echo "<div class='alert alert-success'>".$_SESSION["successMsg"]."</div>";
			unset($_SESSION["successMsg"]);
		}
	}

	public function idEncode($param)
	{
		$param = base64_encode($param);
		$param = str_replace("+", "", $param);
		$param = str_replace("=", "", $param);
		$param = str_replace("/", "", $param);
		return $param;
	}

	public static function idDecode($param)
	{
		$param = base64_decode($param);
		return $param;
	}
}
?>