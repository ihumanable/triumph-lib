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
		
?>

		<h3>delete todo</h3>
		
		<form class='todo' action='delete.php' method='post'>
			<input type="hidden" name="id" value="<?php echo $todo->id ?>" />
			<div class="item">
				Delete "<?php echo $todo->title; ?>" ?
			</div>
			<div class="controls">
				<input type="submit" value="Confirm" />
				<button onclick="window.location.href='index.php'; return false;">Cancel</button>
			</div>
		</form>

<?php

		include_once 'footer.php';
	}
		
?>