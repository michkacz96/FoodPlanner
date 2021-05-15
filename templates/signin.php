<?php
    require_once 'includes/header.php';
?>
<main class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
    <h3>Sign in</h3>
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <?php 
                if(isset($_GET['error'])){
                    if($_GET['error'] == 'nouser'){
                        echo '<div class="alert alert-danger">No user in database!</div>';
                    }
                    if($_GET['error'] == 'wrongpwd'){
                        echo '<div class="alert alert-danger">Wrong password!</div>';
                    }
                }
            ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="uid">E-mail address or username</label>
                    <input class="form-control" type="text" name="uid" id="uid">
                </div>
                <div class="form-group">
                    <label for="pwd">Password</label>
                    <input class="form-control" type="password" name="pwd" id="pwd">
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block" name="signin">Sign in!</button>
            </form>
            <div class="text-left">
                <a href="signup.php">Dont't have an account? Sign up.</a><br>
            </div>
        </div>
        <div class="col-3"></div>
    </div>
</main>

<?php
    require_once 'includes/footer.php';
?>