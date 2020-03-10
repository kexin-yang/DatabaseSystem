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

<?php include("includes/student-top.php");?>
<?php include("includes/secondary-nav.php");?>

<div class="container" id="main-content">
	
	<div class="container">
		<!-- todo: welcome, student name -->
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

		<nav>
		  <div class="nav nav-tabs" id="nav-tab" role="tablist">
		    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Job Search</a>
		    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Your Applications</a>
		  </div>
		</nav>
		<div class="tab-content" id="nav-tabContent">
		  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
		  	<div class="row">
		        <div class="col-xs-5 col-md-3">
		            <h3>Filter jobs by</h3>

					<form action="" method="post"> 
					  <div class="form-group">
					    <label for="jobTitleInput">Job Title</label>
					    <input type="text" class="form-control" id="jobTitleInput">
					    <label for="formControlRange">Minimum Company Rating</label>
					    <input type="range" class="form-control-range" id="formControlRange">
					  </div>
					  <button type="submit" class="btn btn-primary">Search</button>
					</form>
		        </div>

		        <div class="col-xs-1 col-md-1"></div>

		        <div class="col-xs-12 col-md-8">
					<table class="table table-striped">
				    <thead>
				        <tr>
				            <th scope="col">JID</th>
				            <th scope="col">Job Title</th>
				            <th scope="col">Organization</th>
				            <th scope="col">Position Type</th>
				            <th scope="col">Internal Status</th>
				            <th scope="col">App Deadline</th>
				            <th scope="col"> </th>
				            <th scope="col"> </th>
				            <!-- <th scope="col">Description</td> Hiding description for now because it is too long -->
				        </tr>
				    </thead>
				    <tbody>
				    <?php
				    	if($_SERVER["REQUEST_METHOD"] == "POST") {
				    		// do something with the data passed in
				    	} else {
				    		$job_sql = "SELECT * FROM Job"; // todo: customize this query based on the selections on the form
				    	}
						$job_result = $conn -> query($job_sql);
							
					    while($job_row = $job_result->fetch_row()) {
					?>
				    <tr>
				        <td><?php echo $job_row[0]?></td>
				        <td><?php echo $job_row[1]?></td>
				        <td><?php echo $job_row[2]?></td>
				        <td><?php echo $job_row[4]?></td>
				        <td><?php echo $job_row[5]?></td>
				        <td><?php echo $job_row[6]?></td>
				        <td>
				        	<button type="button" class="btn btn-primary">Details</button>
				        </td>
				        <td>
				        	<button type="button" class="btn btn-primary">Apply</button>
				        </td>
				    </tr>

				    <?php
						}
				    ?>
				    </tbody>
				    </table>
		        </div>
		    </div>
		  </div>
		  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
		  	<table class="table table-striped">
		    <thead>
		        <tr>
		            <th scope="col">JID</th>
		            <th scope="col">Job Title</th>
		            <th scope="col">Organization</th>
		            <th scope="col">Position Type</th>
		            <th scope="col"> </th>
		            <!-- <th scope="col">Description</td> Hiding description for now because it is too long -->
		        </tr>
		    </thead>
		    <tbody>
		    <?php
		    	$applied_sql = "SELECT DISTINCT * FROM Job, Applied WHERE Applied.SID = ".$_SESSION['sid']." AND Applied.JID = Job.JID";
				$applied_result = $conn -> query($applied_sql);
					
			    while($applied_row = $applied_result->fetch_row()) {
			?>
		    <tr>
		        <td><?php echo $applied_row[0]?></td>
		        <td><?php echo $applied_row[1]?></td>
		        <td><?php echo $applied_row[2]?></td>
		        <td><?php echo $applied_row[4]?></td>
		        <td>
		        	<button type="button" class="btn btn-danger">Cancel Application</button>
		        </td>
		    </tr>

		    <?php
				}
		    ?>
		    </tbody>
		    </table>
		  </div>
		</div>
	</div>
</div>

<?php 
	$conn -> close();
	include("includes/footer.php");
?>

</body>
</html>
