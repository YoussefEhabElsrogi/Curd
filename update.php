<?php include './inc/header.php' ?>
<h1 class="text-center col-12 bg-info py-3 text-white my-2">Update Info About User</h1>

<?php

require_once './inc/validation.php';
require_once './inc/conn.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

  foreach ($_POST as $key => $value) {

    $$key = receiveInput($value);

  }

  if (requireInput($name)) {
    $errors[] = 'Name is required';
  } elseif (minInput($name, 3)) {
    $errors[] = 'Name must be greater thane 3';
  } elseif (maxInput($name, 15)) {
    $errors[] = 'Name must be smaller than 15';
  }

  if (requireInput($email)) {
    $errors[] = 'Email is required';
  } elseif (validateEmail($email)) {
    $errors[] = 'This is not email please enter the valid email';
  }


  if (requireInput($errors)) {

    // If no validation errors, proceed to save the validated data to the database

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE `users` SET `user_name` = '$name', `user_email` = '$email', `user_password` = '$hashed_password' WHERE `user_id` = $id";

    $result = mysqli_query($conn, $sql);

    if ($result) {

      $_SESSION['success'] = 'Updated Your Data Successfully';

      ?>

      <h5 class="alert alert-success text-center"><?php if (isset($_SESSION['success'])):
        echo $_SESSION['success'];
      endif; ?>
      </h5>

      <?php
      header("Refresh:3;url=index.php");
      exit;
    }

  } else {

    // Display errors to the user

    $_SESSION['error'] = $errors;

    ?>


    <a href="javascript:history.go(-1)" class="btn btn-primary">Go Back</a>

    <?php

    foreach ($_SESSION['error'] as $error) {
      ?>
      <h5 class="alert alert-danger text-center mt-2"><?php echo $error ?>:
        <?php
    }
  }
} else {
  header("Location: index.php");
  exit;
}