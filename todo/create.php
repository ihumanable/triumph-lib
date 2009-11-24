<?php
	require_once 'config.php';
	
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$todo = new Todo();
    $todo->title = $_POST['title'];
    $todo->save();
    
		header("Location: index.php");
	} else {
		include_once 'header.php';
?>


		<h3>create todo</h3>
		
		<form class="todo" action="create.php" method="post">
			<div class="item">
				<input type="text" name="title" value="" />
			</div>
			<div class="controls">
				<input type="submit" value="Create" />
				<button onclick="window.location.href='index.php'; return false;">Cancel</button>
			</div>			
		</form>
		

<?php		
		include_once 'footer.php';
	}


?>