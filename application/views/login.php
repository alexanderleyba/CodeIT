<?php if(isset($data['error'])){
       echo "<div class='alert alert-danger text-center' role='alert'>";
       foreach ($data['error'] as $error) {
           echo $error;
           echo "<br>";
       }
       echo "</div>";
    } ?>
<div class="text-center">
    <h3>Please Log-in</h3>
    <form role="form" class="form-horizontal" action="" method="post">
        <div class="form-group">
            <label for="login" class="col-sm-4 control-label">Username or Email</label>
            <div class="col-sm-8">
                <input type="text" id="login" name="login" class="form-control" value="<?php echo Helper::getInput('login') ?>" autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-4 control-label">Password</label>
            <div class="col-sm-8">
                <input type="password" id="password" name="password" class="form-control">
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
                <a class="btn btn-sm btn-white btn-block" href="Registration">Create an account</a>
            </div>
        </div>

    </form>
</div>