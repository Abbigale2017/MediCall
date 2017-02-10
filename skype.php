<?php
class ISkypeEvents {

function AttachmentsStatus($status){
echo">Attachment status status\n"."<br/>";
}

function CallStatus($call, $status){
echo">call $call->Id status $status\n"."<br/>";
}

}

$skype = new COM("Skype4COM.Skype");

$sink =& new_ISkypeEvents();
$sink->convert=$skype->convert();


com_event_sink($skype, $sink,"ISkypeEvents");

$convert=$skype->convert;
$convert->language="en";


if(!$skype->client()->isRunning()){
$skype->Client90->start(true, true);
}

if($skype->currentUserStatus() == $convert->textToUserStatus("OFFLINE")){
$skype->changeUserStatus($convert->textToUserStatus("ONLINE"));
}

$user = $skype->user("echo123");
echo"User".$user->handle."online status is".$convert->onlineStatusToText($user->onlineStatus)."<br/>";

$call=$skype->PlaceCall($user->handle);


while(($call->status)<> $convert->textToCallStatus("INPROGRESS")){
if($call->status == $convert->textTocallStatus("FAILED")||
$call->status == $convert->textTocallStatus("REFUSED")||
$call->status == $convert->textTocallStatus("CANCELLED")||
$call->status == $convert->textTocallStatus("FINISHED")||
$call->status == $convert->textTocallStatus("BUSY"))
die("Call status".$convert->callStatusToText($call->status));
else{
com_message_pump(500);
}



com_message_pump(10000);
if($call->status == $convert->textToCallStatus("INPROGRESS"))$call->dtmf="0";

com_message_pump(500);
if($call->status == $convert->textToCallStatus("INPROGRESS"))$call->dtmf="1";

com_message_pump(500);
if($call->status == $convert->textToCallStatus("INPROGRESS"))$call->dtmf="2";

com_message_pump(500);
if($call->status == $convert->textToCallStatus("INPROGRESS"))$call->dtmf="3";

com_message_pump(500);
if($call->status == $convert->textToCallStatus("INPROGRESS"))$call->dtmf="4";

com_message_pump(500);
if($call->status == $convert->textToCallStatus("INPROGRESS"))$call->dtmf="5";

com_message_pump(500);
if($call->status == $convert->textToCallStatus("INPROGRESS"))$call->dtmf="6";

com_message_pump(500);
if($call->status == $convert->textToCallStatus("INPROGRESS"))$call->dtmf="7";

com_message_pump(500);
if($call->status == $convert->textToCallStatus("INPROGRESS"))$call->dtmf="8";

com_message_pump(500);
if($call->status == $convert->textToCallStatus("INPROGRESS"))$call->dtmf="9";


if($call->status <> $convert->textToCallStatus("Finish")) $call->finish();

com_message_pump(1000);
}
?>