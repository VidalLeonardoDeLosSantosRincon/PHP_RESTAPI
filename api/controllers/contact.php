<?php 
    include_once(__DIR__.'/../_db/queries/contact.php');
    include_once('telephone.php');
    include_once('contact_telephone.php'); 
    
    class CONTACT {
        //method to get a Contact
        static public function get($id = 0){
            $id = intval($id);
            if($id && $id > 0){
               $result = ContactQueries::get($id);
               if($result){
                    $new_result = [
                        "id" => $result['id'],
                        "name" => $result['name'],
                        "lastname" => $result['lastname'],
                        "email" => $result['email'],
                        "telephones" => [],
                        "created_date" => $result['created_date'],
                        "updated_date" => $result['updated_date'],
                        "status" => $result['status']
                    ];
                  
                    $phones = CONTACT::getTelephones($id);
                    $phones = $phones['data'];
                    foreach($phones as $phone) array_push($new_result['telephones'], $phone['number']);
                    $result= $new_result;
                }else{ 
                    $result  = [];
                }
               return ['data' => $result];
            }
        }

        //method to get Contact's phones
        static public function getTelephones($user_id = 0){
            $user_id = intval($user_id);
            if($user_id && $user_id > 0){
               $result = ContactQueries::getTelephones($user_id);
               $result = ($result)? $result : [];
               return ['data' => $result];
            }
        }

        //method to get all Contacts
        static public function getAll(){
            $results = ContactQueries::getAll();
            if($results){
                $new_results = [];
                foreach($results as $result){
                    $new_result = [
                        "id" => $result['id'],
                        "name" => $result['name'],
                        "lastname" => $result['lastname'],
                        "email" => $result['email'],
                        "telephones" => [],
                        "created_date" => $result['created_date'],
                        "updated_date" => $result['updated_date'],
                        "status" => $result['status']
                    ];
                
                    $phones = CONTACT::getTelephones($result['id']);
                    $phones = $phones['data'];

                    foreach($phones as $phone) array_push($new_result['telephones'], $phone['number']);
                    array_push($new_results, $new_result);
                }
                $results = $new_results;
            }else{ 
                $results  = [];
            }
            return ['data' => $results];
        }

        //method to insert a Contact and it's Phone Number(s)
        static public function add(ContactModel $contact = NULL){
            $result = false;
            if($contact){
                $contact_id = 0;
                $telephone_id = 0;
                $once_time = true;
                if(!CONTACT::exists($contact)){
                    foreach($contact->telephones as $telephone){
                        $new_telephone = new TelephoneModel(0, $telephone, _date(), _date(), 1);
                        if(!TELEPHONE::exists($new_telephone)){
                            if($once_time){
                                $contact_id = ContactQueries::add($contact);
                                $once_time = false;
                            }
                            
                            $telephone_id = TELEPHONE::add($new_telephone);
                            $new_contact_telephone = new ContactTelephoneModel(0, $contact_id, $telephone_id, _date(), _date(), 1);

                            if(CONTACT_TELEPHONE::validate($new_contact_telephone)){
                                $result = CONTACT_TELEPHONE::add($new_contact_telephone);
                            }
                        } 
                    }
                }
            }
            return  $result;
        }

        //method to delete a Contact and it's Phone Number(s)
        static public function delete($id = 0){
            $result = false;
            $id = intval($id);
            if($id && $id > 0){
                $info_deleted = 0;
                if(ContactQueries::get($id)){
                    $phones = CONTACT::getTelephones($id);
                    $phones = $phones['data'];
 
                    foreach($phones as $phone) {
                        $contact_telephone_deleted = CONTACT_TELEPHONE::delete(intval($phone['id']));
                        if($contact_telephone_deleted){
                            $info_deleted += 1;
                        }
                    }

                    foreach($phones as $phone) {
                        $telephone_deleted = TELEPHONE::delete(intval($phone['telephone_id']));
                        if($contact_telephone_deleted){
                            $info_deleted += 1;
                        }
                    }
                
                    $result = ContactQueries::delete($id);
                    $result = ($info_deleted > 0 && $result)? true : false;
                }
            }
            return $result;
        }

        //method to update a Contact and it's Phone Number(s)
        static public function update(ContactModel $contact = NULL){
            $result = false;
            if($contact){
                $result = ContactQueries::update($contact);
                if($result){
                    foreach($contact->telephones as $telephone){
                        $new_telephone = new TelephoneModel(0, $telephone, _date(), _date(), 1);
                        if(!TELEPHONE::exists($new_telephone)){  
                            $telephone_id = TELEPHONE::add($new_telephone);
                            $new_contact_telephone = new ContactTelephoneModel(0, $contact->id, $telephone_id, _date(), _date(), 1);

                            if(CONTACT_TELEPHONE::validate($new_contact_telephone)){
                                $result = CONTACT_TELEPHONE::add($new_contact_telephone);
                                $result = ($result)? true : false;
                            }
                        } 
                    }
                }
            } 
            return $result;
        }

        //method to check if a Contact exists
        static public function exists(ContactModel $contact = NULL){
            if($contact){
                return ContactQueries::exists($contact);
            } 
        }

        //method to validate Contact's Data Model
        static public function validate(ContactModel $contact = NULL){
            $result = false;
            if($contact){
                if(
                    $contact->name != "" &&
                    $contact->lastname != "" &&
                    $contact->email != "" &&
                    $contact->created_date != "" &&
                    $contact->updated_date != "" &&
                    $contact->status >= 0 &&
                    is_array($contact->telephones)
                ){
                    if(count($contact->telephones) > 0){
                        $at_least_one_number = 0;
                        foreach($contact->telephones as $telephone){
                            if(trim($telephone) != ""){
                                $at_least_one_number += 1; 
                            }
                        }
                        $result = ($at_least_one_number > 0)? true : false;
                    }
                }
            } 
            return $result;
        }
    }
?>