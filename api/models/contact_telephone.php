<?php 
    class ContactTelephoneModel {
        public $id;
        public $contact_id;
        public $telephone_id;
        public $created_date;
        public $updated_date;
        public $status;

        public function __construct($id, $contact_id, $telephone_id, $created_date, $updated_date, $status){
            $this->id = intval($id);
            $this->contact_id = intval($contact_id);
            $this->telephone_id = intval($telephone_id);
            $this->created_date = trim($created_date);
            $this->updated_date = trim($updated_date);
            $this->status = intval($status);
        }
    }
?>