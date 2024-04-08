<?php

session_start();

require_once './../inc/validation.php';
require_once './../inc/conn.php';

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

  if (requireInput($password)) {
    $errors[] = 'Password is required';
  } elseif (minInput($password, 8)) {
    $errors[] = 'Password must be greater than 8';
  } elseif (maxInput($password, 20)) {
    $errors[] = 'Password must be smaller than 20';
  }

  if (requireInput($errors)) {

    // If no validation errors, proceed to save the validated data to the database

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO `users`(`user_name`, `user_email`, `user_password`) VALUES ('$name', '$email', '$hashed_password')";

    $resutl = mysqli_query($conn, $sql);

    if ($result) {

      $_SESSION['success'] = 'Added Your Data Successfully';

      header("Location: ./../add.php");
      exit;
      
    }

  } else {

    // Display errors to the user

    $_SESSION['error'] = $errors;

    header("Location: ./../add.php");
    exit;

  }
} else {
  header("Location: ./../add.php");
  exit;
}