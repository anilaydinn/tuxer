<?php include("header.php") ?>
<div class="container">
    <?php if (isset($_SESSION['user_username'])) { ?>
        <div class="row justify-content-center mt-4">
            <div class="col-md-12">
                <form action="./admin/manage/funcs.php" method="POST">
                    <input type="hidden" name="user_id" class="form-control" value="<?php echo $user->id ?>">
                    <div>
                        <label class="form-label">What's happening ?</label>
                        <textarea class="form-control" name="post_text" rows="3" required></textarea>
                    </div>
                    <button type="submit" name="sendPost" class="btn btn-dark mt-2">Send</button>
                </form>
            </div>
        </div>
    <?php } ?>

    <?php while ($getPosts = $postQuery->fetch(PDO::FETCH_ASSOC)) { ?>
        <div class="row justify-content-center mt-3">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header"><?php echo $dbOperations->getUser($getPosts['user_id'], $db)->username; ?></div>
                    <div class="card-body text-dark">
                        <p class="card-text"><?php echo $getPosts['post_text']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<?php include("footer.php") ?>