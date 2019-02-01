<?php

function get_file_name($filePath){
  preg_match("/[^\/]+$/", $filePath, $matches);
  return $matches[0];
}
