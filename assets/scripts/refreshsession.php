<?php
  session_start();

  // Session opnieuw aanmaken
  if (isset($_SESSION['token'])) { 
    $_SESSION['token'] = $_SESSION['token'];
  }
?>