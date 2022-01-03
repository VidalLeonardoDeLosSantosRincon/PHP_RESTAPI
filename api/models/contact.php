<?php 
    class ContactModel {
        public $id;
        public $name;
        public $lastname;
        public $email;
        public $telephones;
        public $created_date;
        public $updated_date;
        public $status;

        public function __construct($id, $name, $lastname, $email, $telephones, $created_date, $updated_date, $status){
            $this->id = intval($id);
            $this->name = trim($name);
            $this->lastname = trim($lastname);
            $this->email = trim($email);
            $this->telephones = $telephones;
            $this->created_date = trim($created_date);
            $this->updated_date = trim($updated_date);
            $this->status = intval($status);
        }
    }
?>