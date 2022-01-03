<?php
    include_once(__DIR__.'/../connection.php');
    include_once(__DIR__.'/../../models/contact.php');
    
    class ContactQueries extends DB{
        //CONTACT SELECT QUERY
        static public function get($id = 0){
            if($id && $id > 0){
                $sql = "SELECT * FROM contact c WHERE c.id = :id";
                $params = [":id" => $id];
                $stmt = ContactQueries::Select($sql, $params);
                return $stmt->fetch();
            }
        }

        //CONTACT SELECT PHONES QUERY
        static public function getTelephones($user_id = 0){
            if($user_id && $user_id > 0){
                $sql = "SELECT tc.id , tc.contact_id, tc.telephone_id, t.number
                        FROM contact_telephone tc 
                        LEFT JOIN telephone t ON(t.id = tc.telephone_id)
                        WHERE tc.contact_id = :contact_id";

                $params = [":contact_id" => $user_id];
                $stmt = ContactQueries::Select($sql, $params);
                return $stmt->fetchAll();
            }
        }

        //CONTACT SELECT ALL QUERY
        static public function getAll(){
            $sql = "SELECT * FROM contact";
            $stmt = ContactQueries::Select($sql);
            return $stmt->fetchAll();
        }

        //CONTACT INSERT QUERY
        static public function add(ContactModel $contact = NULL){
            $result = false;
            if($contact){
                $sql = "INSERT INTO contact(name, lastname, email, created_date, updated_date, status) 
                        VALUES(:name, :lastname, :email, :created_date, :updated_date, :status)";
                $params = [ 
                            ":name" => $contact->name, ":lastname" => $contact->lastname, ":email" => $contact->email, 
                            ":created_date" => $contact->created_date, ":updated_date" =>$contact->updated_date, ":status" => $contact->status
                        ];
                $result = ContactQueries::Insert($sql, $params);
            }
            return $result;
        }

        //CONTACT DELETE QUERY
        static public function delete($id = 0){
            $result = false;
            if($id && $id > 0){
                if(ContactQueries::get($id)){
                    $sql = "DELETE FROM contact WHERE id = :id";
                    $params = [":id" => $id];
                    $result = ContactQueries::Query($sql, $params);
                }
            }
            return $result;
        }

        //CONTACT UPDATE QUERY
        static public function update(ContactModel $contact = NULL){
            $result = false;
            if($contact){
                if($contact->id > 0){
                    if(ContactQueries::get($contact->id)){
                        $sql = "UPDATE contact SET name = :name, lastname = :lastname, email = :email, updated_date = :updated_date, status = :status WHERE id = :id";

                        $params = [
                                    ":id"=> $contact->id, ":name" => $contact->name, ":lastname" => $contact->lastname, 
                                    ":email" => $contact->email, ":updated_date" =>$contact->updated_date, ":status" => $contact->status
                                ];
                        $result = ContactQueries::Query($sql, $params); 
                    }
                }
            }  
            return $result; 
        }

        static public function exists(ContactModel $contact = NULL){
            if($contact){
                $sql = "SELECT * FROM contact c 
                        WHERE c.name = :name AND c.lastname = :lastname 
                        OR c.email = :email";
                $params = [":name" => $contact->name, ":lastname" => $contact->lastname, ":email" => $contact->email];
                $stmt = ContactQueries::Select($sql, $params);
                return $stmt->fetch();
            } 
        }
    }
?>