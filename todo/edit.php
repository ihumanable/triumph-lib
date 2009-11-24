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
?>

 <h3>edit todo</h3>
		
 <form class="todo" action="edit.php" method="post">
		<input type="hidden" name="id" value="<?php echo $todo->id ?>" />
		<div class="item"><input type="text" name="title" value="<?php echo $todo->title ?>" /></div>		
		<div class="controls">
			<input type="submit" value="Edit" />
			<button onclick="window.location.href='index.php'; return false;">Cancel</button>
		</div>			
	</form>

<?php	
		
		include_once 'footer.php';
	}

?>