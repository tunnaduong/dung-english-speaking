<?php

/**
 * Trả về instance của Request
 *
 * @return App\Core\Request
 */
function request(): App\Core\Request
{
  return App\Core\Request::instance();
}

function getLastTwoWords($name)
{
  $parts = explode(' ', trim($name)); // Split by space
  $count = count($parts);

  if ($count >= 2) {
    return $parts[$count - 2] . ' ' . $parts[$count - 1]; // Get last two words
  }
  return $name; // Return full name if it has less than 2 words
}
