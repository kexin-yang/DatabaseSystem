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

<?php include("includes/employer-top.php");?>
<?php include("includes/secondary-nav.php");?>

<div class="container" id="main-content">

	<div class="container">
		<!-- todo: welcome, employer name -->
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
		?>

	    <div class="row">
	        <div class="col-xs-5 col-md-3">
	            <h3>Post a new job</h3>

				<form>
				  <div class="form-group">
				    <label for="exampleFormControlInput1">Job Title</label>
				    <input type="text" class="form-control" id="jobTitleInput">
				  </div>
				  <div class="form-group">
				    <label for="exampleFormControlInput1">Division</label>
				    <input type="text" class="form-control" id="divisonInput">
				  </div>
				  <div class="form-group">
				    <label for="exampleFormControlSelect1">Position Type</label>
				    <select class="form-control" id="positionTypeSelect">
				      <option>Graduating</option>
				      <option>Full-time</option>
				      <option>Internship</option>
				    </select>
				  </div>
				  <div class="form-group">
				    <label for="exampleFormControlSelect1">Internal Status</label>
				    <select class="form-control" id="internalStatusSelect">
				      <option>Open for Applications</option>
				      <option>Closed for Applications</option>
				    </select>
				  </div>
				  <div class="form-group">
				    <label for="exampleFormControlInput1">App Deadline</label>
				    <input type="text" class="form-control" id="appDeadlineInput">
				  </div>
				  <div class="form-group">
				    <label for="exampleFormControlTextarea1">Job Description</label>
				    <textarea class="form-control" id="jobDescriptionInput" rows="3"></textarea>
				  </div>
				  <button type="submit" class="btn btn-primary">Post</button>
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
			            <th scope="col">Division</th>
			            <th scope="col">Position Type</th>
			            <th scope="col">Internal Status</th>
			            <th scope="col">App Deadline</th>
			            <!-- <th scope="col">Description</td> Hiding description for now because it is too long -->
			        </tr>
			    </thead>
			    <tbody>
			    <?php
					$job_sql = "SELECT * FROM Job WHERE Organization = '".$_SESSION['name']."'";
					$job_result = $conn -> query($job_sql);
					
			        while($job_row = $job_result->fetch_row()) {
				?>
			    <tr>
			        <td><?php echo $job_row[0]?></td>
			        <td><?php echo $job_row[1]?></td>
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
