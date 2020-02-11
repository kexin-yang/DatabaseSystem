<?php include("includes/a_config.php");?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes/head-tag-contents.php");?>
</head>
<body>

<?php include("includes/student-top.php");?>
<?php include("includes/secondary-nav.php");?>

<div class="container" id="main-content">
	
	<div class="container">
		<!-- todo: welcome, student name -->
		<?php
			session_start();
			
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

			$conn = new mysqli(null, $username, $password, $dbname, $dbport, $dbsocket);
		?>

	    <div class="row">
	        <div class="col-xs-5 col-md-3">
	            <h3>Filter jobs by</h3>

				<form>
				  <div class="form-group">
				    <label for="exampleFormControlInput1">Job Title</label>
				    <input type="text" class="form-control" id="jobTitleInput">
				  </div>
				  <button type="submit" class="btn btn-primary">Search</button>
				</form>
	        </div>

	        <div class="col-xs-1 col-md-1"></div>

	        <div class="col-xs-12 col-md-8">
            	<h3>Your postings</h3>

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
					$job_sql = "SELECT * FROM Job"; // todo: customize this query based on the selections on the form
					$job_result = $conn -> query($job_sql);
						
				    while($job_row = $job_result->fetch_row()) {
				?>
			    <tr>
			        <td><?php echo $job_row[0]?></td>
			        <td><?php echo $job_row[1]?></td>
			        <td><?php echo $job_row[2]?></td>
			        <td><?php echo $job_row[3]?></td>
			        <td><?php echo $job_row[4]?></td>
			        <td><?php echo $job_row[5]?></td>
			        <td><?php echo $job_row[6]?></td>
			    </tr>

			    <?php
					}
			    	$conn -> close();
			    ?>
			    </tbody>
			    </table>
	        </div>
	    </div>
	</div>
</div>

<?php include("includes/footer.php");?>

</body>
</html>
