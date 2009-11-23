<?php
require_once 'config.php';

$todo = new Todo();

echo '<pre>';
print_r($todo);
echo '</pre><hr><pre>';
print_r($todo->as_array());
echo '</pre><hr><pre>';
print_r($todo->as_array(false));
echo '</pre><hr><pre>';
echo $todo->save();
echo '</pre><hr><pre>';
echo $todo->load(1);

$todo->title = "test";

echo '</pre><hr><pre>';
echo $todo->save();
echo '</pre><hr><pre>';
echo $todo->delete();
echo '</pre>';

?>