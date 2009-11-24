<?php
namespace Triumph;

/**
 * C.reate, R.ead, U.pdate, and D.elete engine used by Triumph, powered by Prosper
 */ 
abstract class CRUD {  
  static $debug = false;
  
  static function execute($sql) {
    if(self::$debug) {
      return $sql->verbose();
    } else {
      return $sql->execute();
    }
  }
  
  /**
   * Lists all entities from a given database table
   * @param string $table Table to pull entities from
   * @param string $order [optional] an ordering clause
   * @return array An array of entities
   */              
  static function all($table, $order = null) {
    $sql = \Prosper\Query::select()
                         ->from($table);
    
    if($order) {
      $sql->order($order);
    }

    return self::execute($sql);                 
  }
  
  /**
   * Finds results for a given where clause
   * @param string $table Table to look in
   * @param string $where Where clause
   * @param string $order [optional] an ordering clause
   * @return array An array of entities
   */                 
  static function find($table, $where, $order = null) {
    $sql = \Prosper\Query::select()
                         ->from($table)
                         ->where($where);
    
    if($order) {
      $sql->order($order);
    }
    
    return self::execute($sql);                     
  }
  
  /**
   * Inserts a record into a database table
   * @param string $table Table to insert the record into
   * @param array $values Values to insert into the table
   */           
  static function insert($table, $values) {
    $sql = \Prosper\Query::insert()
                         ->into($table)
                         ->values($values);
    return self::execute($sql);
  }
  
  /**
   * Updates a record in a database table
   * @param string $table Table to update the record in
   * @param array $values Values to update to
   * @param mixed $id Primary Key of the record to update
   * @param string $col [optional] Name of the Primary Key Column, defaults to 'id'
   */                 
  static function update($table, $values, $id, $col = 'id') {
    $sql = \Prosper\Query::update($table)
                         ->set($values)
                         ->where("$col = ?", $id);
    return self::execute($sql);
  }
  
  /**
   * Check for existence of a record in a database table
   * @param string $table Table to check in
   * @param mixed $id Primary Key to look for
   * @param string $col [optional] Name of the Primary Key Column, defaults to 'id'
   */              
  static function exists($table, $id, $col = 'id') {
    $result = self::load($table, $id, $col);
    return count($result) > 0;    
  }
  
  /**
   * Load a record from a database table
   * @param string $table Table to load from
   * @param mixed $id Primary Key to look for
   * @param string $col [optional] Name of the Primary Key Column, defaults to 'id'
   */              
  static function load($table, $id, $col = 'id') {
    $sql = \Prosper\Query::select()
                         ->from($table)
                         ->where("$col = ?", $id);
    return self::execute($sql);
  }
  
  /**
   * Deletes a record from a database table 
   * @param string $table Table to delete from
   * @param mixed $id Primary Key of the record to delete
   * @param string $col [optional] Name of the Primary Key Column, defaults to 'id'
   */             
  static function delete($table, $id, $col = 'id') {
    $sql = \Prosper\Query::delete()
                         ->from($table)
                         ->where("$col = ?", $id);
    return self::execute($sql);
  }
  
}


?>