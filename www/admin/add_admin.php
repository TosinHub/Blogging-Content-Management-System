
<?php 


 include 'includes/db.php';

 include 'includes/function.php';


$page_title = "Add Admin";

 include 'includes/header.php';




 			$errors = [];
 if(array_key_exists('register', $_POST)){


 	

     if(empty($_POST['username'])){

        $errors['username'] = "please enter username";

    }
     if(empty($_POST['email'])){

        $errors['email'] = "please enter email";

    }


    if(empty($_POST['password'])){

        $errors['password'] = "please enter password";

    }


    if($_POST['password'] != $_POST['pword']){

        $errors['pword'] = "password do not match";

    }
 		
	 		if(empty($errors)){


	 		//acess database
	 		$clean = array_map('trim', $_POST);

	 		//echo $clean['username'];
	 		//echo $clean['password'];


	 		#register admin

	 		$check = Tools::doAdminRegister($conn, $clean);

	 		if($check){

	 			Tools::redirect('login.php');
	 		}
	 		 else{


	 			 Tools::redirect('add_admin.php?message=Invalid Username and/or Password');
			
	 		}


	 	}


	 	

	 }






 ?>

<div class="wrapper">

<?php if(isset($_GET['message'])){ echo  $_GET['message'] ;}?>
	<h1 id="register-label">Admin Login</h1>
	<hr>
	<form id="register" action ="add_admin.php" method ="POST">

	<?php Tools::displayError($errors,"username") ?>
	<div>
	
	<label>Username:</label><br/>
	<input type='text' name='username' value='<?php if(isset($error)){ echo $_POST['username'];}?>'>
	</div>

	<?php Tools::displayError($errors,"email") ?>
	<div>
	<label>Email</label><br />
	<input type='text' name='email' value='<?php if(isset($error)){ echo $_POST['email'];}?>'></div>

	<?php Tools::displayError($errors,"password") ?>
	<div>
	
	<label>password:</label><br/>
	<input type='password' name='password' value='<?php if(isset($error)){ echo $_POST['password'];}?>'>
	</div>
	

	<?php Tools::displayError($errors,"pword") ?>
	<div>
	
	<label>Confirm Password</label><br />
	<input type='password' name='pword' value='<?php if(isset($error)){ echo $_POST['passwordConfirm'];}?>'></div>
	
	<input type="submit" name="register" value="login">
	</form>
	
	</div>


		<?php include 'includes/footer.php' ?>


