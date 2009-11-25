<?php
  require_once 'config.php';
  
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $todo = new Todo($_POST['id']);
    $todo->title = $_POST['title'];
    $todo->save();
    
    header("Location: index.php");
  } else {
    include_once 'header.php';
    
    $todo = new Todo($_GET['id']);
    display_form("edit.php", "edit", $todo->title, $todo->id);
    
    include_once 'footer.php';
  }
  
?>