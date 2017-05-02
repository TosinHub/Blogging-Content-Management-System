
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


			</h1>
			<nav>
				<ul class="clearfix">
					<li><a href="dashboard.php" <?php  Tools::curNav("dashboard.php")  ?>   >Dashboard</a></li>
					<li><a href="category.php" <?php  Tools::curNav("category.php")  ?>>Category</a></li>
					<li><a href="add_post.php" <?php  Tools::curNav("add_post.php")  ?>>Add Post</a></li>
					<li><a href="add_admin.php" <?php  Tools::curNav("add_admin.php")  ?>>Add Admin</a></li>
					
					<li><a href="logout.php" >Log Out</a></li>
					
					</li>
				</ul>
			</nav>
		



</div>
	</section>
	