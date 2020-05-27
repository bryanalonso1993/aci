<?php
require_once 'response_data_get.php';

$inst_aci = new ProcessDataApic($USERNAME, $PASSWORD, $URL, $SAVE_TOKEN);

// Callback Token
$inst_aci->getToken();

// Execute Function
$result = json_decode($inst_aci->getPartitionsAci(),true);
$row_array = array();

//print_r($result);
//echo $result[0]['eqptStorage']['attributes']['dn'];

for ($index=0;$index < count($result);$index++){
    echo $result[$index]['eqptStorage']['attributes']['dn']."\n";
}
