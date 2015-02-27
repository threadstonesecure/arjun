<?php 
	include_once('../include/connection.php');
	$head = "";
	$articleName = "";
	$metaTag = "";
	$shortDesc = "";
	$article = "";
	$date = "";
	$author = "";
	$query  = "SELECT * ". "FROM article";
	if($query_result = mysqli_query($con,$query)){
		$query_num_row = mysqli_num_rows($query_result);
	}
?>
<!DOCTYPE html>
<html>
	<head>
		
	</head>
	<body>
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
					<h1>Head : ".$head."</h1>
					<h4>Metatag : ".$metaTag."</h4>
					<h3>Short Description: ".$shortDesc."</h3>
					<h2>Article : ".$article."</h2>
					<h5>Date : ".$convertedDate."</h5>
					<h5>Author : ".$author."</h5>
					<h5><a href= \"http://localhost/arjun_test/blog/article.php?articleName=".$articleName."\">read more</a></h5>
					<hr/>
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
	</body>
</html>