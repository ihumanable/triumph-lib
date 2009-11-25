<?php
  require_once 'config.php';
  
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Delete the todo and redirect
    $todo = new Todo($_POST['id']);
    $todo->delete();
    
    header("Location: index.php");
  } else {
    include_once 'header.php';
    
    $todo = new Todo($_GET['id']);
    display_form("delete.php", "delete", "Delete {$todo->title}?", false);
    
    include_once 'footer.php';
  }
  
?>