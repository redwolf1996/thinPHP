<?php

namespace lib;

use PDO;
use PDOException;

class db
{
  private static $db = null;

  public function __construct()
  {
    if(self::$db === null){
      try{
        $dsn = 'mysql:host='. config('db')['host'] .';dbname='. config('db')['dbname'];
        self::$db = new PDO($dsn, config('db')['username'], config('db')['passwd']);
      }catch (PDOException $e){
        log::put($e->getMessage());
      }
    }
  }

  public function query($sql)
  {
    $rs = self::$db->query($sql);
    if(!$rs){
      log::put(self::$db->errorinfo()[2]. PHP_EOL .$sql);
    }
    return $rs;
  }
}
