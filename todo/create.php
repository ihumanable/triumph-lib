<?php
  require_once 'config.php';
  
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $todo = new Todo();
    $todo->title = $_POST['title'];
    $todo->save();
    
    header("Location: index.php");
  } else {
    include_once 'header.php';
    
    display_form("create.php", "create");
  
    include_once 'footer.php';
  }
  
?>