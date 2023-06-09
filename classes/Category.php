<?php

/**
 * Category
 * 
 * Grouping for articles
 */

 class Category{

    /**
   * Get all the categories
   * 
   * @param object $connect Connection to the database
   * 
   * @return array An associative array of all the categories records
   */
  public static function getAll($connect){

    $sql = "SELECT * 
        FROM category
        ORDER BY name;";

  $results = $connect->query($sql);

  return $results->fetchAll(PDO::FETCH_ASSOC);
  
}

 }