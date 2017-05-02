
<?php 


 session_start();

 include 'includes/db.php';

 include 'includes/function.php';



	$errors = [];
 if(array_key_exists('register', $_POST)){
 		#Cache errors
	 
	 


	 if(empty($_POST['email'])){

	 			$errors['email'] = "please enter email";

	 	}


	 	 	if(empty($_POST['password'])){

	 			$errors['password'] = "please enter password";


	 		}
	 		if(empty($errors)){


	 		//acess database
	 		$clean = array_map('trim', $_POST);


	 		#register admin

	 		$check = Tools::doAdminLogin($conn, $clean);

	 			$_SESSION['user_id'] = $check[1];
        		$_SESSION['username'] = $check[2];
         		header("Location: dashboard.php"); 

	 			//Tools::redirect('dashboard.php');
	 		}


	 	}

	 





 ?>


<!DOCTYPE html>
<html>
<head>
	<title><?php echo $page_title; ?></title>
	<link rel="stylesheet" type="text/css" href="styles/styles.css">
	<script src="ckeditor/ckeditor.js"></script>
</head>
<body>
	<section>
		<div class="mast">
			<h1>B<span>LOG</span> 

</div>
	</section>



<div class="wrapper">

<?php if(isset($_GET['message'])){ echo  $_GET['message'] ;}?>
	<h1 id="register-label">Admin Login</h1>
	<hr>
	<form id="register" action ="" method ="POST">
	<div>
	<label>email:</label>
	<input type="text" name="email" placeholder="email">
	</div>
	<div>
	<label>password:</label>
	<input type="password" name="password" placeholder="password">
	</div>
	
	<input type="submit" name="register" value="login">
	</form>
	
	<h4 class="jumpto">Don't have an account? <a href="register.php">register</a></h4>
	</div>


		<?php include 'includes/footer.php' ?>