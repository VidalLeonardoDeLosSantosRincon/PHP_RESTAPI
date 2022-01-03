<?php 
    function _json($param){ return json_encode($param);}

    function r_json($param){ return json_decode($param); }

    function _date($timeZone = "America/Caracas"){
        $tz = $timeZone;
        date_default_timezone_set($tz);
        return date('Y-m-d h:i:s');
    }

    function _log($param){
        echo "<pre>";
        print_r($param, false);
        echo "</pre>";
    }

    function _info_api(){
        return [
            "API_URL" => API_DOMAIN."/atl2/api/v1",
            "AUTHOR" => "Vidal De Los Santos",
            "VERSION" => "1.0",
            "ENDPOINTS" => [
                "CONTACT" => [
                    "URL" => API_DOMAIN."/atl2/api/v1/contact",
                    "GET" => [ "BY ID" => "/?id=:id", "ALL" => "/" ],
                    "POST" => [
                        "Body" => [
                            "name" => "string [MAX_LENGTH(200)]",
                            "lastname" => "string [MAX_LENGTH(250)]",
                            "email" => "string",
                            "telephones" => "array [000-000-0000 , 000-000-0000, ...]",
                            "status" => "int"   
                        ]
                    ],
                    "DELETE" => ["Body" => ["id" => "int"]],
                    "PUT" => [
                        "Body" => [
                            "id" => "int",
                            "name" => "string [MAX_LENGTH(200)]",
                            "lastname" => "string [MAX_LENGTH(250)]",
                            "email" => "string",
                            "telephones" => "array [000-000-0000 , 000-000-0000, ...]",
                            "status" => "int"
                        ]
                    ]
                ]
            ]
        ];
    }
?>