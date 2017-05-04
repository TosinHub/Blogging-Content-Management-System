<?php 
 session_start();

 include 'admin/includes/db.php';

 include 'admin/includes/function.php';
 include 'includes/header.php';

?>
<style type="text/css">
.container .row .col-sm-3.offset-sm-1.blog-sidebar .sidebar-module.sidebar-module-inset p {
	text-align: justify;
}
</style>



    <div class="blog-header">
      <div class="container">
        <h1 class="blog-title">The SWAP SPACE Blog</h1>
        <p class="lead blog-description">Blogging since 1930.</p>
      </div>
    </div>

    <div class="container">

      <div class="row">

        <div class="col-sm-8 blog-main">

         <!-- /.blog-post -->


            <?php 
           Tools::archiveView($conn,$_GET['date']);
             
  
        
    ?>

         
          <p style="align-content: center;">
         
            <?php  // $paginate->paginglink($query,$posts_per_page); ?>
          
        <p>

        </div><!-- /.blog-main -->

        <div class="col-sm-3 offset-sm-1 blog-sidebar">
          



          <?php include 'includes/sidebar.php' ?>
        </div><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </div><!-- /.container -->

    <footer class="blog-footer">
      <p>Blog template built for <a href="https://getbootstrap.com">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
