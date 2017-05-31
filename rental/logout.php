<?php 
//this function created by Sigit Dwi Prasetyo
//More information visit www.sixghakreasi.com / 0818956973
?>
<?php
session_start();
unset($_SESSION["username"]);
unset($_SESSION["level"]);
// redirect

      header("Location:form_login.php");
      exit();
?>