<?php 

    require_once 'App.php';
    require_once 'Auth.php';

    class AuthManager extends App {
        
        public function insertInSecurity($password) {

            $session_token = $this -> generateSessionToken();
            $req = "INSERT INTO security (password, session_token, password_status, last_login) VALUES (:password, :session_token, 'active', NOW())";

            $stmt = $this -> getBd() -> prepare($req);
            $stmt -> bindValue(':password', $password, PDO::PARAM_STR);
            $stmt -> bindValue(':session_token', $session_token);
            $stmt -> execute();

            $result = $stmt -> fetch();

            if($result){

                session_start();

                    $_SESSION['session_token'] = $result['session_token'];
                    $_SESSION['id'] = $result['id'];                

                header('Location: index.php?action=contact');

            }else{
                echo 'An error occurred while registering the user.';
            }

        }

        public function login($id, $password){

            $req = "SELECT * FROM security WHERE id = $id";

            $stmt = $this -> getBd() -> query($req);
            $result = $stmt -> fetch();

            if ($result) {

                $isPassword = password_verify($password, $result['password']);

                if ($isPassword) {

                    header('Location:index.php?action=contact');

                }else{
                    $msg = "Wrong credential. Please, try again !";
                }

            }else{
                $msg = "An error occurred while executing the login script. Please, try again later !";
            }

        }

        public function generateSessionToken($half = 4){
            return bin2hex(random_bytes($half));
        }
        public function identifyById($id) {

            $req = "SELECT * FROM security WHERE id = $id";
            $stmt = $this -> getBd() -> query($req);

            return $stmt -> fetch();

        }
        public function resetPassword($id, $password) {

            $req = "UPDATE security SET password = :password, last_login = NOW() WHERE id = :id";

            $stmt = $this -> getBd() -> prepare($req);
            $stmt -> bindValue(':password', $password, PDO::PARAM_STR);
            $stmt -> bindValue(':id', $id);
            
            $result = $stmt -> execute();

            return $result;

        }

        public function exportContact($id, $type) {

            $req = "SELECT * FROM contact WHERE id = $id";
            
            $stmt = $this -> getBd() -> query($req);
            $result = $stmt -> fetch();

            switch ($type) {
                case 'pdf':
                    echo 'PDF export successfully';
                break;
                case 'csv':
                    echo 'CSV export successfully';
                break;
                default: echo 'Something went wrong while exporting the contact';
            }

        }

    }