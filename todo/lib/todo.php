<?php

class Todo extends Triumph\Base {
  protected static $_table_ = "todo";
  protected static $_exclude_ = array('timestamp');
  public $title;
  public $timestamp;
  
  function display() {
    echo "<div class=\"todo\">\n";
      echo "\t<div class=\"item\">#{$this->id} - {$this->title} @ " . time_ago(Prosper\Query::mktime($this->timestamp)) . "</div>\n";
		  echo "\t<div class=\"controls\"><a href=\"edit.php?id={$this->id}\">edit</a>  |  <a href=\"delete.php?id={$this->id}\">delete</a></div>\n";
	  echo "</div>\n";	
  }
  
}

?>