<?php 
    include_once(__DIR__.'/../_db/queries/telephone.php');

    class TELEPHONE {
        static public function get($id = 0){
            $id = intval($id);
            if($id && $id > 0){
                $result = TelephoneQueries::get($id);
                $result = ($result)? $result : [];
                return ['data' => $result ];
            }
        } 

        static public function getAll(){
            $result = TelephoneQueries::getAll();
            return ['data' => $result ];
        }

        static public function add(TelephoneModel $telephone){
            if($telephone){
                return TelephoneQueries::add($telephone);
            }
        }

        static public function delete($id = 0){
            $id = intval($id);
            if($id && $id > 0){
                return TelephoneQueries::delete($id);
            }
        } 

        static public function update(TelephoneModel $telephone){
            if($telephone){
                return TelephoneQueries::update($telephone);
            }
        }

        static public function validate(TelephoneModel $telephone){
            $result = false;
            if($telephone){
                if(
                    $telephone->number != "" &&
                    $telephone->created_date != "" &&
                    $telephone->updated_date != "" &&
                    $telephone->status >= 0
                ){
                    $result = true;
                }
            }
            return $result;
        }

        static public function exists(TelephoneModel $telephone){
            if($telephone){
                $result = TelephoneQueries::exists($telephone);
                return ($result)? $result : false;
            }
        }
    }
?>