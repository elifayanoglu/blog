<?php 
    namespace app\model;
    use app\core\Model;
    use app\core\Application;
    class AdminLogin extends Model{
        
        public string $username = '';
        public string $password = '';
        
        public function rules(): array{
            return [
                'username' => [self::RULE_REQUIRED],
                'password' => [self::RULE_REQUIRED]
            ];
        }

        public function login(){
            $admin = Admin::findOne(['username' => $this->username], Admin::class);
            if(!$admin){
                $this->addError('email', "Admin username is incorrect");
                return false;
            }
            // if(!password_verify($this->password, $admin->password)){
            //     $this->addError('password', "Password is incorrect");
            //     return false;
            // }
            if(md5($this->password) != $admin->password){
                $this->addError('password', "Password is incorrect");
                return false;
            }
            //session oluştur admin =1
            //middleware session da admin var mı yok mu kontrol et true false ata
            //yoksa middleware de hata bastır
            return Application::$app->loginAdmin($admin);
        }
    
        public function labels(): array{
            return [
                "username" => "Username",
                "password" => "Password"
            ];
        }
    }

?>