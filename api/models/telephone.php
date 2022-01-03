<?php 
    class TelephoneModel {
        public $id;
        public $number;
        public $created_date;
        public $updated_date;
        public $status;

        public function __construct($id, $number, $created_date, $updated_date, $status){
            $this->id = intval($id);
            $this->number = trim($number);
            $this->created_date = trim($created_date);
            $this->updated_date = trim($updated_date);
            $this->status = intval($status);
        }
    }
?>