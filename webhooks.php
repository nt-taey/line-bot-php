<?php
    $accessToken = "PPLeneSW5Ii33lV/Hxv0muQbev82URJNkZd6uPB2BrYLB5gLHc7UMYJBb+bokXCDQbY+NVYZYEzXcnUbs5xa1eiKoXEviqADUsEk9oESWeL5Run4pPAnElHf3iBHZ/LA4Mi6jwclzLDLiqS0RyksKQdB04t89/1O/w1cDnyilFU=";

    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content,true);

    $arrayHeader = array();
    $arrayHeader = "content-Type: application/json";
    $arrayHeader = "Authorization: Bearer {$accessToken}";

    //รับข้อความจากผู้ใช้
    $message = $arrayJson['events'][0]['message']['text'];

#Ex. Message Type "Text"
    if($message == "สวัสดี")
    {
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "สวัสดีจร้าาา";
        replyMsg($arrayHeader,$arrayPostData);
    }
#Ex. Message Type "Sticker"
    else if($message == "ฝันดี")
    {
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "sticker";
        $arrayPostData['messages'][0]['packageId'] = "2";
        $arrayPostData['messages'][0]['stickerId'] = "46";
        replyMsg($arrayHeader,$arrayPostData);
    }
#Ex. Message Type "Image"
#Ex. Message Type "Location"
    else if($message == "พิกัดสยามพารากอน")
    {
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "location";
        $arrayPostData['messages'][0]['title'] = "สยามพารากอน";
        $arrayPostData['messages'][0]['address'] = "13.746534,100.532752";
        $arrayPostData['messages'][0]['latitude'] = "13.7465354";
        $arrayPostData['messages'][0]['longitude'] = "100.532752";
        replyMsg($arrayHeader,$arrayPostData);
    }
#Ex. Message Type "Text + Sticker"
    else if($message == "ลาก่อน")
    {
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "อย่าทิ้งกันไปเลย...";
        $arrayPostData['messages'][0]['type'] = "sticker";
        $arrayPostData['messages'][0]['packageId'] = "1";
        $arrayPostData['messages'][0]['stickerId'] = "131";
        replyMsg($arrayHeader,$arrayPostData);
    }
    else
    {
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "ขอโทษด้วยจร้าา...ฉันไม่เข้าคำสั่ง T.T";
        $arrayPostData['messages'][0]['type'] = "sticker";
        $arrayPostData['messages'][0]['packageId'] = "2";
        $arrayPostData['messages'][0]['stickerId'] = "173";
        replyMsg($arrayHeader,$arrayPostData);
    }
function replyMsg($arrayHeader,$arrayPostData)
    {
        $strUrl = "https://api.line.me/v2/bot/message/reply";
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$strUrl);
        curl_setopt($ch,CURLOPT_HEADER,false);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$arrayHeader);
        curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($arrayPostData));
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        $result = curl_exec($ch);
        curl_close($ch);
    }
exit;
?>