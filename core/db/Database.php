<?php

namespace app\core\db;

use m0001_initial;
use m0002_add_password_column;
use app\core\Application;


class Database
{
    public \PDO $pdo;
    public function __construct(array $config) {
        $dsn = $config["dsn"] ?? "";
        $user = $config["user"] ?? "";
        $password = $config["password"] ?? "";
        $this->pdo = new \PDO($dsn,$user,$password); //veritabanı bağlantısı
        //dsn localhost ve dbname'i içerir.
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
        //(hata raporlama,istisnaları belirler ve çalışmayı durdurur)
    }
    public function prepare($sql){
      return $this->pdo->prepare($sql);
    }
    protected function log($message){
        echo '[' . date('Y - m -d H:i:s') . '] - ' . $message .PHP_EOL;
    }

    public function applyMigrations()
    {
      $this->createMigrationsTable();
      $appliedMigrations =$this->getAppliedMigrations();

      $newMigrations = [];
      $files = scandir(Application::$ROOT_DIR."/migrations");
      
      $toApplyMigrations= array_diff($files,$appliedMigrations);
      foreach($toApplyMigrations as $migration){
          if($migration === "." || $migration === ".."){
              continue;
          }
          require_once Application::$ROOT_DIR ."/migrations/".$migration;
          $className = pathinfo($migration, PATHINFO_FILENAME);
          $instance = new $className();
          echo $this->log("Applying migration $migration");
          $instance->up();
          echo $this->log("Applied migration $migration");
          $newMigrations[] = $migration;
      }
      if(!empty($newMigrations))
      {
         $this->saveMigrations($newMigrations);
      }else{
         $this->log("All migrations are applied");
      }
    }

    public function createMigrationsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations(
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
           ) ENGINE=INNODB;");
           //exec() output'un son satırını döndürür
    }

    public function getAppliedMigrations()
    {
          $statement = $this->pdo->prepare("SELECT migration FROM migrations");
          $statement->execute();

          return $statement->fetchAll(\PDO::FETCH_COLUMN);
          //fetchAll(), Statement nesnesiyle ilişkili bir sonuç kümesindeki tüm satırları bir array e 
          //getirmenize olanak tanır.
    }

    public function saveMigrations(array $migrations)
    {
        $str = implode("," , array_map(fn($m) => "('$m')" , $migrations));
         $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES
         $str
         ");
         $statement->execute();
    }

    
}

?>