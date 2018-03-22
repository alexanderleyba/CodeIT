<?php

    require_once 'core/init.php';

    $Auth = new Auth();
    // checking if User already logged in
    if($Auth->isLogin()){
        // logged in user is redirected to the index page
        Helper::redirect('index.php');
    }elseif (Helper::checkInput()){
	    $validate = new Validator();
	    $rules = [
		    'username'=> [
			    'name'=>'Username',
			    'required'=> true,
			    'min' => 5,
			    'max' => 20,
			    'unique'=> 'users',
			    'bad_symbols'=>true
		    ],

		    'name'=> [
			    'name' => 'Real name',
			    'required'=> true,
			    'min' => 5,
			    'max' => 50
		    ],

		    'DOB' => [
			    'name' => 'Date of Birth',
			    'required'=> true
		    ],

		    'country' => [
			    'name'=> 'Country',
			    'required'=> true
		    ],

		    'email'=>[
			    'name'=>'Email',
			    'required'=> true,
			    'type'=>'email',
			    'unique'=>'users'
		    ],

		    'password' => [
			    'name'=>'Password',
			    'required'=> true,
			    'min' => 6,
			    'max' => 25
		    ],

		    'password_second' => [
			    'name'=>'Password again',
			    'required'=> true,
			    'matches' => 'password'
		    ],

		    'terms' => [
			    'name'=>'Terms',
			    'required' => true
		    ]
	    ];
	    $validation = $validate->validate($_POST,$rules);

	    if($validation->status()){
		    try {
			    $Auth->register(array(
					    'username'=>Helper::getInput('username'),
					    'name'=>Helper::getInput('name'),
					    'email'=>Helper::getInput('email'),
					    'date_of_birth'=>Helper::getInput('DOB'),
					    'country'=>Helper::getInput('country'),
					    'password'=>password_hash(Helper::getInput('password'),PASSWORD_DEFAULT),
					    'registration_time' => strtotime(date('Y-m-d H:i:s'))
				    )
			    );
               if($Auth->login(Helper::getInput('username'),Helper::getInput('password'))){
                   Helper::redirect('index.php');
               }
		    } catch(Exception $e) {
			    die($e->getMessage());
		    }
	    }
	    else{
            $validation->generateHTMLerror();
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>
    <link rel="stylesheet" href="Includes/CSS/bootstrap.min.css">
	<link rel="stylesheet" href="Includes/CSS/styles.css">
</head>
<body>

<div class="container form" >
	<form class="form-horizontal" role="form" method="POST" action="">
		<h2>Registration</h2>
		<div class="form-group">
			<label for="email" class="col-sm-3 control-label">Email</label>
			<div class="col-sm-9">
				<input type="text" id="email" name="email" class="form-control" autofocus value="<?php echo Helper::getInput('email')?>">
			</div>
		</div>
		<div class="form-group">
			<label for="username" class="col-sm-3 control-label">Username</label>
			<div class="col-sm-9">
				<input type="text" id="username" name="username" class="form-control" value="<?php echo ltrim(Helper::getInput('username'))?>">
			</div>
		</div>
		<div class="form-group">
			<label for="name" class="col-sm-3 control-label">Your Name</label>
			<div class="col-sm-9">
				<input type="text" id="name" name="name" class="form-control" value="<?php echo ltrim(Helper::getInput('name'))?>">
			</div>
		</div>

		<div class="form-group">
			<label for="DOB" class="col-sm-3 control-label">Date of Birth</label>
			<div class="col-sm-9">
				<input type="date" id="DOB" name="DOB"  class="form-control" value="<?php echo Helper::getInput('DOB')?>">
			</div>
		</div>
		<div class="form-group">
			<label for="country" class="col-sm-3 control-label">Country</label>
			<div class="col-sm-9">
				<select id="country" name="country" class="form-control">
                    <?php
                        $request_countries = DB::getInstance()->QueryExecute('SELECT * FROM Country');
                        $countries = $request_countries->results();
                            echo "<option value=''> </option>";
                            foreach ($countries as $country){

                                if(Helper::getInput('country') === $country->Name){

	                                echo "<option selected='selected' value='$country->Name'>$country->Name</option>";

                                }else{

	                                echo "<option value='$country->Name'>$country->Name</option>";

                                }

                            }
                    ?>
				</select>
			</div>
		</div>

        <div class="form-group">
            <label for="password" class="col-sm-3 control-label">password</label>
            <div class="col-sm-9">
                <input type="password" id="password" name="password"  class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="password_second" class="col-sm-3 control-label">Repeat your password</label>
            <div class="col-sm-9">
                <input type="password" id="password_second" name="password_second"  class="form-control">
            </div>
        </div>

		<div class="form-group">
			<div class="col-sm-9 col-sm-offset-3">
				<div class="checkbox">
					<label>
                        <?php
                            if(Helper::getInput('terms') === 'true'){
	                            echo '<input type="checkbox" name="terms" id="terms" value="true" checked>I accept the terms';
                            }
                            else{
	                            echo '<input type="checkbox" name="terms" id="terms" value="true">I accept the terms';
                            }
                        ?>

					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-sm-offset-3">
				<button type="submit" class="btn btn-primary btn-block">Register</button>
			</div>
		</div>
	</form>
</div>
</body>
</html>