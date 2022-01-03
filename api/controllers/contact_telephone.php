<?php 
    include_once(__DIR__.'/../_db/queries/contact_telephone.php');

    class CONTACT_TELEPHONE {
        static public function get($id = 0){
            $id = intval($id);
            if($id && $id > 0){
                $result = ContactTelephoneQueries::get($id);
                $result = ($result)? $result : [];
                return ['data' => $result]; 
            }
        }

        static public function getAll(){
            $result = ContactTelephoneQueries::getAll();
            return ['data' => $result];
        }

        static public function add(ContactTelephoneModel $contact_telephone = NULL){
            if($contact_telephone){
                return ContactTelephoneQueries::add($contact_telephone);
            }
        }

        static public function delete($id = 0){
            $id = intval($id);
            if($id && $id > 0){
                return ContactTelephoneQueries::delete($id);
            }
        }

        static public function update(ContactTelephoneModel $contact_telephone = NULL){
            if($contact_telephone){
                return ContactTelephoneQueries::update($contact_telephone);
            }
        }


        static public function validate(ContactTelephoneModel $contact_telephone = NULL){
            $result = false;
            if($contact_telephone){
                if(
                    $contact_telephone->contact_id > 0 &&
                    $contact_telephone->telephone_id > 0 &&
                    $contact_telephone->created_date != "" &&
                    $contact_telephone->updated_date != "" &&
                    $contact_telephone->status >= 0
                ){
                    $result = true;
                }
            }
            return $result;
        }

        static public function exists(ContactTelephoneModel $contact_telephone = NULL){
            if($contact_telephone){
                $result = ContactTelephoneQueries::exists($contact_telephone);
                return ($result)? $result : false;
            }
        }
    }
?>