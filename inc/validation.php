<?php

function requireInput($input)
{
  return empty($input);
}
function receiveInput($input)
{
  // Trim the input, remove slashes, escape HTML special characters
  return htmlspecialchars(htmlentities(stripslashes(trim($input))));
}
function validateEmail($email)
{
  // Return false if email isn't valid
  return !filter_var($email, FILTER_VALIDATE_EMAIL);
}
function minInput($input, $limit)
{
  return strlen($input) < $limit;
}
function maxInput($input, $limit)
{
  return strlen($input) > $limit;
}