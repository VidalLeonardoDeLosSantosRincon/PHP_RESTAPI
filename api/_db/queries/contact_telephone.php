<?php
    include_once(__DIR__.'/../connection.php');
    include_once(__DIR__.'/../../models/contact_telephone.php');

    class ContactTelephoneQueries extends DB {
        static public function get($id = 0){
            if($id && $id > 0){
                $sql = "SELECT * FROM contact_telephone ct WHERE ct.id = :id";
                $params = [":id" => $id];
                $stmt = ContactTelephoneQueries::Select($sql, $params);
                return $stmt->fetch();
            }
        }

        static public function getAll(){
            $sql = "SELECT * FROM contact_telephone";
            $stmt = ContactTelephoneQueries::Select($sql);
            return $stmt->fetchAll();
        }

        static public function add(ContactTelephoneModel $contact_telephone = NULL){
            $result = false;
            if($contact_telephone){
                $sql = "INSERT INTO contact_telephone(contact_id, telephone_id, created_date, updated_date, status) 
                        VALUES(:contact_id, :telephone_id, :created_date, :updated_date, :status)";
                $params = [
                            ":contact_id" => $contact_telephone->contact_id, ":telephone_id" => $contact_telephone->telephone_id, 
                            ":created_date" => $contact_telephone->created_date, ":updated_date" => $contact_telephone->updated_date,
                             ":status" => $contact_telephone->status
                        ];
                $result = ContactTelephoneQueries::Insert($sql, $params);
            }
            return $result;
        }

        static public function delete($id = 0){
            $result = false;
            if($id && $id > 0){
                if(ContactTelephoneQueries::get($id)){
                    $sql = "DELETE FROM contact_telephone WHERE id = :id";
                    $params = [":id" => $id];
                    $result = ContactTelephoneQueries::Query($sql, $params);
                }
            }
            return $result;
        } 

        static public function update(ContactTelephoneModel $contact_telephone = NULL){
            $result = false;
            if($contact_telephone){
                if($contact_telephone->id > 0){
                    if(ContactTelephoneQueries::get($contact_telephone->id)){
                        $sql = "UPDATE contact_telephone SET contact_id = :contact_id, telephone_id = :telephone_id, updated_date = :updated_date, status = :status WHERE id = :id";
                        $params = [
                                    ":id" => $contact_telephone->id,":contact_id" => $contact_telephone->contact_id, 
                                    ":telephone_id" => $contact_telephone->telephone_id, ":updated_date" => $contact_telephone->updated_date, 
                                    ":status" => $contact_telephone->status
                                ];
                        $result = ContactTelephoneQueries::Query($sql, $params);
                    }
                }
            }
            return $result;
        }

        static public function exists(ContactTelephoneModel $contact_telephone = NULL){
            if($contact_telephone){
                $sql = "SELECT * FROM contact_telephone WHERE contact_id = :contact_id &&  telephone_id = :telephone_id";
                $params = [
                            ":contact_id" => $contact_telephone->contact_id, 
                            ":telephone_id" => $contact_telephone->telephone_id
                        ];
                $stmt = ContactTelephoneQueries::Select($sql, $params);
                return $stmt->fetch();
            }
        }
    }
?>