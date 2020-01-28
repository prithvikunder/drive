	<?php 
		if(!isset($_SESSION["is_logged_in"])) 
		{
			header("Location: ".ROOT_URL."users/login");
		}

		if($this->id != "")
		{
			$str_arr = explode("/",base64_decode($this->id));
			$cd = $str_arr[count($str_arr) - 1];

			$_SESSION['directory'][$cd] = basename($_SERVER['REQUEST_URI']);
			echo "<ul class='breadcrumb'>
					<li><a href=".$_SESSION['directory']['MyDrive'].">MyDrive</a></li>";

			foreach ($str_arr as $str) {
				$link = $_SESSION["directory"][$str];
				echo "<li><a style='margin:5px;'href=".$link.">".$str."</a></li>";
			}

			echo "</ul>";
		}
	?>

	<!--Lines 26-31 In case no files/folders not uploaded/created -->
	<?php if(empty($viewmodel["folders"]) && empty($viewmodel["files"])) : ?>
		<div class="text-center">
			<p>Seems like you haven't uploaded a file yet</p>
		</div>
	<?php endif; ?>



	<!--Lines 33-38 Buttons to create folder/upload file-->
	<div class="text-center">
		<a style="margin-top:20px;margin-right:10px;" class="btn btn-success btn-share" href="<?php echo ROOT_URL; ?>mydrive/upload/<?php echo $this->id; ?>">Upload a file</a>
		<a style="" class="btn btn-primary" href="<?php echo ROOT_URL; ?>mydrive/create/<?php echo $this->id; ?>">Create a folder</a>
	</div>


	<!--Lines 43-65 View Folders-->
	<?php if( !empty($viewmodel["folders"]) ):  ?>
		<h4>Folders</h4>
		<hr>
			<?php foreach ($viewmodel["folders"] as $row) : ?> 
				
				<?php if($this->id == "") : ?>
					<a class="btn btn-default" href="<?php echo ROOT_URL; ?>mydrive/index/<?php echo Message::idEncode($row);?>">
						<img src="<?php echo ROOT_URL; ?>/assets/folder.png" width=25px height=25px/>
						<?php echo $row; ?>
					</a>
				<?php else : ?>	
					<a class="btn btn-default" href="<?php echo ROOT_URL; ?>mydrive/index/<?php echo Message::idEncode(Message::idDecode(basename($_SERVER['REQUEST_URI']))."/".$row);?>">
						<img src="<?php echo ROOT_URL; ?>/assets/folder.png" width=25px height=25px/>
						<?php echo $row; ?>
					</a>
				<?php endif; ?>	


			<?php endforeach; ?>
		<hr>
	<?php endif; ?>


	<!--Lines 33-38 Buttons to create folder/upload file-->
	<?php if( !empty($viewmodel["files"]) ):  ?>	
		<h4>Files</h4>
		<hr>
			<?php foreach ($viewmodel["files"] as $row) : ?> 
				<p>
					<a href="<?php echo ROOT_URL; ?>mydrive/open/<?php echo Message::idEncode(Message::idDecode($this->id)."/".$row); ?>" target="_blank"><?php echo $row; ?></a>
					<a style="float: right;margin-right: 10px;"class="btn btn-danger" href="<?php echo ROOT_URL; ?>mydrive/delete/<?php echo Message::idEncode(Message::idDecode($this->id)."/".$row); ?>"/>Delete</a>
					<a style="float: right;margin-right: 10px;" class="btn btn-primary" href="<?php echo ROOT_URL; ?>mydrive/download/<?php echo Message::idEncode(Message::idDecode($this->id)."/".$row); ?>">Download</a>
				</p>				
				<hr>
			<?php endforeach; ?>
	<?php endif; ?>

	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
		    $(".btn-danger").on("click", function(e){
		        var url = $(this).attr('href');
		        e.preventDefault();

		        $.ajax({
		        	'url': url,
					'success' : function(url) {
						document.write(url);
					}
		        });
		    });
		});
	</script>