<?php

class Todo extends Triumph\Base {
  protected static $_table_ = "todo";
  protected static $_exclude_ = array('timestamp');
  public $title;
  public $timestamp;
}

?>