<?php include("header.php"); ?>

<div class="container">
    <div class="row justify-content-center h-100 mt-5">
        <div class="col-md-4">
            <form method="POST" action="./admin/manage/funcs.php">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="user_email" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" name="user_username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="user_passwordone" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                    <label class="form-label">Re-Password</label>
                    <input type="password" name="user_passwordtwo" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" name="userSıgnUp" class="btn btn-dark">Register</button>
            </form>
        </div>
    </div>
</div>

<?php include("footer.php") ?>