<?php 
include_once("IRequest.php");

class Request implements IRequest {

    function __construct() {
        $this->bootstrap_self();
    }

    private function bootstrap_self() {

        foreach($_SERVER as $key => $value) {
            
            $this->{$key} = $value;
        }
    }


    public function get_body() {

        if($this->requestMethod === "GET") {
            return;
        }


        if($this->requestMethod === "POST") {

            $body = array();

            foreach($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }

            return $body;
        }
    }
}