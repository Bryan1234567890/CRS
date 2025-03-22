<?php

date_default_timezone_set("Asia/Manila");

class DatabaseObject
{
    // static $database;
    // static public function set_database($database)
    // {
    //     self::$database = $database;
    // }

    // static public function find_by_sql($sql)
    // {
    //     $result = self::$database->query($sql);
    //     $object_array = [];
        
    //     if(!$result)
    //     {
    //         exit($sql);
    //     }
       
    //     if($result)
    //     {
    //         while($record = $result->fetch_assoc())
    //         {  
    //             $object_array[] = static::instatiate($record);
    //         }
    //     }
    //     else
    //     {
    //         return 'no record found';
    //         // return [];
    //     }
        
    //     $result->free();
    //     return $object_array;

    // }

    // static public function find_all($get_sql=false,$offset='')
    // {
    //     $sql = "SELECT * FROM " . static::$table_name . $offset;
    //     $obj_array = static::find_by_sql($sql);
    //     return ($get_sql == false)? $obj_array: $sql;
    // }

    // public function create()
    // {
    //     $attributes = $this -> sanitized_attributes();
    //     $sql = " INSERT INTO " . static::$table_name .   "( ";
    //     $sql .= join (', ', array_keys($attributes));
    //     $sql .= " ) VALUES ( '";
    //     $sql .= join("','", array_values($attributes));
    //     $sql .= "') ";
    //     $result = self::$database ->query($sql);
    //     $response = $this->id = self::$database->insert_id;
    //     return $response;
    // }

    // // TEST SQL 
    // public function create2()
    // {
    //     $attributes = $this -> sanitized_attributes();
    //     $sql = " INSERT INTO " . static::$table_name .   "( ";
    //     $sql .= join (', ', array_keys($attributes));
    //     $sql .= " ) VALUES ( '";
    //     $sql .= join("','", array_values($attributes));
    //     $sql .= "') ";
    //     $result = self::$database ->query($sql);
    //     $response = $this->id = self::$database->insert_id;
        
    //     return $response;
    // }

    // public function leave_create()
    // {
    //     $attributes = $this -> sanitized_attributes();
    //     $sql = " INSERT INTO " . static::$table_name .   "( ";
    //     $sql .= join (', ', array_keys($attributes));
    //     $sql .= " ) VALUES ( '";
    //     $sql .= join("','", array_values($attributes));
    //     $sql .= "') ";
    //     $result = self::$database ->query($sql);
    //     $response = $this->id = self::$database->insert_id;
    //     return $result;
    // }

    // static public function find_by_id($id)
    // {
    //     $sql = " SELECT * FROM  " . static::$table_name . " WHERE " . static::$id_name . "= '" . self::$database->escape_string($id) . "'";
    //     error_log(" leave credit :" . $sql);
    //     $obj_array = static::find_by_sql($sql);
        
    //     return (!empty($obj_array))? array_shift($obj_array): false;
    // }
    
    // static public function find_by_cond_id($id)
    // {
    //     /* returns multiple values */
    //     $sql = " SELECT * FROM  " . strtolower(static::$cond_table) . " WHERE " . static::$cond_condition . " AND " . static::$cond_id_name . "= '" . self::$database->escape_string($id) . "'";
    //     $obj_array = static::find_by_sql($sql);
    
    //     return (!empty($obj_array))? $obj_array: false;
    // }

    // static public function find_by_cond_id2($id, $offset)
    // {
    //     /* returns multiple values */
    //     $sql = " SELECT * FROM  " . static::$cond_table . " WHERE " . static::$cond_condition . " AND " . static::$cond_id_name . "= '" . self::$database->escape_string($id) . "' {$offset}";
    //     $obj_array = static::find_by_sql($sql);
        
    //     return (!empty($obj_array))? $obj_array: false;
    // }

    // static public function find_by_cond_id3($id, $offset)
    // {
    //     /* returns multiple values */
    //     $sql = " SELECT * FROM  " . static::$cond_table . " WHERE " . static::$cond_id_name . "= '" . self::$database->escape_string($id) . "' {$offset} ";
    //     $obj_array = static::find_by_sql($sql);
        
    //     return (!empty($obj_array))? $obj_array: false;
    // }


