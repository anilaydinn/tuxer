<?php include 'header.php' ?>

<?php

$user = $dbOperations->getUser($_GET['user_id'], $db);
$postCount = $dbOperations->getPostCount($_GET['user_id'], $db);

$userPostsQuery = $db->prepare("SELECT * FROM post WHERE user_id=:user_id ORDER BY post_time DESC");
$userPostsQuery->execute(array(
    'user_id' => $_GET['user_id']
));
?>
<div class="row px-4 mt-4">
    <div class="container">
        <div class="col-md-12">
            <!-- Profile widget -->
            <div class="bg-dark shadow rounded overflow-hidden">
                <div class="px-4 pt-0 pb-4 cover">
                    <div class="media align-items-end profile-head">
                        <div class="profile mr-3"><img src="data:image/png;base64, <?php echo base64_encode($user->image); ?>" alt="..." width="130" class="rounded mb-2 mt-3 img-thumbnail"><a href="edit_profile.php?user_id=<?php echo $_GET['user_id']; ?>" class="btn btn-outline-light btn-sm btn-block">Edit profile</a></div>
                        <div class="media-body mb-5 text-white">
                            <h4 class="mt-0 mb-5"><?php echo $user->username; ?></h4>
                        </div>
                    </div>
                </div>
                <div class="bg-light p-4 d-flex justify-content-end text-center">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <h5 class="font-weight-bold mb-0 d-block"><?php echo $postCount; ?></h5><small class="text-muted"> <i class="fas fa-image mr-1"></i>Posts</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


</div>
<?php while ($getUserPosts = $userPostsQuery->fetch(PDO::FETCH_ASSOC)) { ?>
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header"><?php echo $dbOperations->getUser($getUserPosts['user_id'], $db)->username; ?></div>
                    <div class="card-body text-dark">
                        <p class="card-text"><?php echo $getUserPosts['post_text'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php include 'footer.php' ?>