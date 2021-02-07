<?php
ob_start();
session_start();
error_reporting(false);

include './admin/manage/User.php';
include './admin/manage/SingletonDB.php';
include './admin/manage/DBOperations.php';

$dbOperations = new DBOperations();
$db = SingletonDB::getInstance();

if (isset($_SESSION['user_username'])) {
  $userQuery = $db->prepare("SELECT * FROM user WHERE user_username=:user_username");
  $userQuery->execute(array(
    'user_username' => $_SESSION['user_username']
  ));
  $getUser = $userQuery->fetch(PDO::FETCH_ASSOC);
}
$postQuery = $db->prepare("SELECT * FROM post ORDER BY post_time DESC");
$postQuery->execute();

$user = new User($getUser['user_id'], $getUser['user_email'], $getUser['user_username'], $getUser['user_password']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Tuxer</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <img src="./images/NewTux.svg" width="30" height="30" class="d-inline-block align-top" alt="">
        Tuxer
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
          <?php if (isset($_SESSION['user_username'])) { ?>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="profile.php?user_id=<?php echo $user->id; ?>">Profile</a>
            </li>
          <?php } ?>
        </ul>
        <?php if (isset($_SESSION['user_username'])) { ?>
          <span class="navbar-text">
            <?php echo "Hello " . $getUser['user_username']; ?>
          </span>
          <a href="logout.php"><button class="btn btn-sm btn-dark my-2 my-sm-0 mr-2 ml-3">Logout</button></a>
        <?php } else { ?>
          <a href="./login.php"><button class="btn btn-sm btn-outline-dark my-2 my-sm-0 mr-2">Sign In</button></a>
          <a href="./register.php"><button class="btn btn-sm btn-outline-dark my-2 my-sm-0" type="submit">Sign Up</button></a>
        <?php } ?>
      </div>
    </div>
  </nav>