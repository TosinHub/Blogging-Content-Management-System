<?php

class paginate
{
	private $db;
	
	function __construct($conn)
	{
		$this->db = $conn;
	}

	public function getAdmin($id){
				 $stmt = $this->db->prepare("SELECT * FROM blog_member WHERE memberID = :id ");
				 $stmt->bindParam(":id", $id);
				 $stmt->execute();
				

	 			$row = $stmt->fetch(PDO::FETCH_ASSOC);
	 			return $row;


	 		}

	 public function getCat($id){
				 $stmt = $this->db->prepare("SELECT * FROM category WHERE cat_id = :id ");
				 $stmt->bindParam(":id", $id);
				 $stmt->execute();
				

	 			$row = $stmt->fetch(PDO::FETCH_ASSOC);
	 			return $row;


	 		}		
	
	public function dataview($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{

//cat_id,postTitle,postCont,postDate,admin_id,image_path


				$post_id = $row['postID'];
	 			$title = $row['postTitle'];
	 			$admin_id = $row['admin_id'];
	 			$cat_id = $row['cat_id'];
	 			$date = $row['postDate'];
	 			$image_path = $row['image_path'];

	 			$get = $this->getAdmin($admin_id);
	 			$admin = $get['username'];

	 			$get = $this->getCat($cat_id);
	 			$cat = $get['cat_name'];
				?>


				


                 <tr><td><?php echo $title ?></td>
	 			 <td><?php echo $admin ?> </td>
	 			 <td><?php echo $cat ?></td>
	 			 <td><?php echo $date ?></td>
	 			 <td><img src='<?php echo $image_path?>'  height='100px' width='100px' /></td>
	 			 <td><a href='edit_post.php?post_id=<?php echo $post_id ?>'>edit</a></td>
				 <td><a href='dashboard.php?delete=<?php echo $post_id ?>'>delete</a></td></tr>




                <?php
			}





		}
		else
		{
			?>
            <tr>
            <td>No product posted yet</td>
            </tr>
            <?php
		}
		
	}


	public function homeView($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{

//cat_id,postTitle,postCont,postDate,admin_id,image_path


				$post_id = $row['postID'];
	 			$title = $row['postTitle'];
	 			$admin_id = $row['admin_id'];
	 			$cat_id = $row['cat_id'];
	 			$post = $row['postCont'];
	 			$date = $row['postDate'];
	 			$image_path = $row['image_path'];

	 			$get = $this->getAdmin($admin_id);
	 			$admin = $get['username'];

	 			$get = $this->getCat($cat_id);
	 			$cat = $get['cat_name'];
				?>


				

				 <div class="blog-post">
            <h2 class="blog-post-title"><?php echo $title ?></h2>
            <p class="blog-post-meta"><?php echo 'Posted on '.date('jS M Y H:i:s', strtotime($date)).''?>
             By <a href="#"><?php echo $admin."<br/>" ?></a> Category:<?php echo $cat ?> </p>
            <?php  ?>
             <?php echo  "<img src='admin/". $image_path."' height='200px' width='200px'/>"; echo substr($post, 0, 200) . '<strong><a href="viewpost.php?id='.$row['postID'].'">Read More</a></strong>';	 ?>
           
          </div>


                <?php
			}





		}
		else
		{
			?>
            <tr>
            <td>No product posted yet</td>
            </tr>
            <?php
		}
		
	}





	public function postView($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
			

//cat_id,postTitle,postCont,postDate,admin_id,image_path


				$post_id = $row['postID'];
	 			$title = $row['postTitle'];
	 			$admin_id = $row['admin_id'];
	 			$cat_id = $row['cat_id'];
	 			$post = $row['postCont'];
	 			$date = $row['postDate'];
	 			$image_path = $row['image_path'];

	 			$get = $this->getAdmin($admin_id);
	 			$admin = $get['username'];

	 			$get = $this->getCat($cat_id);
	 			$cat = $get['cat_name'];
				?>


				

				 <div class="blog-post">
            <h2 class="blog-post-title"><?php echo $title ?></h2>
            <p class="blog-post-meta"><?php echo 'Posted on '.date('jS M Y H:i:s', strtotime($date)).''?>
             By <a href="#"><?php echo $admin."<br/>" ?></a> Category:<?php echo $cat ?> </p>
             <?php 
             echo "<img src='admin/". $image_path."' />";

             echo $post ;	 ?>
           
          </div>


                <?php
			





		}
		else
		{
			?>
            <tr>
            <td>No product posted yet</td>
            </tr>
            <?php
		}
		
	}

	
	public function paging($query,$products_per_page)
	{
		$starting_position=0;
		if(isset($_GET["page_no"]))
		{
			$starting_position=($_GET["page_no"]-1)*$products_per_page;
		}
		$query2=$query." limit $starting_position,$products_per_page";
		return $query2;
	}
	
	public function paginglink($query,$products_per_page)
	{
		
		$self = $_SERVER['PHP_SELF'];
		
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		
		$total_no_of_products = $stmt->rowCount();
		
		if($total_no_of_products > 0)

		{
			
			$total_no_of_pages=ceil($total_no_of_products/$products_per_page);
			$current_page=1;
			if(isset($_GET["page_no"]))
			{
				$current_page=$_GET["page_no"];
			}
			if($current_page!=1)
			{
				$previous =$current_page-1;
				echo "<a href='".$self."?page_no=1'>First</a>&nbsp;&nbsp;";
				echo "<a href='".$self."?page_no=".$previous."'>Previous</a>&nbsp;&nbsp;";
			}
			for($i=1;$i<=$total_no_of_pages;$i++)
			{
				if($i==$current_page)
				{
					echo "<strong><a href='".$self."?page_no=".$i."' style='color:red;text-decoration:none'>".$i."</a></strong>&nbsp;&nbsp;";
				}
				else
				{
					echo "<a href='".$self."?page_no=".$i."'>".$i."</a>&nbsp;&nbsp;";
				}
			}
			if($current_page!=$total_no_of_pages)
			{
				$next=$current_page+1;
				echo "<a href='".$self."?page_no=".$next."'>Next</a>&nbsp;&nbsp;";
				echo "<a href='".$self."?page_no=".$total_no_of_pages."'>Last</a>&nbsp;&nbsp;";
			}

		}
	}
}