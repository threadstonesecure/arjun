<?php 
	include_once('../include/connection.php');
	$head = "";
	$articleName = "";
	$metaTag = "";
	$shortDesc = "";
	$article = "";
	$date = "";
	$author = "";
	if(isset($_GET["meta"]))
	{
		$meta = $_GET["meta"];
		$meta = mysqli_real_escape_string($con,$meta);
		$query  = "SELECT * FROM wb_article a WHERE FIND_IN_SET('".$meta."',a.metaTag)>0 ORDER BY date DESC;";
		if($query_result = mysqli_query($con,$query)){
			$query_num_row = mysqli_num_rows($query_result);
		}
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
		<!-- facebook like script start-->
		<script>
			window.fbAsyncInit = function() {
				FB.init({
					appId: '196708687162159',
					xfbml: true,
					version: 'v2.2'
				});
			};

			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) {
					return;
				}
				js = d.createElement(s);
				js.id = id;
				js.src = "//connect.facebook.net/en_US/sdk.js";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>

		<div id="fb-root"></div>
		<script>
			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s);
				js.id = id;
				js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&appId=196708687162159&version=v2.0";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>
	<!-- facebook like script end-->
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
		<div id="float-social">

			<div class="float-social-item">
				<fb:like href="https://www.facebook.com/webbanao" layout="box_count" action="like" show_faces="true" share="true"></fb:like>
			</div>
			<div class="float-social-item"><a class="twitter-share-button" data-count="vertical" href="https://twitter.com/web_banao">Tweet</a>
			</div>
			<div class="float-social-item">
				<div class="g-plusone" data-size="tall" data-href="http://www.webbanao.com"></div>
			</div>
		</div>
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
					<p><span class=\"blog-post-title\">".$head."
					</span>";
					$metaArray = explode(",",$metaTag);
					foreach ($metaArray as &$value) {
    					echo "<a href=\"metaSearch.php?meta=".$value."\" ><span id=\"meta\">".$value."</span></a> ";
					}
					echo "</p><p class=\"blog-post-meta\">".$convertedDate." by ".$author."</p>
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
            <h4 id="abouttitle">About</h4>
            <p>In this blog we memebers of webbanao share our experience, tutorials, techniques and some free resources on web design and developement</p>
          </div>
          <div class="sidebar-module">
            <h4 id="mediatitle">Social-media</h4>
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
	
	<!-- twitter api start-->
	<script>
		window.twttr = (function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0],
				t = window.twttr || {};
			if (d.getElementById(id)) return;
			js = d.createElement(s);
			js.id = id;
			js.src = "https://platform.twitter.com/widgets.js";
			fjs.parentNode.insertBefore(js, fjs);
			t._e = [];
			t.ready = function(f) {
				t._e.push(f);
			};
			return t;
		}(document, "script", "twitter-wjs"));
	</script>
	<!-- twitter api end-->
	<script src="https://apis.google.com/js/platform.js" async defer></script>
	</body>
</html>