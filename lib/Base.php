<?php
namespace Triumph;
require_once 'CRUD.php';

/**
 * Triumph base, any class that extends this class will inherit auto-CRUD 
 * functionality
 */  
class Base {
  
  /**
   * Unique Identifier (Primary Key)
   */     
  public $id = null;
  
  /**
   * Table name that backs the class
   */     
  protected static $_table_;
  
  /**
   * Any fields that shouldn't be serialized
   */     
  protected static $_exclude_ = array();

  /**
   * @return string tablename
   */     
  static function table() {
    return static::$_table_;
  }
  
  /**
   * @return array exclusions
   */     
  static function exclude() {
    $exclude = static::$_exclude_;
    if(is_array($exclude)) {
      return $exclude;
    } else {
      return array($exclude);
    }
  }
  
  /**
   * Constructs a new persistent object
   * @param mixed $id [optional] if passed will attempt to load the object
   * @return new persistent object instance
   */           
  function __construct($id = null) {
    $this->id = null;
    $this->load($id);
  }
  
  /**
   * Sets the id if the argument is not null  
   * @param mixed $id id to set
   */   
  function id($id) {
    if($id) {
      $this->id = $id;
    }
  }
  
  /**
   * Saves the object to the database, intelligently choses whether to update
   * or insert
   */        
  function save() {
    if($this->id) {
      if($this->exists()) {
        $this->update();
      } else {
        $this->insert();
      }
    } else {
      $this->insert();
    }  
  }
  
  /**
   * Inserts a new record
   * @see Triumph\CRUD::insert($table, $values)
   */        
  function insert() {
    return CRUD::insert(self::table(), $this->as_array());
  }
  
  /**
   * Updates an existing record
   * @see Triumph\CRUD::update($table, $values, $id, $col)
   */        
  function update() {
    return CRUD::update(self::table(), $this->as_array(), $this->id);
  }
  
  /**
   * Checks for existence
   * @see Triumph\CRUD::exists($table, $id, $col)
   * @see Triumph\Base::load($id)
   */           
  function exists($id = null) {
    $this->id($id);
  
    if($this->id) {
      return $this->load();
    } else {
      return false;
    }      
  }
  
  /**
   * Loads a record from the database
   * @see Triumph\CRUD::load($table, $id, $col)
   */        
  function load($id = null) {
    $this->id($id);
    
    if($this->id) {
      return CRUD::load(self::table(), $this->id);
    }
  }
  
  /**
   * Deletes a record from the database
   * @see Triumph\CRUD::delete($table, $id, $col)
   */        
  function delete($id = null) {
    $this->id($id);
    
    if($this->id) {
      return CRUD::delete(self::table(), $this->id);
    }
  }
  
  /**
   * Translates the instance into an associative array, respecting exclusions
   * @param boolean $with_id [optional] whether or not to include the id field, defaults to false
   * @return array Associative array representation of instance
   */            
  function as_array($with_id = false) {
    $exclude = self::exclude();
    foreach($this as $key => $value) {
      if(!$with_id && $key == 'id') {
        continue;
      }
      $result[$key] = $value;
    }
    foreach($exclude as $exclusion) {
      unset($result[$exclusion]);
    }
    return $result;
  }
  
}


?>