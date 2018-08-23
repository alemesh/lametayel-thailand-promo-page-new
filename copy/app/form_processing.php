<?php
//****************************************
//edit here
$senderName = 'lametayel-thailand-promo-page';
$senderEmail = $_SERVER['SERVER_NAME'];
$targetEmail = [];
$targetEmail = ['ravit@gofmans.co.il', 'eli@gofmans.co.il', 'order1@lametayel-thailand.com', 'alemesh@acceptic.com'];
//$targetEmail = ['alemesh@acceptic.com'];
$messageSubject = 'Message from web-site - '. $_SERVER['SERVER_NAME'];
$redirectToReferer = true;
$redirectURL = $_SERVER['SERVER_NAME'];
//****************************************

// mail content

//var_dump($_POST); die;
$ufname = $_POST['name'];
//$lfname = $_POST['lname'];
$uphone = $_POST['tel'];
$umail = $_POST['email'];
//$gender1 = $_POST['gender1'];
//$gender2 = $_POST['gender2'];
$gender = $_POST['gender'];

//if ($gender1 != ''){
//    $gender = $gender1;
//} elseif ($gender2 != ''){
//    $gender = $gender2;
//}



// prepare message text
$messageText =	'שם הקמפיין טיסה לילה במלון'."\n".
    'Name: '.$ufname."\n".
    'Phone: '.$uphone."\n".
    'Email: '.$umail."\n".
    'כבר רכשתם כרטיס לתאילנד? '.$gender."\n";


// send email
$senderName = "=?UTF-8?B?" . base64_encode($senderName) . "?=";
$messageSubject = "=?UTF-8?B?" . base64_encode($messageSubject) . "?=";
$messageHeaders = "From: " . $senderName . " <" . $umail . ">\r\n"
    . "MIME-Version: 1.0" . "\r\n"
    . "Content-type: text/plain; charset=UTF-8" . "\r\n";

//if (preg_match('/^[_.0-9a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]{2,4}$/',$targetEmail,$matches))
foreach ($targetEmail as $val){
    mail($val, $messageSubject, $messageText, $messageHeaders);
}


//========== xml backups lids ================

$today = date("F j, Y, g:i a");

$file = 'sample.csv';
$tofile = "$ufname;$uphone;$umail;$gender;$today\n";
$bom = "\xEF\xBB\xBF";
@file_put_contents($file, $bom . $tofile . file_get_contents($file));


$redirectToTnxPage = 'http://landing.lametayel-thailand.com/lp2/thanks-page.html?Lead=true';
//$redirectToTnxPage = 'http://ketzevhagoof.co.il/thanks-page.html?Lead=true';
//$redirectToTnxPage = 'http://192.168.89.147/thanks-page.html?Lead=true';
// redirect
if($redirectToReferer) {
    header("Location: ".$redirectToTnxPage);
} else {
    header("Location: ".$redirectURL);
}

