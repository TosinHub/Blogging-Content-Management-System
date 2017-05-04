<?php



#connect to databse
session_start();
 include 'includes/db.php';

 include 'includes/function.php';


 	if(isset($_GET['delete'])){
							
								Tools::deletePost($conn,$_GET['delete']);
							}

	if(isset($_GET['archive'])){
							
								Tools::achieveNow($conn,$_GET['postID'],$_GET['archive']);
							}



	 $page_title = "Dashboard";

	 include 'includes/header.php';
?>


	<div class="wrapper">
		<div id="stream">
		<h1>Admin Dashboard</h1></br>
			<strong>
					
			

	<div class="wrapper">
		<div id="stream"><br/><br/>

<p>



<?php 

			
				if(isset($_GET['success']))
						{

							echo $_GET['success'];
						}

?>


<hr>

		<h3>Available Posts</h3>
		
			<table id="tab">
				<thead>
					<tr>
						<th>Title</th>
						<th>Posted by</th>
						<th>Category</th>
						<th>Date Posted</th>
						<th>Featured Image</th>
						<th>edit</th>
						<th>delete</th>
						<th>Archive</th>
					</tr>
				</thead>
				<tbody>
					

						<?php 
        $query = "SELECT * FROM blog_posts ORDER BY postID DESC";       
		$posts_per_page=5;
		$newquery = $paginate->paging($query,$posts_per_page);
		$paginate->dataview($newquery);
				
		?>
						
						
          		</tbody>
			</table>

				<div class="paginated">
		<?php 	$paginate->paginglink($query,$posts_per_page); ?>
		</div>
	</div>

	<section class="foot">
		<div>
			<p>&copy; 2016;
		</div>
	</section>
</body>
</html>
