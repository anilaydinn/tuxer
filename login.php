<?php include("header.php"); ?>

<div class="container">
    <div class="row justify-content-center h-100 mt-5">
        <div class="col-md-4">
            <form method="POST" action="./admin/manage/funcs.php">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="user_username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="user_password" class="form-control" required>
                </div>
                <button type="submit" name="userSıgnIn" class="btn btn-dark">Login</button>
            </form>
        </div>
    </div>
</div>

<?php include("footer.php") ?>