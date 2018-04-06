<?php 
	$Auth = new Auth;
	if($Auth->isLogin()){	
?>
	<div class="col-lg-offset-4 col-lg-4 bg-success">
                    <p class="text-center">Hello, <?php echo $Auth->UserData()->name; ?> </p>
                    <p class="text-center">User email:  <?php echo $Auth->UserData()->email; ?> </p>
                    <a href="Logout" class="btn btn-default btn-block">Logout</a>
                </div>

<?php 
	}
	else{
?>
	<div class="col-lg-offset-4 col-lg-4 text-center">
		<div class="btn-group" role="group" aria-label="...">
			<a href='Login'  class="btn btn-default">Login</a>
			<a href="Registration" class="btn btn-default">Register</a>
		</div>
	</div>


<?php			
	}
?>


