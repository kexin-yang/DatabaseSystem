<?php include("includes/a_config.php");?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes/head-tag-contents.php");?>
</head>
<body>

<?php include("includes/design-top.php");?>
<?php include("includes/navigation.php");?>

<?php
// $counter  = 0;

// if () {
//   while ($row = $result -> fetch_row()) {
//         printf ("Job Title: %s Organization: %s\n\n", $row[1], $row[2]);
//         $counter = $counter + 1;
//   }
//   $result -> free_result();
//   echo "\n$counter\n";
// }
?>

<div class="container" id="main-content">
	<h2>Welcome to Workify!</h2>

	<table>
        <thead>
            <tr>
                <td>JID</td>
                <td>Job Title</td>
                <td>Organization</td>
                <td>Division</td>
                <td>Position Type</td>
                <td>Internal Status</td>
                <td>App Deadline</td>
                <td>Description</td>
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
			//$conn = new mysqli("127.0.0.1", $username, $password, $dbname,3306);

			//for deployment 
			$conn = new mysqli(null, $username, $password, $dbname, $dbport, $dbsocket);


			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
			// echo "\nConnected successfully\n";


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
                    <td><?php echo $row[7]?></td>
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
