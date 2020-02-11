<?php include("includes/a_config.php");?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes/head-tag-contents.php");?>
	<!-- need to fix this  -->
</head>
<body>

<?php include("includes/design-top.php");?>
<?php include("includes/navigation.php");?>

<div class="container" id="main-content">
	<h2>Employer Portal</h2>

	<?php
	    require __DIR__ . '/vendor/autoload.php';
		require __DIR__ . '/env.php';

		use Google\Cloud\Storage\StorageClient;

		$app = array();
		$app['bucket_name'] = "cs348demo-266020.appspot.com";
		$app['mysql_user'] =  $mysql_user;
		$app['mysql_password'] = $mysql_password;
		$app['mysql_dbname'] = "Workify";
		$app['project_id'] = getenv('GCLOUD_PROJECT');
		$app['connection_name'] = "/cloudsql/cs348demo-266020:us-central1:workify-db";

		$username = $app['mysql_user'];
		$password = $app['mysql_password'];
		$dbname = $app['mysql_dbname'];
		$dbport = null;
		$dbsocket = $app['connection_name'];

		// Create connection
		//for testing on localhost:8080
		//$conn = new mysqli("127.0.0.1", $username, $password, $dbname,3306);

		//for deployment 
		$conn = new mysqli(null, $username, $password, $dbname, $dbport, $dbsocket);


		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		echo "<p>Connected successfully</p>";

		$sql = "SELECT COUNT(*) FROM Company WHERE Name = '".$_POST["name"]."' AND Password = '".$_POST["password"]."'";

		$result = $conn -> query($sql);
		$row = $result->fetch_row();

		if ($row[0] == 1) {
			echo "Login successful.";
		} else {
			echo "Incorrect username or password.";
		}

		$conn -> close();
	?>

</div>

<?php include("includes/footer.php");?>

</body>
</html>
