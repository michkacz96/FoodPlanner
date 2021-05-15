<?php
    require_once 'includes/header.php';
?>
<main class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
    <div class="row">
        <div class="col-3">
        </div>
        
        <div class="col-6">
            <h3>Sign up</h3>
            <form action="" method="post">
                <div class="form-group">
                    <label for="uid">Username</label>
                    <input class="form-control" type="text" name="uid" id="uid">
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input class="form-control" type="email" name="email" id="email">
                </div>
                <div class="form-group">
                    <label for="pwd1">Password</label>
                    <input class="form-control" type="password" name="pwd1" id="pwd1">
                </div>
                <div class="form-group">
                    <label for="pwd2">Repeat password</label>
                    <input class="form-control" type="password" name="pwd2" id="pwd2">
                </div>
                <button type="submit" class="btn btn-primary btn-lg" name="signup">Sign up!</button>
            </form>
            <a href="signin.php">Already a member? Sign in.</a>
        </div>

        <div class="col-3">
        </div>
    </div> <!-- row -->
</main>

<?php
    require_once 'includes/footer.php';
?>