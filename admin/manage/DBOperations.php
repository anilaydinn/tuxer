<?php

class DBOperations
{
    function registerUser(User $user, PDO $db, $pw1, $pw2)
    {

        $emailUniqueQuery = $db->prepare("SELECT * FROM user WHERE user_email=:user_email");
        $emailUniqueQuery->execute(array(
            'user_email' => $user->email
        ));
        $number = $emailUniqueQuery->rowCount();

        $usernameUniqueQuery = $db->prepare("SELECT * FROM user WHERE user_username=:user_username");
        $usernameUniqueQuery->execute(array(
            'user_username' => $user->username
        ));
        $number = $usernameUniqueQuery->rowCount();

        if ($number >= 1) {
            header("Location:../../index.php?status=alreadyRegistered");
            exit;
        }

        if ($pw1 == $pw2 && $number < 1) {

            $addUser = $db->prepare("INSERT INTO user SET
            user_email=:user_email,
            user_username=:user_username,
            user_password=:user_password
        ");

            $add = $addUser->execute(array(
                'user_email' => $user->email,
                'user_username' => $user->username,
                'user_password' => md5($user->password)
            ));
            if ($add) {
                header("Location:../../index.php?status=registerOK");
                exit;
            } else {
                header("Location:../../index.php?status=registerNO");
                exit;
            }
        }
    }

    function loginUser(User $user, PDO $db)
    {
        $user_password = md5($user->password);

        $userQuery = $db->prepare("SELECT * FROM user WHERE user_username=:user_username and user_password=:user_password");
        $userQuery->execute(array(
            'user_username' => $user->username,
            'user_password' => $user_password
        ));

        $count = $userQuery->rowCount();

        if ($count == 1) {
            $_SESSION['user_username'] = $user->username;
            header("Location:../../index.php?login=success");
            exit;
        } else {
            header("Location:../../index.php?login=false");
            exit;
        }
    }

    function sendPost(Post $post, PDO $db)
    {
        $addPost = $db->prepare("INSERT INTO post SET
        user_id=:user_id,
        post_text=:post_text
        ");

        $add = $addPost->execute(array(
            'user_id' => $post->user_id,
            'post_text' => $post->text
        ));

        if ($add) {
            header("Location:../../index.php?status=success");
        } else {
            header("Location:../../index.php?status=false");
        }
    }

    function getUser($id, PDO $db)
    {
        $userQuery = $db->prepare("SELECT * FROM user WHERE user_id=:user_id");
        $userQuery->execute(array(
            'user_id' => $id
        ));
        $getUser = $userQuery->fetch(PDO::FETCH_ASSOC);

        $user = new User($getUser['user_id'], $getUser['user_image'], $getUser['user_email'], $getUser['user_username'], $getUser['user_password']);

        return $user;
    }

    function getPostCount($id, PDO $db)
    {
        $postCountQuery = $db->prepare("SELECT * FROM post WHERE user_id=:user_id");
        $postCountQuery->execute(array(
            'user_id' => $id
        ));
        $count = $postCountQuery->rowCount();

        return $count;
    }

    function updateUser(User $user, PDO $db, $pw1, $pw2)
    {
    }
}
