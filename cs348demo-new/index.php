<?php include("includes/a_config.php");?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes/head-tag-contents.php");?>
</head>
<body>

<?php include("includes/design-top.php");?>
<?php include("includes/navigation.php");?>

<div class="container" id="main-content">
	<h2>All postings</h2>

	<table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">JID</th>
                <th scope="col">Job Title</th>
                <th scope="col">Organization</th>
                <th scope="col">Division</th>
                <th scope="col">Position Type</th>
                <th scope="col">Internal Status</th>
                <th scope="col">App Deadline</th>
                <!-- <th scope="col">Description</td> Hiding description for now because it is too long -->
            </tr>
        </thead>
        <tbody>
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
			//$conn = new mysqli("127.0.0.1", $username, $password, $dbname, 3306);

			//for deployment 
			$conn = new mysqli(null, $username, $password, $dbname, $dbport, $dbsocket);


			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}

			$sql = "SELECT * FROM Job";

			$result = $conn -> query($sql);

            while($row = $result->fetch_row()) {
            ?>
                <tr>
                    <td><?php echo $row[0]?></td>
                    <td><?php echo $row[1]?></td>
                    <td><?php echo $row[2]?></td>
                    <td><?php echo $row[3]?></td>
                    <td><?php echo $row[4]?></td>
                    <td><?php echo $row[5]?></td>
                    <td><?php echo $row[6]?></td>
                    <!-- <td><?php echo $row[7]?></td> -->
                </tr>

            <?php
            }
            $conn -> close();
            ?>
            </tbody>
            </table>
</div>

<?php $conn -> close(); ?>
<?php include("includes/footer.php");?>

</body>
</html>
