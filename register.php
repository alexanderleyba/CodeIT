<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>
	<!-- Latest compiled and minified Bootstrap 3 CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
	      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="Includes/CSS/styles.css">
</head>
<body>
<div class="container form" >
	<form class="form-horizontal" role="form">
		<h2>Registration</h2>
		<div class="form-group">
			<label for="Email" class="col-sm-3 control-label">Email</label>
			<div class="col-sm-9">
				<input type="email" id="email" class="form-control" autofocus>
			</div>
		</div>
		<div class="form-group">
			<label for="username" class="col-sm-3 control-label">Username</label>
			<div class="col-sm-9">
				<input type="text" id="username"  class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label for="password" class="col-sm-3 control-label">Real name</label>
			<div class="col-sm-9">
				<input type="text" id="real_name" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label for="BirthDate" class="col-sm-3 control-label">Date of Birth</label>
			<div class="col-sm-9">
				<input type="date" id="BirthDate" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label for="country" class="col-sm-3 control-label">Country</label>
			<div class="col-sm-9">
				<select id="country" class="form-control">
					<option>test</option>
					<option>test</option>
					<option>test</option>
				</select>
			</div>
		</div> <!-- /.form-group -->
		<div class="form-group">
			<div class="col-sm-9 col-sm-offset-3">
				<div class="checkbox">
					<label>
						<input type="checkbox">I accept the terms
					</label>
				</div>
			</div>
		</div> <!-- /.form-group -->
		<div class="form-group">
			<div class="col-sm-9 col-sm-offset-3">
				<button type="submit" class="btn btn-primary btn-block">Register</button>
			</div>
		</div>
	</form>
</div>
</body>
</html>