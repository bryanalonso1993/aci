<?php
// Call Token Interactive ACI FABRIC
require_once "parameters_auth.php";

abstract class ParametersRestApi{
    protected $username;
    protected $password;
    protected $url;
    protected $save_token;
    public function __construct($username, $password, $url, $save_token)
    {
        $this->username = $username;
        $this->password = $password;
        $this->url = $url;
        $this->save_token = $save_token;
    }
}
class TokenInteractiveApi extends ParametersRestApi {
    private function getTokenInfo(){
        // Initialize server
        $con = curl_init();
        $authJson = '{
        "aaaUser":{
          "attributes":{
            "name":"'.$this->username.'",
            "pwd":"'.$this->password.'"
          }
        }
        }';
        $options = array(
            CURLOPT_URL => $this->url."/api/aaaLogin.json",
            CURLOPT_HEADER => true,
            CURLOPT_POST => 1,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POSTFIELDS => $authJson,
            CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
            CURLOPT_RETURNTRANSFER => 1
        );
        curl_setopt_array($con,$options);
        $result_connection = curl_exec($con);
        //var_dump($result_connection);
        preg_match_all('/^Set-Cookie:\s*([^;]*)/mi',$result_connection,$matches);
        return str_replace("APIC-cookie=", "",$matches[1][0]);
    }
    protected function saveToken(){
        $getToken = $this->getTokenInfo();
        $file_token = __DIR__."/".$this->save_token;
        $myFile = fopen($file_token,'w');
        fwrite($myFile, $getToken);
        fclose($myFile);
    }
    protected function readToken(){
        $token_file = fopen(__DIR__."/".$this->save_token,'r');
        $read_token = fread($token_file, filesize(__DIR__."/".$this->save_token));
        fclose($token_file);
        return $read_token;
    }
}