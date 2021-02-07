<?php include 'header.php' ?>

<?php

$user = $dbOperations->getUser($_GET['user_id'], $db);

?>


<div class="container">
    <div class="row justify-content-center h-100 mt-5">
        <div class="col-md-4">
            <form method="POST" action="./admin/manage/funcs.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <input type="hidden" name="user_id" class="form-control" value="<?php echo $user->id; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Profile Picture</label>
                    <input type="file" name="user_image" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" disabled name="user_email" class="form-control" value="<?php echo $user->email; ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" disabled name="user_username" class="form-control" value="<?php echo $user->username; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="user_passwordone" required class="form-control">
                </div>
                <div class=" mb-3">
                    <label class="form-label">Re-Password</label>
                    <input type="password" name="user_passwordtwo" required class="form-control">
                </div>
                <button type="submit" name="userUpdate" class="btn btn-dark">Update</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php' ?>