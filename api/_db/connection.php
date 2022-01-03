<?php 
    include('config.php');
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    class DB{
        private $host = DB_HOST;
        private $user = DB_USERNAME;
        private $password = DB_PASSWORD;
        private $dbname = DB_DATABASE_NAME;

        static protected function connect(){
            $db = new DB();
            $connection = new PDO("mysql:host={$db->host};dbname={$db->dbname}", $db->user, $db->password);
            $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $connection;
        }
        
        static protected function Query($sql, $params = []){
            $result = false;
            try{
                $statement = DB::connect()->prepare($sql);
                $result = ($statement->execute($params))? true : false;
            }catch(PDOException $e){
                $result = false;
            }
            return $result;
        }

        static protected function Select($sql, $params = []){
            $statement = DB::connect()->prepare($sql);
            $statement->execute($params);
            return $statement;
        }

        static protected function Insert($sql, $params = []){
            $result = false;
            try{
                $con = DB::connect();
                $statement = $con->prepare($sql);
                $result = ($statement->execute($params))? $con->lastInsertId() : false;
            }catch(PDOException $e){
                $result = false;
            }
            return $result;
        }
    } 
?>