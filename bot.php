<?php
$access_token = 'bgcpus2P5KwACpu1UXUqwCaTmNG98QXQXzx7kNvG2mnr4LKQpDo3DHKRwK/ShDBN8DuOTST/+8C5VhzObnEEF2OTSY3vEtnrOrL65QwHqjOfpm9R8HjlInUDtPf4J6hvMqsq7LZ4DdU4rW1MrvVI5AdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
$data = json_decode($json,true);
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
 // Loop through each event
 foreach ($events['events'] as $event) {
  // Reply only when message sent is in 'text' format
  if ($event['type'] == 'message' && $event['message']['type'] == 'sticker'){
//       || $event['type'] == 'message' && $event['message']['type'] == 'text') {
   
   // Get replyToken
   $replyToken = $event['replyToken'];
   // Build message to reply back
   $messages = [
    'type'=> 'sticker',
    'packageId'=> '2',
    'stickerId'=> '24'
   ];
  
  }else if ($event['type'] == 'message' && $event['message']['text'] == "สวัสดี"){
    $replyToken = $event['replyToken'];    
   $messages = [
     'type' => 'text',
     'text' => "สวัสดีจ้า" || 'text' => "สวัสดีค่ะ"
     ]; 

  }else if ($event['type'] == 'message' && $event['message']['text'] == "ชื่ออะไร"){
    $replyToken = $event['replyToken'];   
   $messages = [
     'type' => 'text',
     'text' => "เราชื่อ botbot นะ"
     ];
   
  }else{
   $replyToken = $event['replyToken'];
   $text = "พิมพ์ใหม่อีกทีนะ";
    $messages = [
     'type' => 'text',
     'text' => $text
     ]; 
  } 
}
}


// echo "OK"; 
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
      
