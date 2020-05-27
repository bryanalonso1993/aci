<?php
require_once 'call_server.php';

 class ProcessDataApic extends TokenInteractiveApi{
     public function getToken(){
         $this->saveToken();
     }
     private function AciGetData($concat_url){
        $ch = curl_init($this->url.$concat_url);
        $parameters = array(
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_COOKIE => "APIC-cookie=".$this->readToken()
        );
        curl_setopt_array($ch, $parameters);
        $result_json = curl_exec($ch);
        $result = json_decode($result_json, true);
        if (curl_errno($ch)){
            die("Error in fetch ".curl_error($ch));
        }
        curl_close($ch);
        return $result;
     }
     public function getPartitionsAci(){
         $response = $this->AciGetData("/api/node/class/topology/pod-1/node-1/eqptStorage.json?");
         return json_encode($response['imdata']);
     }
 }