    // static public function find_by_cond($get_sql='false',$offset='' )
    // {
    //     $sql = " SELECT " . static::$cond_column . " FROM  " . static::$cond_table . " WHERE " . static::$cond_condition . $offset;
    //     $obj_array = static::find_by_sql($sql);
    //     //return $sql;
    //     if($get_sql == false)
    //     {
    //         return (!empty($obj_array))? $obj_array: false;
    //     }
    //     else
    //     {
    //         return $sql;
    //     }
    // }
    // static public function find_by_cond4($offset='')
    // {
    //     $sql = " SELECT " . static::$cond_column . " FROM  " . static::$cond_table . " WHERE " . static::$cond_condition . $offset;
    //     $result = self::$database->query($sql);

    //     $row = $result->fetch_assoc();
    //     // $output = !is_array($row) ? [] : $row;
    //     return (int) $row['points'];
        
    // }
    
    // public static function update($id)
    // {
    //     $attributes = static::$class_obj->sanitized_attributes();
    //     $attribute_pairs = [];

    //     foreach($attributes as $key => $value)
    //     {
    //         $value = urldecode($value);
    //         $attribute_pairs[] = "{$key}='{$value}'";
    //     }

    //     $sql = " UPDATE " . static::$table_name . " SET " ;
    //     $sql .= join(', ', $attribute_pairs);
    //     $sql .= " WHERE " .static::$id_name . "='" . self::$database->escape_string($id) . "' ";
    //     $sql .= " LIMIT 1 ";
        
       
    //     $result = self::$database->query($sql); 
    //     return $result;
    // }

    
    // public static function delete($id)
    // {
    //     $sql = " DELETE FROM " . static::$table_name;
    //     $sql .= " WHERE " . static::$id_name . " = '" . $id . "' LIMIT 1";
    //     $result = self::$database->query($sql);
    //     return $result;
    // }

    // static public function login($uname) 
    // {
    //     $sql = "SELECT * FROM user u Left Join employee e ON u.emp_id = e.emp_id ";
    //     $sql .= "WHERE u.username='" . self::$database->escape_string($uname) . "'";
    //     $obj_array = static::find_by_sql($sql);
        
    //     // return $sql;
    //     return (!empty($obj_array))? array_shift($obj_array): false;
    // } 


    // // ARRAY OPERATION AND SANITATION
    // static protected function instatiate($record)
    // {
    //     $object = new static;
        
    //     foreach($record as $property => $value)
    //     {
    //         if(property_exists($object, $property))
    //         {
    //             $object -> $property = $value;
    //         }
    //     }
    //     return $object;
    // }

    // protected function sanitized_attributes()
    // {
    //     $sanitized = [];

    //     foreach($this->attributes() as $key => $value)
    //     {
    //         $sanitized[$key] = urldecode(self::$database->escape_string($value));
    //     }
    //     return $sanitized;
    // }

    // // public static function attributes()
    // // {    
    // //     $attributes = [];
    // //     foreach(static::$db_columns as $column)
    // //     {
    // //         if($column == 'id'){continue;}
            
    // //         $attributes[$column] = $this->$column;
    // //     }
    // //     return $attributes;
    // // }

    // public static function attributes()
    // {    
    //     $attributes = [];
    //     // exit(print_r(static::$class_obj));
    //     foreach(static::$db_columns as $column)
    //     {
    //         if($column == 'id'){continue;}
    //         $prop_name = $column;
    //         $attributes[$column] = static::$class_obj->$prop_name;
    //     }
    //     return $attributes;
    // }

    // static public function find_by_uname($uname)
    // {
    //     $sql = " SELECT * FROM usertbl u  WHERE u.username = '" . self::$database->escape_string($uname) . "'";
    //     $obj_array = static::find_by_sql($sql);

    //     return (!empty($obj_array))? array_shift($obj_array): false;
    // }

    // static public function check_usage($id)
    // {
    //     $sql = ' SELECT * FROM ' . static::$secondary_table . ' WHERE ' . static::$id_name . ' = ' . $id;
    //     $obj_array = static::find_by_sql($sql);
        
    //     return (!empty($obj_array))? true : false;
    // }

    // static public function find_by_lra($id, $offset)
    // {
    //     /* returns multiple values */
    //     $sql = " SELECT * FROM  " . static::$cond_table . " WHERE " . static::$cond_id_name . "= '" . self::$database->escape_string($id) . "' {$offset}";
    //     $obj_array = static::find_by_sql($sql);
        
    //     return (!empty($obj_array))? $obj_array: false;
    // }


}

