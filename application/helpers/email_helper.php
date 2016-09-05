<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('parse_email')){

	//to parse the the email which is available in the
    function parse_email($parseElement, $mail_body) {
        foreach ($parseElement as $name => $value) {
            $parserName = $name;
            $parseValue = $value;
            $mail_body = str_replace("[$parserName]", $parseValue, $mail_body);
        }
        return $mail_body;
    }

}