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
			if(strpos($text, 'ดำน้ำ') !== false) {
				$replytext = "คุณต้องการไปดำน้ำที่ไหน";
			}elseif(strpos($text, 'เกาะล้าน') !== false) {
				$replytext = "มี 100 กว่าบูธ คุณต้องการดูรายชื่อเลย หรือต้องการระบุงบ";
			}elseif(strpos($text, 'หลีเป๊ะ') !== false) {
				$replytext = "มี 100 กว่าบูธ คุณต้องการดูรายชื่อเลย หรือต้องการระบุงบ";
			}elseif(strpos($text, 'ไหน') !== false) {
				$replytext = "จัดที่ศูนย์การประชุมแห่งชาติสิริกิติ์ เดินทางด้วย MRT ก็ได้นะ";
				$title = "งานเที่ยวทั่วไทย ไปทั่วโลก TITF#20";
				$type = "location";
			}elseif(strpos($text, 'plenary') !== false) {
				$type = "image";
			}elseif(strpos($text, 'กุนสตรี') !== false) {
				$type = "sticker";
				$replytext = "ว่าเป็นหมูหรอ";
			}else{
				$type = "template";
			}

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			if($type=="template"){
				$actions = [
					[
					'type' => 'postback',
					'label' => 'จัดที่ไหน',
					'text' => 'จัดที่ไหน'
						],[
					'type' => 'postback',
					'label' => 'แผนผังงาน',
					'text' => 'แผนผังงาน',
						],
				];				
				$template = [
					'type' => 'buttons',
					'text' => 'กรุณาระบุ keyword',
					'actions' => $actions,
				];				
				$messages = [
					'type' => $type,
					'altText' => 'Please type keyword',
					'template' => $template,
				];
				$data = [
					'replyToken' => $replyToken,
					'messages' => [$messages],
				];
				
			}elseif($type=="sticker"){
				$messages = [
				    [
					'type' => $type,
					'packageId' => 2,
					'stickerId' => 145,
				    ],
				    [
					'type' => 'text',
					'text' => $replytext,
				    ],
				];					
				$data = [
					'replyToken' => $replyToken,
					'messages' => $messages,
				];
				
			}elseif($type=="image"){
				$messages = [
					'type' => $type,
					'originalContentUrl' => 'https://patamon.pw/orig.jpg',
					'previewImageUrl' => 'https://patamon.pw/prev.jpg',
				];
				$data = [
					'replyToken' => $replyToken,
					'messages' => [$messages],
				];
				
			}elseif($type=="location"){
				$messages = [
					[
					'type' => $type,
					'title' => $title,
					'address' => 'ศูนย์การประชุมแห่งชาติสิริกิติ์',
					'latitude' => 13.723702,
					'longitude' => 100.559159,
						],
					[
					'type' => 'text',
					'text' => $replytext,
						],
				];
				$data = [
					'replyToken' => $replyToken,
					'messages' => $messages,
				];
				
			}else{
				$messages = [
					'type' => 'text',
					'text' => $replytext,
				];					
				$data = [
					'replyToken' => $replyToken,
					'messages' => [$messages],
				];
			}
			
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
