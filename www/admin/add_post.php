
<?php 
 session_start();

 include 'includes/db.php';

 include 'includes/function.php';
 //Tools::checkLogin();

 $page_title = "Add Post";

 include 'includes/header.php';


 
		$errors = [];
 if(array_key_exists('add', $_POST)){
 		#Cache errors
	 	
	 	#validate first name

	 	if(empty($_POST['title'])){

	 			$errors['title'] = "please enter title";

	 	}

	 	if(empty($_POST['admin_id'])){

	 			$errors['admin_id'] = "please enter author";

	 	}

	 	if(empty($_POST['cat'])){

	 			$errors['cat'] = "please select";

	 	}


	 	if(empty($_POST['post'])){

	 			$errors['post'] = "please enter Post";

	 	}
	 		//echo $_POST["title"]."<br/>";
	 		//echo $_POST["post"]."<br/>";
	 		//echo $_POST["cat"]."<br/>";
	 
	 	
	define('MAX_FILE_SIZE', "2097152");

    #allowed extentions

    $ext = ["image/jpg","image/jpeg","image/png"];

     if(empty($_FILES['pic']['name']))
                  {
            $errors['pic'] = "Please choose a file";


                  }
	 if($_FILES['pic']['size'] > MAX_FILE_SIZE)
                  {
            $errors['pic'] = "File exceeds maximum sixe. Maximum size:" . MAX_FILE_SIZE;
                  }

                  $check = Tools::UploadFiles($_FILES,'pic','uploads/');

                  if($check[0])
                  {
                  	$destination = $check[1];
                  }

                  else{
                  	$errors['pic'] = "file upload failed";

                  }
  
	 	if(empty($errors)){
	 		



	 		$clean = array_map('trim', $_POST);
	 		 $clean["loc"] = $destination;
			Tools::addPost($conn,$clean);
              }

	 		


	 	

	 		
}


 	

 	?>



<div class="wrapper">

<?php if(isset($_GET['message'])){ echo  $_GET['message'] ;}?>
	<h1 id="register-label">Add Post</h1>
	<hr>
	<form id="register" action ="add_post.php" method ="POST" enctype="multipart/form-data">

	<div>
	
	<input type='hidden' name='admin_id' value="<?php echo $_SESSION["user_id"] ?>">
	</div>

	<?php Tools::displayError($errors,"title") ?>
	<div>
	<label>Title</label><br />
	<input type='text' name='title' value='<?php if(isset($error)){ echo $_POST['title'];}?>'></div>

	<div>
			<?php Tools::displayError($errors,"cat") ?><br>
				<label>Category:</label>
				<select name="cat">

				<option value="">Select</option>

<?php

		$select = function ($info)
	{
			
	 		while($row = $info->fetch(PDO::FETCH_ASSOC)){
	 			$cat_id = $row['cat_id'];
	 			$cat_name = $row['cat_name'];

	 			$result .= "<option value=$cat_id>"  .$cat_name ."</option>";

	 		}
	 		echo $result;
	};

	Tools::fetchCat($conn,$select); ?>




				</select>
			</div>



			<div><label>Post</label><br/>



				<textarea name="post" id="editor1" rows="10" cols="80">
                Add post here
            </textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>



			</div>
	

	<div>
			<?php Tools::displayError($errors,"pic") ?><br>
			<label>Featured Image:</label>
			<input type="file" name="pic"/>
			</div>
	
	<input type="submit" name="add" value="Add Post">
	</form>
	
	</div>


		<?php include 'includes/footer.php' ?>






