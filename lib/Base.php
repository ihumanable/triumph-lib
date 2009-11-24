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
   * Retrieve a list of the entities
   * @param string $order [optional] an ordering clause    
   * @return array entries All table entries
   */     
  static function all($order = null) {
    return self::from_arrays(CRUD::all(self::table(), $order));
  }
  
  /**
   * Finds entities based off of a where clause and optional ordering clause
   * @param string $where where clause
   * @param string $order [optional] an ordering clause
   * @return array entries Found table entries
   */                 
  static function find($where, $order = null) {
    return self::from_arrays(CRUD::find(self::table(), $where, $order));
  }
  
  /**
   * Turns a multi-dimensional result array into an array of entities
   * @params array $entities Multi-dimensional array of results
   * @returns array Array of entitis instances
   * @see Triumph\Base#from_array($values)
   */              
  static function from_arrays($entities) {
    if(is_array($entities)) {
      foreach($entities as $entity) {
        $result[] = static::from_array($entity);
      }
    } else {
      $result = array();
    }
    return $result;
  }
  
  /**
   * Create an entity from an array
   * @param array $values Associative array to use to populate
   * @return mixed new entity instance
   * @see Triumph\Base#populate($values)         
   */     
  static function from_array($values) {
    $class = get_called_class();
    $result = new $class();
    $result->populate($values);
    return $result;
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
      $this->update();
    } else {
      $this->insert();
    }  
  }
  
  /**
   * Inserts a new record
   * @see Triumph\CRUD::insert($table, $values)
   */        
  function insert() {
    $this->id = CRUD::insert(self::table(), $this->as_array());
  }
  
  /**
   * Updates an existing record
   * @see Triumph\CRUD::update($table, $values, $id, $col)
   */        
  function update() {
    CRUD::update(self::table(), $this->as_array(), $this->id);
  }
  
  /**
   * Loads a record from the database
   * @see Triumph\CRUD::load($table, $id, $col)
   */        
  function load($id = null) {
    $this->id($id);
    
    if($this->id) {
      $result = CRUD::load(self::table(), $this->id);
      $this->populate($result[0]);
    }
  }
  
  /**
   * Deletes a record from the database
   * @see Triumph\CRUD::delete($table, $id, $col)
   */        
  function delete($id = null) {
    $this->id($id);
    
    if($this->id) {
      CRUD::delete(self::table(), $this->id);
    }
  }
  
  /**
   * Populates an objects properties from an associative array
   * @param array $values The array to populate with
   */        
  function populate($values) {
    foreach($values as $key => $value) {
      $this->$key = $value;
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