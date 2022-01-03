<?php 
    include_once(__DIR__.'/../connection.php');
    include_once(__DIR__.'/../../models/telephone.php');
    
    class TelephoneQueries extends DB {
        static public function get($id = 0){
            if($id && $id > 0){
                $sql = "SELECT * from telephone t WHERE t.id = :id";
                $params = [":id" => $id];
                $stmt = TelephoneQueries::Select($sql, $params);
                return $stmt->fetch();
            }
        }

        static public function getAll(){
            $sql = "SELECT * from telephone";
            $stmt = TelephoneQueries::Select($sql);
            return $stmt->fetchAll();
        }

        static public function add(TelephoneModel $telephone = NULL){
            $result = false;
            if($telephone){
                $sql = "INSERT INTO telephone(number, created_date, updated_date, status) 
                        VALUES(:number, :created_date, :updated_date, :status)";
                $params = [
                            ":number" => $telephone->number, ":created_date" => $telephone->created_date, 
                            ":updated_date" => $telephone->updated_date, ":status" => $telephone->status
                        ];
                $result = TelephoneQueries::Insert($sql, $params);
            }
            return $result;
        }

        static public function delete($id = 0){
            $result = false;
            if($id && $id > 0){
                if(TelephoneQueries::get($id)){
                    $sql = "DELETE FROM telephone WHERE id = :id";
                    $params = [":id" => $id];
                    $result = TelephoneQueries::Query($sql, $params);
                }
            }
            return $result;
        }

        static public function update(TelephoneModel $telephone = NULL){
            $result = false;
            if($telephone){
                if($telephone->id > 0){
                    if(TelephoneQueries::get($telephone->id)){
                        $sql = "UPDATE telephone SET number = :number, updated_date = :update_date, status = :status WHERE id = :id";
                        $params = [
                                    ":id" => $telephone->id, ":number" => $telephone->number, 
                                    ":updated_date" => $telephone->updated_date, ":status" => $telephone->status
                                ];
                        $result = TelephoneQueries::Query($sql, $params);
                    }
                }
            }
            return $result;
        }

        static public function exists(TelephoneModel $telephone = NULL){
            if($telephone){
                $sql = "SELECT * FROM telephone t WHERE t.number = :number";
                $params = [":number" => $telephone->number];
                $stmt = TelephoneQueries::Select($sql, $params);
                return $stmt->fetch();
            } 
        }
    }
?>