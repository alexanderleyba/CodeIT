<?php
    require_once 'core/init.php';
    $user = new Auth();
    if($user->isLogin()) {

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Index</title>
	<link rel="stylesheet" href="/Includes/CSS/bootstrap.min.css">
	<link rel="stylesheet" href="Includes/CSS/styles.css">
</head>
<body>

<div class="container form" >
	<div class="row">
        <?php
            if(!$user->isLogin()) {
        ?>
            <div class="col-lg-offset-4 col-lg-4 text-center">
                <div class="btn-group" role="group" aria-label="...">
                    <a href="login.php"  class="btn btn-default">Login</a>
                    <a href="register.php" class="btn btn-default">Register</a>
                </div>
            </div>

        <?php
            }
            else {
        ?>
            <div class="col-lg-offset-4 col-lg-4 bg-success">
                <p class="text-center">Hello, <?php echo $user->UserData()->name; ?> </p>
                <p class="text-center">User email:  <?php echo $user->UserData()->email; ?> </p>
                <a href="logout.php" class="btn btn-default btn-block">Logout</a>
            </div>
        <?php
            }
        ?>


	</div>
</div>


</body>
</html>