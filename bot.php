<?php
$access_token = 'lsiTEin1tkWRo2GJIExuXGYIinMFo1HJOwPwGQj1YLuose/ztMEWXr4vKDVCXwCbGrRbpwCWwk8FNjCEuC0lijP+x4+lnFq/bI20uZat6hAZuxqX4GPhvggRqWrsXcl4IOr4et7MCDWfBzgCA9jLOwdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			if($text=="จอมหล่อมั้ย"){
				$replytext = "หล่อมากๆ ซ้ายยังกะมาริโอ ขวายังกะณเดช";
			}elseif(strpos($text, 'หล่อ') !== false) {
				$replytext = "ก็จอมน่ะสิ จะใครล่ะ";
			}elseif($text=="คิดถึง"){
				$replytext = "คิดถึงเหมือนกัน มั่กๆๆๆๆๆ";
			}else{
				$replytext = $text.'สิ มาบอกทำไม';
			}
			
			$messages = [
				'type' => 'text',
				'text' => $replytext
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
