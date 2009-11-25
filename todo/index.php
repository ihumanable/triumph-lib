<?php
  require_once 'config.php';
  
  include_once 'header.php';
?>

<div class="todo" style="text-align:right;">
  <form action="index.php" method="post">
    <input type="text" name="search" id="search" <?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo "value=\"{$_POST['search']}\""; ?> />
    <input type="submit" value="search" />
  </form>
</div>

<?php

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Go Looking
    $todos = Todo::find("title like '{$_POST['search']}%'");
  } else {
    //Pull out all of the todo items, stable order
    $todos = Todo::all('id');
  }
  
  if(is_array($todos)) {
    foreach($todos as $todo) {
      $todo->display();
    }
  }
?>
  <div class="todo">
    <div class="item">
      <a href="create.php">
        <img src="img/create.png" alt="create todo"/> <div id="create-label">create todo</div>
      </a>
    </div>
  </div>
<?php
  
  include_once 'footer.php';
  
?>