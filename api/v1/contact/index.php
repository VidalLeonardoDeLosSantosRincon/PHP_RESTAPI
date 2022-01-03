<?php 
    include('../../_lib/engine.php');
    include('../../controllers/contact.php');
    
    $request = $_SERVER['REQUEST_METHOD'];
    $data = json_decode(file_get_contents('php://input', true), true);
    $response = [];
    
    switch($request){
        case 'GET':
                $response = _json(array_key_exists('id', $_GET)? CONTACT::get(intval($_GET['id'])) : CONTACT::getAll());
            break;

        case 'POST':
                if(
                    array_key_exists('name', $data) && array_key_exists('lastname', $data) &&
                    array_key_exists('email', $data) && array_key_exists('status', $data) &&
                    array_key_exists('telephones', $data)
                ){
                    $new_contact = new ContactModel(0, $data['name'], $data['lastname'], $data['email'], $data['telephones'], _date(), _date(), $data['status']);
                    $response = _json(CONTACT::validate($new_contact)? CONTACT::add($new_contact) : ["api_response" => "Invalid Data"]);
                }else{
                    $response = _json(["api_response" => "Invalid Data"]);
                }
            break;

        case 'DELETE':
                $response = _json(array_key_exists('id', $data)? CONTACT::delete(intval($data['id'])) : false);
            break;

        case 'PUT':
                if(
                    array_key_exists('id', $data) && array_key_exists('name', $data) && 
                    array_key_exists('lastname', $data) && array_key_exists('email', $data) && 
                    array_key_exists('status', $data) && array_key_exists('telephones', $data)
                ){
                    $new_contact = new ContactModel($data['id'], $data['name'], $data['lastname'], $data['email'], $data['telephones'], _date(), _date(), $data['status']);
                    $response = _json(CONTACT::validate($new_contact)? CONTACT::update($new_contact) : ["api_response" => "Invalid Data"]);
                }else{
                    $response = _json(["api_response" => "Invalid Data"]);
                }
            break;

        default:
                 $response = _json(array_key_exists('id', $_GET)? CONTACT::get(intval($_GET['id'])) : CONTACT::getAll());
            break;
    }
    echo $response;
?>