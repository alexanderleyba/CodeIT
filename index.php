<?php
    require_once 'core/init.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Index</title>
	<!-- Latest compiled and minified Bootstrap 3 CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
	      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="Includes/CSS/styles.css">
</head>
<body>

<div class="container form" >
	<div class="row">
		<div class="col-lg-offset-4 col-lg-4">
			<a href="login.php" class="btn btn-primary btn-block">Log In</a>
            <a href="register.php" class="btn btn-warning btn-block">Register</a>
		</div>
	</div>
    <div class="row">
        <div class="col-lg-12">
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-offset-4 col-lg-4" >

            <?php
            //  $test =  DB::getInstance()->QueryBuilder("SELECT * FROM users WHERE username = ?" , array('alex'));
                $test = DB::getInstance()->insert('users',
                    array(
                        'username'=>'Bilbo Baggins',
                        'password'=>'qwerty',
                        'salt'=>'salty salt',
                        'email'=>'hobbyt@test.com'
                    ));

            ?>

        </div>
    </div>
</div>


</body>
</html>