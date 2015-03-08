<?php 
	include_once('../include/connection.php');
	$head = "";
	$articleName = "";
	$metaTag = "";
	$shortDesc = "";
	$article = "";
	$author = "";
	$msg = "";
	if(isset($_POST["submit"]))
	{
		if(!empty($_POST["head"]) 
			&& !empty($_POST["articleName"]) 
			&& !empty($_POST["metaTag"]) 
			&& !empty($_POST["shortDesc"])
			&& !empty($_POST["article"])
			&& !empty($_POST["author"]))
		{
			$head = $_POST["head"];
			$articleName = $_POST["articleName"];
			$metaTag = $_POST["metaTag"];
			$shortDesc = $_POST["shortDesc"];
			$article = $_POST["article"];
			$author = $_POST["author"];

			$sql = "INSERT INTO wb_article (slNo,head,articleName,metaTag,shortDesc,article,author,date) 
			VALUES (NULL, '".$head."', '".$articleName."', '".$metaTag."', '".$shortDesc."', 
				'".$article."', '".$author."', CURRENT_TIMESTAMP);";

			if ($con->query($sql) === TRUE) {
			    $msg = "Article succesfully posted";
			} else {
			    $msg = "Error: " . $sql . "<br>" . $con->error;
			}

			$con->close();
		}
		else
		{
			$msg = "Everything is necessary";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>New Blog Entry</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/blogstyle.css">
	<script src="js/jquery.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>
</head>

<body>
<script type="text/javascript" src="http://www.html.am/html-editors/ckeditor/ckeditor_3.4/ckeditor.js"></script> 
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
	<div id="blogeditor" class="container">

	
	<div class="col-sm-12 blog-main">
		<h2>Add new blog post</h2>
		<form class="form-horizontal" action="try.php" method="POST">
		<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Heading</label> 
			<input type="text" id="head" name="head" placeholder="Heading for the article" />
		</div>


		<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Meta tags</label> 
			<input type="text" id="metaTag" name="metaTag" placeholder="Comma seperated meta tags" />
		</div>
	

		<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Author</label> 
			 <input type="text" id="author" name="author" placeholder="Author of the article" />
		</div>

		<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Article Url name</label>
			 <input type="text" id="articleName" name="articleName" placeholder="'-' Separated article url" />
		</div>

		<div class="form-group">
		<label for="inputEmail3" class="control-label">Main article</label> 
			 <textarea class="ckeditor form-control" id="article" name="article" cols="35" rows="10">
			</textarea>
		</div>

		<div class="form-group">
		<label for="inputEmail3" class="control-label">Short Description</label> 
			 <textarea class="ckeditor form-control" id="shortDesc" name="shortDesc" cols="10" rows="3">
			</textarea>
		</div>
	
	<input type="Submit" value="Post article" name="submit" id="submit">
</form>
<div id="message">
	<?php echo $msg;?>	
</div>
			</div>	
	</div>



		<footer>
		<nav class="navbar navbar-inverse navbar-static-bottom" role="navigation">
			<div class="container">
				<p class="navbar-text pull-left"><a href="#">Back to top</a></p>
				<p class="navbar-text pull-right" style="color: white;font-size: 15px;">&copy;Copyright 2014 - WebBanao.com. All rights reserved.</p>
			</div>
		</nav>
	</footer>
<script type="text/javascript"> 
//<![CDATA[
	CKEDITOR.replace('article',
	    {
	    	
	        toolbar :
	        [
			  
			['Bold'], ['Italic'], ['Underline'], ['Strike'], ['Subscript'], ['Superscript'], ['NumberedList'], ['BulletedList'], ['Outdent'], ['Indent'], ['Blockquote'], ['CreateDiv'], ['JustifyLeft'], ['JustifyCenter'], ['JustifyRight'], ['JustifyBlock'], ['Styles'], ['Format'], ['Font'], ['FontSize'], ['TextColor'], ['BGColor'], ['Source'] 	        		  	
	        ]
	        		
	    });

	CKEDITOR.replace('shortDesc',
	    {
	    	
	        toolbar :
	        [
			  
			['Bold'], ['Italic'], ['Underline'], ['Strike'], ['Subscript'], ['Superscript'], ['NumberedList'], ['BulletedList'], ['Outdent'], ['Indent'], ['Blockquote'], ['CreateDiv'], ['JustifyLeft'], ['JustifyCenter'], ['JustifyRight'], ['JustifyBlock'], ['Styles'], ['Format'], ['Font'], ['FontSize'], ['TextColor'], ['BGColor'], ['Source'] 	        		  	
	        ]
	        		
	    });
		
	CKEDITOR.on( 'instanceReady', function( ev )
	    {
			ev.editor.dataProcessor.writer.setRules( 'p',
                 {
                     indent : false,
                     breakBeforeOpen : false,
                     breakAfterOpen : false,
                     breakBeforeClose : false,
                     breakAfterClose : true
                 });
			ev.editor.dataProcessor.writer.setRules( 'li',
	             {
	                 indent : false,
	                 breakBeforeOpen : false,
	                 breakAfterOpen : false,
	                 breakBeforeClose : false,
	                 breakAfterClose : true
	             });
			ev.editor.dataProcessor.writer.setRules( 'ul',
	             {
	                 indent : false,
	                 breakBeforeOpen : false,
	                 breakAfterOpen : true,
	                 breakBeforeClose : false,
	                 breakAfterClose : true
	             });
			ev.editor.dataProcessor.writer.setRules( 'ol',
	             {
	                 indent : false,
	                 breakBeforeOpen : false,
	                 breakAfterOpen : true,
	                 breakBeforeClose : false,
	                 breakAfterClose : true
	             });
	    });    
	    
//]]>
</script>

</script>
</body>
</html>