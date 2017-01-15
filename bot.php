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
			}elseif(strpos($text, 'กระบี่') !== false) {
				$type = "carousel";
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
			
			if($type=="carousel"){
				$actions1 = [
					[
					'type' => 'uri',
					'label' => 'โปรโมชั่น',
					'uri' => 'http://www.titf-ttaa.com',
						],
					[
					'type' => 'postback',
					'label' => 'ดูผังบูธ',
					'text' => 'plenary',
					'data' => 'message=ไหร่',
						],
					[
					'type' => 'uri',
					'label' => 'ดูรายละเอียด',
					'uri' => 'http://www.titf-ttaa.com',
						]
				];				
				$actions2 = [
					[
					'type' => 'uri',
					'label' => 'โปรโมชั่น',
					'uri' => 'http://www.titf-ttaa.com',
						],
					[
					'type' => 'postback',
					'label' => 'ดูผังบูธ',
					'text' => 'plenary',
					'data' => 'message=ไหร่',
						],
					[
					'type' => 'uri',
					'label' => 'ดูรายละเอียด',
					'uri' => 'http://www.titf-ttaa.com',
						]
				];				
				$actions3 = [
					[
					'type' => 'uri',
					'label' => 'โปรโมชั่น',
					'uri' => 'http://www.titf-ttaa.com',
						],
					[
					'type' => 'postback',
					'label' => 'ดูผังบูธ',
					'text' => 'plenary',
					'data' => 'message=ไหร่',
						],
					[
					'type' => 'uri',
					'label' => 'ดูรายละเอียด',
					'uri' => 'http://www.titf-ttaa.com',
						]
				];				
				$actions4 = [
					[
					'type' => 'uri',
					'label' => 'โปรโมชั่น',
					'uri' => 'http://www.titf-ttaa.com',
						],
					[
					'type' => 'postback',
					'label' => 'ดูผังบูธ',
					'text' => 'plenary',
					'data' => 'message=ไหร่',
						],
					[
					'type' => 'uri',
					'label' => 'ดูรายละเอียด',
					'uri' => 'http://www.titf-ttaa.com',
						]
				];				
				$actions5 = [
					[
					'type' => 'uri',
					'label' => 'โปรโมชั่น',
					'uri' => 'http://www.titf-ttaa.com',
						],
					[
					'type' => 'postback',
					'label' => 'ดูผังบูธ',
					'text' => 'plenary',
					'data' => 'message=ไหร่',
						],
					[
					'type' => 'uri',
					'label' => 'ดูรายละเอียด',
					'uri' => 'http://www.titf-ttaa.com',
						]
				];				
				$columns = [
					[
					'title' => 'อ่าวนางออลซีซั่นส์/ลันตาปุรี จ.กระบี่',
					'text' => 'บูธ CC105 โซน C2',
					'actions' => $actions1,
						],
					[
					'title' => 'อนันต บุรินทร์ รีสอร์ท จ. กระบี่',
					'text' => 'บูธ CC179 โซน C2',
					'actions' => $actions2,
						],
					[
					'title' => 'ไร่เลย์ วิวพอยท์ รีสอร์ท จ. กระบี่',
					'text' => 'บูธ G270 โซน CG',
					'actions' => $actions3,
						],
					[
					'title' => 'โรงแรมอารีธารา รีสอร์ท กระบี่',
					'text' => 'บูธ C124 โซน C2',
					'actions' => $actions4,
						],
					[
					'title' => 'โรงแรมอาภาสรี กระบี่',
					'text' => 'บูธ CC159 โซน C2',
					'actions' => $actions5,
						],
				];				
				$template = [
					'type' => '$type',
					'columns' => $columns,
				];				
				$messages = [
					'type' => 'template',
					'altText' => 'โปรดเลือกปุ่ม',
					'template' => $template,
				];
				$data = [
					'replyToken' => $replyToken,
					'messages' => [$messages],
				];
				
			}elseif($type=="template"){
				$actions = [
					[
					'type' => 'postback',
					'label' => 'จัดที่ไหน',
					'text' => 'จัดที่ไหน',
					'data' => 'message=ไหน',
						],[
					'type' => 'postback',
					'label' => 'แผนผังงาน',
					'text' => 'แผนผังงาน',
					'data' => 'message=ไหร่',
						],[
					'type' => 'postback',
					'label' => 'กิจกรรมวันนี้',
					'text' => 'กิจกรรมวันนี้',
					'data' => 'message=ไหร่',
						],[
					'type' => 'uri',
					'label' => 'TITF Facebook',
					'data' => 'message=ไหร่',
					'uri' => 'https://www.facebook.com/ttaatitf',
						]
				];				
				$template = [
					'type' => 'buttons',
					'text' => 'เลือกเมนู หรือพิมพ์ keyword เพื่อค้นหาบูธในงานที่ต้องการ',
					'actions' => $actions,
				];				
				$messages = [
					'type' => $type,
					'altText' => 'โปรดเลือกปุ่ม',
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
					'type' => 'text',
					'text' => $replytext,
					],
					[
					'type' => $type,
					'title' => $title,
					'address' => 'ศูนย์การประชุมแห่งชาติสิริกิติ์',
					'latitude' => 13.723702,
					'longitude' => 100.559159,
						]
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
