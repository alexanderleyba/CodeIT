
<?php 
    if(isset($data['error'])){
       echo "<div class='alert alert-danger text-center' role='alert'>";
       foreach ($data['error'] as $error) {
           echo $error;
           echo "<br>";
       }
       echo "</div>";
    } ?>

<form class="form-horizontal" role="form" method="POST" action="">
    <h2>Registration </h2>
    <div class="form-group">
        <label for="email" class="col-sm-3 control-label">Email</label>
        <div class="col-sm-9">
            <input type="text" id="email" name="email" class="form-control" autofocus value="<?php echo Helper::getInput('email')?>">
        </div>
    </div>
    <div class="form-group">
        <label for="username" class="col-sm-3 control-label">Username</label>
        <div class="col-sm-9">
            <input type="text" id="username" name="username" class="form-control" value="<?php echo Helper::getInput('username')?>">
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-3 control-label">Your Name</label>
        <div class="col-sm-9">
            <input type="text" id="name" name="name" class="form-control" value="<?php echo Helper::getInput('name') ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="DOB" class="col-sm-3 control-label">Date of Birth</label>
        <div class="col-sm-9">
            <input type="date" id="DOB" name="DOB"  class="form-control" value="<?php echo Helper::getInput('DOB') ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="country" class="col-sm-3 control-label">Country</label>
        <div class="col-sm-9">
            <select id="country" name="country" class="form-control">
                <?php 
                    echo "<option value=''> </option>";
                        foreach ($data['countries'] as $country){

                            if(Helper::getInput('country') === $country->Name){

                                echo "<option selected='selected' value='$country->Name'>$country->Name</option>";

                            }else
                            {

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
