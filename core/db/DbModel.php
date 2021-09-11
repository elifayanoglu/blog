<?php
namespace app\core\db;

use app\core\Application;
use app\core\Model;

abstract class DbModel extends Model{

    abstract public function tableName() : string;

    abstract public function attributes() : array;//this should return all the 
    //database column names
    abstract public function primaryKey() : string;

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        //fn() oluşturulduğu kapsamdan tüm değişkenlere erişebilir.
        $statement = self::prepare("INSERT INTO $tableName (".implode(',', $attributes).") 
        VALUES (".implode(',', $params).")");
        foreach($attributes as $attribute){
               $statement->bindvalue(":$attribute", $this->{$attribute});
        }

        $statement->execute();
        return true;
    }

    public function findOne($where)// [email => elif@examle.com, firstname => elif]
    {
       $tableName = static::tableName();
       $attributes = array_keys($where);
       $sql = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
       //SELECT * FROM $tableName WHERE email = :email AND firstname = :firstname
        //SELECT * FROM $tableName WHERE $sql
        $statement = self::prepare("SELECT *FROM $tableName WHERE $sql");
        foreach($where as $key => $item)
        {
             $statement->bindValue(":$key",$item);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }


}


?>