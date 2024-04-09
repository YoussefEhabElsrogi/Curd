<?php

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {

  header("Location: index.php");
  exit;

}
