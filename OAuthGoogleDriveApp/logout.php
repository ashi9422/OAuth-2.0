<?
	  //destroy session and redirect to index.php
	  session_destroy();
      header('Location: index.php');
      exit();
?>