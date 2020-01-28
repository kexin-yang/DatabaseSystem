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
	<h2>Employer Log In</h2>
		<form action="employer-login.php">
		  <div class="form-group">
		    <label for="exampleInputId1">Organization name</label>
		    <input type="text" class="form-control" id="exampleInputId1" aria-describedby="emailHelp" placeholder="Enter organization name">
		    <small id="emailHelp" class="form-text text-muted">We'll never share your information with anyone else.</small>
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Password</label>
		    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
		  </div>
<!-- 		  <div class="form-check">
		    <input type="checkbox" class="form-check-input" id="exampleCheck1">
		    <label class="form-check-label" for="exampleCheck1">Check me out</label>
		  </div> -->
		  <button type="submit" class="btn btn-primary">Submit</button>
		</form>
</div>

<?php include("includes/footer.php");?>

</body>
</html>