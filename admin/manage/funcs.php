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

if (isset($_POST['adminlogin'])) {

    $admin_username = $_POST['admin_username'];
    $admin_password = md5($_POST['admin_password']);

    $adminQuery = $db->prepare("SELECT * FROM admin WHERE admin_username=:username and admin_password=:password");
    $adminQuery->execute(array(
        'username' => $admin_username,
        'password' => $admin_password
    ));

    $count = $adminQuery->rowCount();

    if ($count == 1) {
        $_SESSION['admin_username'] = $admin_username;
        header("Location:../production/index.php");
        exit;
    } else {
        header("Location:../production/login.php?status=false");
        exit;
    }
}

if (isset($_POST['addcategory'])) {

    $addcategory = $db->prepare("INSERT INTO category SET
        category_name=:category_name
    ");

    $add = $addcategory->execute(array(
        'category_name' => $_POST['category_name']
    ));

    if ($add) {
        header("Location:../production/add_category.php?status=true");
    } else {
        header("Location:../production/add_category.php?status=false");
    }
}

if (isset($_GET['category_id'])) {

    $deleteCategory = $db->prepare("DELETE FROM category WHERE category_id=:category_id");
    $deleteCategory->execute(array(
        'category_id' => $_GET['category_id']
    ));

    if ($deleteCategory) {
        header("Location:../production/categories.php?status=true");
    } else {
        header("Location:../production/categories.php?status=false");
    }
}

if (isset($_POST['updatecategory'])) {

    $category_id = $_POST['category_id'];

    $updateCategory = $db->prepare("UPDATE category SET category_name=:category_name WHERE category_id=:category_id");
    $updateCategory->execute(array(
        'category_name' => $_POST['category_name'],
        'category_id' => $_POST['category_id']
    ));

    if ($updateCategory) {
        header("Location:../production/edit_category.php?status=true&category_id=$category_id");
    } else {
        header("Location:../production/edit_category.php?status=false");
    }
}

if (isset($_POST['addproduct'])) {

    $imageName = ($_FILES["product_image"]["name"]);
    $imageData = (file_get_contents($_FILES["product_image"]["tmp_name"]));
    $imageType = ($_FILES["product_image"]["type"]);


    $addProduct = $db->prepare("INSERT INTO product SET
        product_image=:product_image,
        product_name=:product_name,
        product_category=:product_category,
        product_price=:product_price
    ");

    $add = $addProduct->execute(array(
        'product_image' => $imageData,
        'product_name' => $_POST['product_name'],
        'product_category' => $_POST['product_category'],
        'product_price' => $_POST['product_price']
    ));

    if ($add) {
        header("Location:../production/add_product.php?status=true");
    } else {
        header("Location:../production/add_product.php?status=false");
    }
}

if (isset($_GET['product_id'])) {

    $deleteProduct = $db->prepare("DELETE FROM product WHERE product_id=:product_id");
    $deleteProduct->execute(array(
        'product_id' => $_GET['product_id']
    ));

    if ($deleteProduct) {
        header("Location:../production/products.php?status=true");
    } else {
        header("Location:../production/products.php?status=false");
    }
}

if (isset($_POST['updateproduct'])) {

    $imageName = ($_FILES["product_image"]["name"]);
    $imageData = (file_get_contents($_FILES["product_image"]["tmp_name"]));
    $imageType = ($_FILES["product_image"]["type"]);

    $product_id = $_POST['product_id'];

    $updateProduct = $db->prepare("UPDATE product SET 
        product_image=:product_image,
        product_name=:product_name,
        product_category=:product_category,
        product_price=:product_price
        WHERE product_id = $product_id
    ");

    $updateProduct->execute(array(
        'product_image' => $imageData,
        'product_name' => $_POST['product_name'],
        'product_category' => $_POST['product_category'],
        'product_price' => $_POST['product_price']
    ));

    if ($updateProduct) {
        header("Location:../production/edit_product.php?status=true&product_id=$product_id");
    } else {
        header("Location:../production/edit_product.php?status=false");
    }
}
if (isset($_POST['userlogin'])) {

    $user_password = md5($_POST['user_password']);

    $userQuery = $db->prepare("SELECT * FROM user WHERE user_email=:user_email and user_password=:user_password");
    $userQuery->execute(array(
        'user_email' => $_POST['user_email'],
        'user_password' => $user_password
    ));

    $count = $userQuery->rowCount();

    if ($count == 1) {
        $_SESSION['user_email'] = $_POST['user_email'];
        header("Location:../../index.php?login=success");
        exit;
    } else {
        header("Location:../../index.php?login=false");
    }
}


if (isset($_POST['addcart'])) {

    $addChart = $db->prepare("INSERT INTO cart SET 
    product_id=:product_id,
    user_id=:user_id
    ");

    $add = $addChart->execute(array(
        'product_id' => $_POST['product_id'],
        'user_id' => $_POST['user_id']
    ));

    if ($add) {
        header("Location:../../cart.php?status=true");
    } else {
        header("Location:../../cart.php?status=false");
    }
}

if (isset($_POST['pay'])) {

    $deleteCart = $db->prepare("DELETE FROM cart WHERE user_id=:user_id");
    $deleteCart->execute(array(
        'user_id' => $_POST['user_id']
    ));

    if ($deleteCart) {
        header("Location:../../cart.php?payment=success");
    } else {
        header("Location:../../cart.php?payment=false");
    }
}
