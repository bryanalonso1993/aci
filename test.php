<?php

$string = "string(2166) \"HTTP/1.1 200 OK
Server: nginx/1.13.12
Date: Sun, 17 May 2020 15:15:54 GMT
Content-Type: application/json
Content-Length: 1306
Connection: keep-alive
Set-Cookie: APIC-cookie=6wkAAAAAAAAAAAAAAAAAAMJN5Gs7drfyN9/qn4Av50sCl7NqzweR7B8wuhX4bN0npQrgdZPa7aCZKmfhH8IO+HTUrE/7J3vxpxihfdVt0D1UGjplnAw9/TqoUefMrtnzvD/xgSqaXO6OcheSQ+48tMJ8Nmg5YC7w7Dx/0G02pv7VXkfKuFwbE/f4DuU136sBWI1wogJFF2dzOALcWbekMA==; path=/; HttpOnly; HttpOnly; Secure
Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, devcookie, APIC-challenge
Access-Control-Allow-Methods: POST,GET,OPTIONS,DELETE
X-Frame-Options: SAMEORIGIN
Strict-Transport-Security: max-age=31536000; includeSubdomains
Cache-Control: no-cache=\"Set-Cookie, Set-Cookie2\"
Client-Cert-Enabled: false
Access-Control-Allow-Origin: http://127.0.0.1:8000
Access-Control-Allow-Credentials: false
";
preg_match_all('/^Set-Cookie:\s*([^;]*)/mi',$string,$matches);
$cookies=array();
//var_dump($matches[1][0]);
// parse_str($matches[1][0],$cookie);
//var_dump(str_replace("APIC-cookie","",$matches[1][0]));
//echo str_replace("APIC-cookie","",$matches[1][0]);
$data_json = '[{"usern":"bryan","apellido":"Almeyda"}]';
$variable = json_encode($data_json);