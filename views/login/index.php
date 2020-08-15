<?php require_once ROOT . "/views/layout/header.php";
    if (isset($message) && !empty($message)) { ?>
    <div class="alert alert-danger" role="alert">
        <?=$message?>
    </div>
<?php } ?>
<div class="row">
    <div class="col-4 offset-4">
        <!-- Login Form -->
        <form action="#" method="post">
            <div class="form-group">
                <label for="username">Username*</label>
                <input type="text" id="username" class="form-control" name="username" placeholder="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password*</label>
                <input type="password" id="password" class="form-control" name="password" placeholder="password" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="login" value="Log In">
            </div>
        </form>


    </div>
</div>


<?php require_once ROOT . "/views/layout/footer.php"; ?>
