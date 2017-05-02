<?php
		session_start();
		 include 'includes/db.php';

 include 'includes/function.php';
		

		#connect to databse


		$page_title = "Categories";

	
		 include 'includes/header.php';



	if(array_key_exists('add', $_POST)){
		$clean = array_map('trim', $_POST);
	  	Tools::addCategory($conn,$clean);
	  	Tools::redirect("category.php");


	 	 }


	 if(array_key_exists('edit', $_POST)){
		$clean = array_map('trim', $_POST);
	  	Tools::editCategory($conn,$clean);


		}
	
?>



	<div class="wrapper">
		<div id="stream"><br/><br/>

<p>



<?php 

	if(isset($_GET['success']))
				{

					echo $_GET['success'];
				}


	if(isset($_GET['action']))
			{

	if($_GET['action']= "edit")
				{

?>

<h3>Edit Category</h3>
	<form  id="register" method="post" action="category.php">
			<input type="text" name="cat_name" placeholder="Category Name" value="<?php echo $_GET['cat_name']; ?>" />
			<input type="hidden" name="cat_id" value="<?php echo $_GET['cat_id']; ?>">
			<input type="submit" name="edit">

	</form>

<?php
				}

			}	


	if(isset($_GET['act'])){


	if ($_GET['act']= "delete") {
				Tools::deleteCat($conn,$_GET['cat_id']);
					Tools::redirect("category.php");
			}

		}



?>


<h3>Add Category</h3>


		<form  id="register" method="post" action="category.php">
			<input type="text" name="cat_name" placeholder="Category Name" />
			<input type="submit" name="add" value="Add">

		</form>


		</p><br/><br/>

<hr>

		<h3>Available categories</h3>
			<table id="tab">
				<thead>
					<tr>
						<th>Category Id</th>
						<th>Category Name</th>
						<th>edit</th>
						<th>delete</th>
					</tr>
				</thead>
				<tbody>

				<?php  

    $table = function($info){while($row = $info->fetch(PDO::FETCH_BOTH)){
	 			$cat_id = $row['cat_id'];
	 			$cat_name = $row['cat_name'];	 			
	 			 echo  "<tr>";
	 			 echo  "<td>" .$cat_id.  "</td>";
	 			 echo  "<td>" .$cat_name.  "</td>";
				 echo     "<td><a href='category.php?action=edit&cat_id=$cat_id&cat_name=$cat_name'>edit</a></td>";
				 echo	 "<td><a href='category.php?act=delete&cat_id=$cat_id'>delete</a></td> ";
	 			 echo "</tr>";}};



				Tools::fetchCat($conn,$table); ?>						
						
          		</tbody>
			</table>
		</div>
		
		<div class="paginated">
			<a href="#">1</a>
			<a href="#">2</a>
			<span>3</span>
			<a href="#">2</a>
		</div>
	</div>

	<section class="foot">
		<div>
			<p>&copy; 2016;
		</div>
	</section>
</body>
</html>
