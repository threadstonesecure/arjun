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

			$sql = "INSERT INTO article (slNo,head,articleName,metaTag,shortDesc,article,author,date) 
			VALUES (NULL, \"".$head."\", \"".$articleName."\", \"".$metaTag."\", \"".$shortDesc."\", 
				\"".$article."\", \"".$author."\", CURRENT_TIMESTAMP);";

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
	<title>WYSIWYG</title>
</head>
<body>
<script type="text/javascript" src="http://www.html.am/html-editors/ckeditor/ckeditor_4.4.1_full/ckeditor.js"></script>
<?php echo $msg;?>
<form action="try.php" method="POST">
	<p>Heading : <input type="text" id="head" name="head" placeholder="Heading for the article" /></p>
	<p>Meta tags: <input type="text" id="metaTag" name="metaTag" placeholder="comma seperated meta tags" /></p>
	<p>Author : <input type="text" id="author" name="author" placeholder="Author of the article" /></p>
	<p>Article name : <input type="text" id="articleName" name="articleName" placeholder="article-name for database" /></p>
	<p>Short Description :</p>
	<textarea class="ckeditor" id="shortDesc" name="shortDesc" cols="10" rows="3">
	<h2>Start typing from here</h2>
	</textarea>
	<p>Main article text :</p>
	<textarea class="ckeditor" id="article" name="article" cols="35" rows="10">
	<h2>Start typing from here</h2>
	</textarea>
	<input type="Submit" value="Post article" name="submit" id="submit">
</form>
<script type="text/javascript"> 
//<![CDATA[

	CKEDITOR.replace( 'article',
		{
			fullPage : true,
		});
	CKEDITOR.replace( 'shortDesc',
		{
			fullPage : true,
		});
//]]>
</script>
</body>
</html>