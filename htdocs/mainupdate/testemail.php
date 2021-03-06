<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';
$input = file_get_contents('php://input');
if ($input){
$data = json_decode( $input, true );
$name = $data['Name'];
$to      = $data['Email'];

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

$mail->Subject = 'Subscription Verification';
$mail->Body    = "Hello $name, <br/> <b>Thank You For Subscribing!</b>";
$mail->AltBody = "Hello $name, \n Thank You For Subscribing!";

if(!$mail->send()) {
    echo "Please Try Again \n";
    echo 'Error: ' . $mail->ErrorInfo;
} else {
$fh = fopen(__DIR__ . '/content/user.json', 'r+'); //opens the row.json file for reading and writing (dir is the current directory, so you dont have to say C:/ bla bal)
$stat = fstat($fh); //read the information about the file, you can use the ['size'] index to read how many characters the file has
// load the data and delete the line from the array 
$lines = file(__DIR__ . '/content/user.json'); 
$last = sizeof($lines) - 1 ; 
unset($lines[$last]); 
// write the new data to the file 
$fp = fopen(__DIR__ . '/content/user.json', 'w'); 
fwrite($fp, implode('', $lines)); 
fclose($fp);
if($stat['size']< 5) {	// if the file is less than 5 characters (4 characters make the two brackets and newline) then the file has now rows
file_put_contents(__DIR__ . '/content/user.json', "$input \n]" , FILE_APPEND);} //if no rows then save the new row (without comma) and close the bracket back with newline '\n]'
else { // if there are other rows then
file_put_contents(__DIR__ . '/content/user.json', ", $input \n]" , FILE_APPEND);} // save the new row at the end of the file (with comma for formatting) and close the bracket back
echo 'Account has been saved, check email for verification';
}

;}
?> 