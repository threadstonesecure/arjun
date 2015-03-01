<?php 
	include_once('../include/connection.php');

	//adding comment to db 
	$msg = '';
	$msg_code = 'success';
	$captcha = '';
	$commentName = "";
	$commentEmail = "";
	$message = "";
	$commentSlNo = "";
	if (isset($_POST['send'])) {
        if(isset($_POST['commentName'])){
          $commentName = mysqli_real_escape_string($con,$_POST['commentName']);
        }
        if(isset($_POST['commentEmail'])){
          $commentEmail = mysqli_real_escape_string($con,$_POST['commentEmail']);
        }
        if(isset($_POST['message'])){
          $message =  mysqli_real_escape_string($con,$_POST['message']);
        }
        if(isset($_POST['commentSlNo'])){
          $commentSlNo = mysqli_real_escape_string($con,$_POST['commentSlNo']);
        }
        if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
          $msg = "We would love to contact a real human.";
          $msg_code = 'failure';
        }
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lf8MQITAAAAADem8RmHnkgorsqMAtOmaH8CyH9n&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
		$obj = json_decode($response);
		$condition = $obj->{'success'};
        if($condition == false)
        {
        	$msg = "We would love to contact a real human.";
        	$msg_code = 'failure';
        }
        else if ($condition == true)
        {
        	$sql = "INSERT INTO comment (slNo,name,email,comment,commentDate,articleNo) 
			VALUES (NULL, \"".$commentName."\", \"".$commentEmail."\", \"".$message."\", CURRENT_TIMESTAMP,\"".$commentSlNo."\");";

			if ($con->query($sql) === TRUE) {
			    $msg = "comment successfully added";
			} else {
			    $msg = "Error: " . $sql . "<br>" . $con->error;
			}
		}
	}


	$head = "";
	$articleName = "";
	$metaTag = "";
	$shortDesc = "";
	$article = "";
	$date = "";
	$author = "";
	$slNo = "";
	$convertedDate = "";
	
	//comment parts
	$name = "";
	$email = "";
	$comment = "";
	$commentDate = "";
	$convertedCommentDate = "";

	//query veriables
	$query = "";
	$query_result = "";
	$query_num_row = "";
	$row = "";

	$query1 = "";
	$query_result1 = "";
	$query_num_row1 = "";
	$row1 = "";
	if(isset($_GET["articleName"]))
	{
		$articleName = $_GET["articleName"];
		$articleName = mysqli_real_escape_string($con,$articleName);
		$query  = "SELECT * ". "FROM article". " WHERE articleName = '".$articleName."'";
		if($query_result = mysqli_query($con,$query)){
			$query_num_row = mysqli_num_rows($query_result);
			if($query_num_row > 0){
    			while($row = $query_result->fetch_assoc()) {
					$head =  $row["head"];
					$metaTag =  $row["metaTag"];
					$shortDesc =  $row["shortDesc"];
					$article =  $row["article"];
					$date =  $row["date"];
					$author =  $row["author"];
					$convertedDate = date("M d Y", strtotime($date));
					$slNo = $row["slNo"];


					// fetching comments
					$query1  = "SELECT * ". "FROM comment where articleNo = ".$slNo." order by commentDate DESC;";
					if($query_result1 = mysqli_query($con,$query1)){
						$query_num_row1 = mysqli_num_rows($query_result1);
					}
				}
			} 
			else
			{
				$head = "The article is not available";
				$article = "Sorry, this is so embarrassing. We were not expecting this.";	
			}
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/blogstyle.css">
		<script src="js/jquery.min.js"></script>
    	<script src="js/bootstrap.min.js"></script>	
	</head>
	<body>

		<!--Navigation Panel-->
	<nav id="top-nav" class="navbar navbar-inverse navbar-static-top" role="navigation">
		<div class="container">
			<div class="navbar-header page-scroll">

				<a class="navbar-brand" href="../blog/index.php">
					
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
        <div class="col-lg-8 blog-main">

          <div class="blog-post">
            <h2 class="blog-post-title"><?php echo $head; ?></h2>
            <p class="blog-post-meta"><?php echo $convertedDate; ?> by <?php echo $author; ?></p>
				<?php echo $article; ?>
          

        </div>
        
		 <!-- Comments Form -->
        <div class="well">
			<h3>Comments:</h3>
		<?php 
			if($query_num_row1 > 0){
				while($row1 = $query_result1->fetch_assoc()) {
					$name =  $row1["name"];
					$email =  $row1["email"];
					$comment =  $row1["comment"];
					$commentDate =  $row1["commentDate"];
					$convertedCommentDate = date("M d,Y g:H a", strtotime($commentDate));
					echo "
					<form role=\"form\">
                		<div class=\"form-group\">
                			<h4>Comment by ".$name." at ".$convertedCommentDate." </h4>
                			<p>".$comment."</p>
						</form>
          			</div>
					";
				}
			} 
			else
			{
				echo "<h4>This article has no comments. Be the first one.</h4>";
			}
		?>
				<form id="comment-form" action="article.php?articleName=<?php echo $articleName?>" method="POST">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" class="form-control" id="commentName" placeholder="Enter name" required="required" name="commentName" placeholder="Your name"/>
						</div>
						<div class="form-group">
							<label for="email">Email Address</label>
							<div class="input-group">
								<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
								</span>
								<input type="email" class="form-control" id="commentEmail" placeholder="Enter email" required="required" name="commentEmail" placeholder="Your email address"/>
							</div>
						</div>
						<input type="hidden" value="<?php echo $slNo;?>" name = "commentSlNo">
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="name">Message</label>
							<textarea name="message" id="message" class="form-control" rows="8" cols="25" required="required" placeholder="Message"></textarea>
						</div>
					</div>
					<div class="col-md-12">
					<div class="g-recaptcha" data-sitekey="6Lf8MQITAAAAAPhacG1vc6HXofDIl9ygx5MrSjov"></div>
				</div>
					<div class="col-md-12">
						<button type="submit" name="send" class="btn btn-skin pull-left" style="margin-top:10px;" id="btnContactUs">
							Send Message</button>
					</div>
				</div>
				<div id="<?php echo $msg_code; ?>">
					<p>
						<?php echo $msg; ?>
					</p>
				</div>
			</form>
        </div>
        

        </div> <!-- /.blog-main -->
        
        <div class="col-md-3 col-md-offset-1 blog-sidebar">
          <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>In this blog we memebers of webbanao share our experience, tutorials, techniques and some free resources on web design and developement</p>
          </div>
          <div class="sidebar-module">
            <h4>Social-media</h4>
            <ol class="list-unstyled">
              <li><a href="#">GitHub</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Facebook</a></li>
            </ol>
          </div>
        </div><!-- /.blog-sidebar -->
      </div><!-- /.row -->
    </div><!-- /.container -->
	
	<footer>
		<nav class="navbar navbar-inverse navbar-static-bottom" role="navigation">
			<div class="container">
				<p class="navbar-text pull-left"><a href="#">Back to top</a></p>
				<p class="navbar-text pull-right" style="color: white;font-size: 15px;">&copy;Copyright 2014 - WebBanao.com. All rights reserved.</p>
			</div>
		</nav>
	</footer>	
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<?php $con->close();?>
	</body>
</html>