<?php include ('inc/header.php'); ?>
<?php require_once './inc/conn.php'; ?>
<?php require_once './checkId.php' ?>

<?php


$id = $_GET['id'];

$sql = "SELECT * FROM `users` WHERE `user_id` = '$id' LIMIT 1";

$result = mysqli_query($conn, $sql);

$check = mysqli_num_rows($result);

if (!$check) {
  header("Location: index.php");
  exit;
}

$sql2 = "DELETE FROM `users` WHERE `user_id` = '$id'";
mysqli_query($conn, $sql2);


?>
<h1 class="text-center col-12 bg-danger py-3 text-white my-2">User Have Been Deleted</h1>
<?php header("Refresh:3;url=index.php"); ?>

<?php include ('inc/footer.php'); ?>