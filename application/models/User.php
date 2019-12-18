<?php

use System\model\Model;

class User extends Model{

   protected $tableName = "user";

   public function test()
   {
       $this->all();
   }
}