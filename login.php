<?php
    require_once 'Core/init.php';

    if(Helper::checkInput()){
        $validate = new Validator();
        $rules = [
            'login' => ['name'=>'Login','required'=>true],
            'password'=>['name'=>'Password','required'=>true]
        ];
	    $validation = $validate->validate($_POST,$rules);
        if($validation->status()){
            $Auth = new Auth();
            $login = $Auth->login(Helper::getInput('login'),Helper::getInput('password'));
            if($login){
                Helper::redirect('index.php');
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<!-- Latest compiled and minified Bootstrap 3 CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
	      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="Includes/CSS/styles.css">
</head>
<body>
<div class="container form">
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4">
			<?php
			if(Helper::checkInput()){
				$validation->generateErrorHTML();
			}
			?>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<div class="text-center">
				<h3>Please Log-in</h3>
				<form role="form" class="form-horizontal" action="#" method="post">
					<div class="form-group">
						<label for="login" class="col-sm-4 control-label">Username or Email</label>
						<div class="col-sm-8">
							<input type="text" id="login" name="login" class="form-control" autofocus>
						</div>
					</div>
					<div class="form-group">
						<label for="password" class="col-sm-4 control-label">Password</label>
						<div class="col-sm-8">
							<input type="password" id="password" name="password" class="form-control" autofocus>
						</div>
					</div>
					<div class="form-group">
						<label for="password" class="col-sm-4 control-label"></label>
						<div class="col-sm-8">
							<button type="submit" class="btn btn-primary btn-block">Login</button>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-4">
							<p class="text-muted text-center"><small>Do not have an account?</small></p>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-4">
							<a class="btn btn-sm btn-white btn-block" href="register.php">Create an account</a>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>


</body>
</html>