<?php
namespace Triumph;

/**
 * C.reate, R.ead, U.pdate, and D.elete engine used by Triumph, powered by Prosper
 */ 
abstract class CRUD {  
  
  /**
   * Inserts a record into a database table
   * @param string $table Table to insert the record into
   * @param array $values Values to insert into the table
   */           
  static function insert($table, $values) {
    $sql = \Prosper\Query::insert()
                         ->into($table)
                         ->values($values);
    return $sql;
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
    return $sql;
  }
  
  /**
   * Check for existence of a record in a database table
   * @param string $table Table to check in
   * @param mixed $id Primary Key to look for
   * @param string $col [optional] Name of the Primary Key Column, defaults to 'id'
   */              
  static function exists($table, $id, $col = 'id') {
    return self::load($table, $id, $col);    
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
    return $sql;
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
    return $sql;
  }
  
}


?>