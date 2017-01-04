<?php
$access_token = 'lsiTEin1tkWRo2GJIExuXGYIinMFo1HJOwPwGQj1YLuose/ztMEWXr4vKDVCXwCbGrRbpwCWwk8FNjCEuC0lijP+x4+lnFq/bI20uZat6hAZuxqX4GPhvggRqWrsXcl4IOr4et7MCDWfBzgCA9jLOwdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
