<?php 

namespace CooperTest\Utils;

class Request{
  public static function body(){
    return json_decode(file_get_contents('php://input'), true);
  }

  public static function query()
  {
      $queryParams = [];
      if (isset($_SERVER['QUERY_STRING'])) {
          parse_str($_SERVER['QUERY_STRING'], $queryParams);
      }
      return $queryParams;
  }
}