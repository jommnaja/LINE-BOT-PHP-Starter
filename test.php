<?php
    header('Content-Type: application/json');

    $replyToken = 1;
    $type = 'template';

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

    echo json_encode($data);
