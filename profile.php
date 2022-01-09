<?php
// session_start();
// echo 'name :'.$_SESSION['name'].'<br>';
// echo 'email :'.$_SESSION['email'].'<br>';
// echo 'Address :'.$_SESSION['address'].'<br>';
// echo 'gender :'. $_SESSION['gender'].'<br>';
// echo $_COOKIE['name'].'<br>';
// echo $_COOKIE['email'].'<br>';
// echo $_COOKIE['address'].'<br>';
// echo $_COOKIE['gender'].'<br>';
$myfile = fopen("test.txt", "r") or die("Unable to open file!");
while(!feof($myfile)) {
  echo fgets($myfile) . "<br>";
}
fclose($myfile);







?>