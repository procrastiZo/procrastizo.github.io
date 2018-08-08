<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require "../mainupdate/src/Exception.php";
require "../mainupdate/src/PHPMailer.php";
require "../mainupdate/src/SMTP.php";
$input = file_get_contents('php://input');
if ($input){
$indata = json_decode( $input, true );
$inname	= $indata['Name'];
$intitle= $indata['showTitle'];	
$indate	= $indata['recommendedOn'];		
$inrate	= $indata['rating'];
$intype	= $indata['types'];	
$inoption = $indata['options'];		
$incomments	= $indata['comments'];	
$file = "../mainupdate/content/user.json";
$something = count(file($file)) -3;
$that = file_get_contents($file); 
$data = json_decode($that,true);
$i= 0; 
While ($i <= $something){

$name = $data[$i]['Name'];
$to   = $data[$i]['Email'];
$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.office365.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'procrastistation@hotmail.com';                 // SMTP username
$mail->Password = '1006863656theone';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
$mail->Port = 587;

$mail->From = 'procrastistation@hotmail.com';
$mail->FromName = 'Procrastistation';
$mail->addAddress("$to");               // Name is optional
$mail->addReplyTo('procrastistation@hotmail.com', 'Procrastistation');

$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'New Post!';
$mail->Body    = "Hello $name, <br/> <b>There Was A New Post!</b> <br/> $inname recommended $intitle on $indate. This $inoption $intype was rated $inrate. Also, $incomments.";
$mail->AltBody = "Hello $name, \n There Was A New Post! \n $inname recommended $intitle on $indate. This $inoption $intype was rated $inrate. Also, $incomments.";

$mail->send();
  
 $i++; }
  echo 'Message has been sent ';
}

?> 