<?php 
$accessToken = 'ZVl4G9PbMVNOGnDQSFPvCH9+cooj0wsEqjaT9MvrlGtcSt4xHEmU6bIfGwyFfX8Fl3/sqBTjSXsukYEdvT+eA4ePsDEZ1Jm8AHfxLRNdH0eA/1Q1raZlo4Jdk40iGhTcNjEn7UAsuSrEyJl5dL94ngdB04t89/1O/w1cDnyilFU=';

$jsonString = file_get_contents('php://input'); error_log($jsonString); 
$jsonObj = json_decode($jsonString); $message = $jsonObj->{"events"}[0]->{"message"}; 
$replyToken = $jsonObj->{"events"}[0]->{"replyToken"};


 // 送られてきたメッセージの中身からレスポンスのタイプを選択 
     // カルーセルタイプ 
    $messageData = [ 
        'type' => 'template', 
        'altText' => 'カルーセル', 
        'template' => [
             'type' => 'carousel', 
            'columns' => [ 
                [ 
                    'title' => 'カルーセル1', 
                    'text' => 'カルーセル1です',
	             'imageUrl' => 'https://pompon-blog.com/me_bot/images/1024x1024isi.png', 
                     'actions' => [
                         [
                            'type' => 'postback',
                             'label' => 'webhookにpost送信',
                             'data' => 'value'
                         ],
                         [ 
                            'type' => 'uri', 
                            'label' => '美容の口コミ広場を見る',
                             'uri' => 'https://report.clinic/'
                         ] 
                    ] 
                ],
                 [ 
                        'title' => 'カルーセル2', 
                        'text' => 'カルーセル2です', 
	                'imageUrl' => 'https://pompon-blog.com/me_bot/images/1024x1024isi.png', 
                        'actions' => [ 
                            [
                                'type' => 'postback', 
                                'label' => 'webhookにpost送信', 
                                'data' => 'value' 
                            ], 
                            [ 
                                'type' => 'uri', 
                                'label' => '女美会を見る', 
                                'uri' => 'https://jobikai.com/' 
                            ] 
                        ] 
                    ], 
                ] 
            ] 
    ];
$response = [ 'replyToken' => $replyToken, 'messages' => [$messageData] ]; 
error_log(json_encode($response)); 
$ch = curl_init('https://api.line.me/v2/bot/message/reply'); 
curl_setopt($ch, CURLOPT_POST, true); 
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST'); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response)); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json; charser=UTF-8', 'Authorization: Bearer ' . $accessToken )); 
$result = curl_exec($ch); error_log($result); 
curl_close($ch);