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
			}elseif(strpos($text, 'ดำน้ำ') !== false) {
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
			}elseif(strpos($text, 'ประเมิน') !== false) {
				$type = "template";
			}elseif($text=="คิดถึง"){
				$replytext = "คิดถึงเหมือนกัน มั่กๆๆๆๆๆ";
			}else{
				$replytext = $text.'สิ มาบอกทำไม';
			}

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			
			if($type=="template"){
				$actions[] = array(
					'type' => 'postback',
					'label' => 'จัดที่ไหน',
					'data' => 'message=ไหน',
				);				
				$actions[] = array(
					'type' => 'uri',
					'label' => 'ญี่ปุ่น',
					'uri' => 'http://patamon.pw',
				);				
				$template = array(
					'type' => 'buttons',
					'thumbnailImageUrl' => 'https://patamon.pw/orig.jpg',
					'title' => 'สวัสดีค่ะ ฉันช่วยอะไรคุณได้บ้าง',
					'text' => 'เลือกเมนู หรือพิมพ์ keyword เพื่อค้นหาบูธในงานที่ต้องการ',
					'actions' => $actions,
				);				
				$messages = array(
					'type' => 'template',
					'altText' => 'LINE ของคุณเก่าแล้วนะ แต่ยังคุยกันได้ค่ะ',
					'template' => $template,
				);	
				
			}elseif($type=="sticker"){
				$messages = array(
					'type' => $type,
					'packageId' => 2,
					'stickerId' => 145,
				);
				
			}elseif($type=="image"){
				$messages = array(
					'type' => $type,
					'originalContentUrl' => 'https://scontent.fbkk2-1.fna.fbcdn.net/v/t31.0-8/14207865_759580270811489_7698392208178314974_o.jpg?oh=e50621dfc90774f7044b23389cd852db&oe=5910C29C',
					'previewImageUrl' => 'https://scontent.fbkk2-1.fna.fbcdn.net/v/t1.0-1/p200x200/14718888_781358575300325_1429275987166647386_n.jpg?oh=6b8ecf2a77c2a452a3feb52b656aafeb&oe=592042DB',
				);
				
			}elseif($type=="location"){
				$messages = array(
					'type' => $type,
					'title' => $title,
					'address' => 'ศูนย์การประชุมแห่งชาติสิริกิติ์',
					'latitude' => 13.723702,
					'longitude' => 100.559159,
				);
			}else{
				$messages = array(
					'type' => 'text',
					'text' => $replytext,
				);				
			}
// 				$data = [
// 					'replyToken' => $replyToken,
// 					'messages' => [$messages],
// 					'messages' => [$messages2],
// 				];
// 			}else{
				$data = array(
					'replyToken' => $replyToken,
					'messages' => $messages,
				);
// 			}
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
