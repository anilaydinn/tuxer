<?php
ob_start();
session_start();

require_once 'SingletonDB.php';
require_once 'DBOperations.php';
require_once 'User.php';
require_once 'Post.php';

$db = SingletonDB::getInstance();
$dbOperations = new DBOperations();

if (isset($_POST['userSıgnUp'])) {
    $user = new User($_POST['user_email'], $_POST['user_username'], $_POST['user_passwordone']);
    $dbOperations->registerUser($user, $db, $_POST['user_passwordone'], $_POST['user_passwordtwo']);
}

if (isset($_POST['userSıgnIn'])) {
    $user = new User($_POST['user_username'], $_POST['user_password']);
    $dbOperations->loginUser($user, $db);
}

if (isset($_POST['sendPost'])) {
    $post = new Post($_POST['user_id'], $_POST['post_text']);
    $dbOperations->sendPost($post, $db);
}

if (isset($_POST['userUpdate'])) {

    $imageName = ($_FILES["user_image"]["name"]);
    $imageData = (file_get_contents($_FILES["user_image"]["tmp_name"]));
    $imageType = ($_FILES["user_image"]["type"]);

    $user_id = $_POST['user_id'];

    if ($pw1 == $pw2) {

        $updateUser = $db->prepare("UPDATE user SET 
            user_image=:user_image,
            user_password=:user_password
            WHERE user_id = $user_id
        ");

        $updateUser->execute(array(
            'user_image' => $imageData,
            'user_password' => md5($_POST['user_passwordone'])
        ));

        if ($updateUser) {
            header("Location:../../profile.php?status=true&user_id=$user_id");
        } else {
            header("Location:../../profile.php?status=fale&user_id=$user_id");
        }
    }
}
