<?php 
	include_once('../include/connection.php');
	$head = "";
	$articleName = "";
	$metaTag = "";
	$shortDesc = "";
	$article = "";
	$date = "";
	$author = "";
	if(isset($_GET["articleName"]))
	{
		$articleName = $_GET["articleName"];
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
				}
			} 
			else
			{
				$head = "The article is not available";
				$article = "Sorry, this is so embarrassing. We were not expecting this.";	
			}
			$con->close();
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		
	</head>
	<body>
		<h1>Head : <?php echo $head; ?></h1>
		<h4>Metatag : <?php echo $metaTag; ?></h4>
		<h3>Short Description: <?php echo $shortDesc; ?></h3>
		<h2>Article : <?php echo $article; ?></h2>
		<h5>Date : <?php echo $convertedDate; ?></h5>
		<h5>Author : <?php echo $author; ?></h5>

	</body>
</html>