<?php
    header('Content-Type: application/json');

    $replyToken = 1;
    $type = 'carousel';

    $actions = [
        [
        'type' => 'uri',
        'label' => 'โปรโมชั่น',
        'uri' => 'http://www.titf-ttaa.com',
        ],[
        'type' => 'postback',
        'label' => 'ดูผังบูธ',
        'text' => 'plenary',
        'data' => 'message=ไหร่',
        ],[
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
        ],[
        'type' => 'postback',
        'label' => 'ดูผังบูธ',
        'text' => 'plenary',
        'data' => 'message=ไหร่',
        ],[
        'type' => 'uri',
        'label' => 'ดูรายละเอียด',
        'uri' => 'http://www.titf-ttaa.com',
        ]
    ];	
    $columns = [
        [
        'title' => 'อ่าวนางออลซีซั่นส์/ลันตาปุรี จ.กระบี่',
        'text' => 'บูธ CC105 โซน C2',
        'actions' => $actions,
        ],[
        'title' => 'อ่าวนางออลซีซั่นส์/ลันตาปุรี จ.กระบี่',
        'text' => 'บูธ CC105 โซน C2',
        'actions' => $actions2,
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

    echo json_encode($data);
