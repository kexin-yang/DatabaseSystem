<?php 
	include("includes/a_config.php");
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes/head-tag-contents.php");?>
</head>
<body>

<?php include("includes/design-top.php");?>
<?php include("includes/navigation.php");?>

<?php
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

	$conn = new mysqli(null, $username, $password, $dbname, $dbport, $dbsocket);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$sql = "SELECT COUNT(*) FROM Company WHERE Name = '".$_POST["name"]."' AND Password = '".$_POST["password"]."'";

		$result = $conn -> query($sql);
		$row = $result->fetch_row();

		if ($row[0] != 1) {
			echo "Incorrect username or password.";
		} else {
			header("location: employer-login.php");
			$_SESSION['name'] = $_POST["name"];
		}
	}
?>

<div class="container" id="main-content">

	<div class="row">
        <div class="col-md-5">
            <h2>Employer Log In</h2>
			<form action="" method="post">
			  <div class="form-group">
			    <label for="exampleInputId1">Organization name</label>
			    <input type="text" name="name" class="form-control" id="exampleInputId1" aria-describedby="emailHelp" placeholder="Enter organization name">
			    <small id="emailHelp" class="form-text text-muted">We'll never share your information with anyone else.</small>
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Password</label>
			    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
			  </div>
		<!-- 		  <div class="form-check">
			    <input type="checkbox" class="form-check-input" id="exampleCheck1">
			    <label class="form-check-label" for="exampleCheck1">Check me out</label>
			  </div> -->
			  <button type="submit" class="btn btn-primary">Submit</button>
			</form>
        </div>

        <div class="col-md-2" align="center">
            <h3> <br> <br> Or <br> <br> </h3>
        </div>

        <div class="col-md-5">
            <h2>Create a New Account</h2>
			<form action="" method="post">
			  <div class="form-group">
			    <label for="createNameInput">Organization name</label>
			    <input type="text" name="name-create" class="form-control" id="createNameInput" placeholder="Enter organization name">
			  </div>
			  <div class="form-group">
			    <label for="createPasswordInput">Password</label>
			    <input type="password" name="password-create" class="form-control" id="createPasswordInput" placeholder="Password">
			  </div>
			  <div class="form-group">
			    <label for="verifyPasswordInput">Confirm Password</label>
			    <input type="password" name="password-verify" class="form-control" id="verifyPasswordInput" placeholder="Password">
			  </div>
			  <button type="submit" class="btn btn-primary">Submit</button>
			</form>
        </div>
    </div>

</div>

<?php include("includes/footer.php");?>

</body>
</html>