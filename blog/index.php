<?php 
	include_once('../include/connection.php');
	$head = "";
	$articleName = "";
	$metaTag = "";
	$shortDesc = "";
	$article = "";
	$date = "";
	$author = "";
	$query  = "SELECT * ". "FROM article ORDER BY date DESC";
	if($query_result = mysqli_query($con,$query)){
		$query_num_row = mysqli_num_rows($query_result);
	}
	
?>
<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/blogstyle.css">
	<script src="../js/jquery.min.js"></script>
  	<script src="../js/bootstrap.min.js"></script>
		
	</head>
	<body>
		<!--Navigation Panel-->
	<nav id="top-nav" class="navbar navbar-inverse navbar-static-top" role="navigation">
		<div class="container">
			<div class="navbar-header page-scroll">
				<a class="navbar-brand" href="index.html">
					<div class="blog-header">
					    <img src="../img/webbanao.png" width="40px" height="20px" alt="logo">
       					<h1 class="blog-title">The Webbanao Blog</h1>
     				</div>
				</a>
			</div>
			<!--Menu items-->
			<div id="navbar" class="collapse navbar-collapse navbar-right navbarHeaderCollapse">
				<ul class="nav navbar-nav">
					<li><a href="../index.php">Home</a>
					</li>
					<li><a href="../blog/index.php">Blog</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
						<div class="container">
					<div class="row">
					<div class="col-sm-8 blog-main">
		<?php 
			if($query_num_row > 0){
				while($row = $query_result->fetch_assoc()) {
					$head =  $row["head"];
					$metaTag =  $row["metaTag"];
					$shortDesc =  $row["shortDesc"];
					$article =  $row["article"];
					$date =  $row["date"];
					$convertedDate = date("M d Y", strtotime($date));
					$author =  $row["author"];
					$articleName = $row["articleName"];
					echo "
					<div class=\"blog-post\">
					<h2 class=\"blog-post-title\">".$head."</h2>
					<p class=\"blog-post-meta\">".$convertedDate." by ".$author."</p>
					<p>".$shortDesc."</p>
					<h5><a href= \"../blog/article.php?articleName=".$articleName."\">read more</a></h5>
					</div>
					";
				}
			} 
			else
			{
				$head = "The article is not available";
				$article = "Sorry, this is so embarrassing. We were not expecting this.";	
			}
			$con->close();
		?>
		<!--<nav>
            <ul class="pager">
              <li><a href="#">Previous</a></li>
              <li><a href="#">Next</a></li>
            </ul>
          </nav>-->

          </div>
           <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
          <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>In this blog we memebers of webbanao share our experience, tutorials, techniques and some free resources on web design and developement</p>
          </div>
          <div class="sidebar-module">
            <h4>Social-media</h4>
            <ol class="list-unstyled">
             	<li><a href="https://www.facebook.com/webbanao" target="_blank">Facebook</a></li>
			 	<li><a href="https://twitter.com/web_banao" target="_blank">Twitter</a></li>
				<li><a href="https://plus.google.com/104917054063729004309/about" target="_blank">GooglePlus</a></li>
				<li><a href="http://www.linkedin.com/company/web-banao" target="_blank">Linkedin</a></li>
			  </ol>
          </div>
        </div><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </div><!-- /.container -->

        </div>
		<footer class="footer" style="background-color:#374140;">
			<div class="container">
				<p class="navbar-text pull-left"><a href="#">Back to top</a></p>
				<p class="navbar-text pull-right" style="color: white;font-size: 15px;">&copy;Copyright 2014 - WebBanao.com. All rights reserved.</p>
			</div>
	</footer>	
	</body>
</html>