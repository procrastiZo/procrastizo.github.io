<?php
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
$action = $indata['action'];	
if ($action =="newrow"){
$Body    = "<li>$inname recommended $intitle on $indate. This $inoption $intype was rated $inrate. $inname says: $incomments.</li><br/> \n ";
$Body .= file_get_contents("../mainupdate/feed.html");
file_put_contents("../mainupdate/feed.html", $Body);
}else if ($action == "edit") {
$Body    = "<li>$inname edited recommendation: $intitle on $indate. This $inoption $intype was rated $inrate. $inname says: $incomments.</li><br/> \n";
$Body .= file_get_contents("../mainupdate/feed.html");
file_put_contents("../mainupdate/feed.html", $Body);
}else {
$Body    = "<li>$inname deleted $intitle.</li><br/> \n";
$Body .= file_get_contents("../mainupdate/feed.html");
file_put_contents("../mainupdate/feed.html", $Body);	
}
echo "This works";
}
?> 