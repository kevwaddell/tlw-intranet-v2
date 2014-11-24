<?php 
$default_tz = date_default_timezone_get();
date_default_timezone_set('Europe/London'); 
$now = strtotime("now");
$to_email = $_POST['to_email'];
$from_email = $_POST['from_email'];
$from_name = $_POST['from_name'];
$email_subject = $_POST['subject'];
$email_content = apply_filters('the_content',$_POST['message']);

if ($nickname != $user_name) {
$message_to = $nickname;
} else {
$message_to = $firstname;	
}

$subject = 'Sent via '.get_bloginfo('name').' '.get_bloginfo('description').' - [' .$email_subject. ']';
$message = '<p>Hi '.$message_to. '</p>';
$message .= $email_content;
$message .= '<p><strong>Message sent by '.$from_name.'.</strong></p>';
$message .= '<p style="text-align: center;">---------------***---------------</p>';
$message .= '<p style="text-align: center;"><strong>Sent on '. date('D jS F Y', $now) .' at '. date('H:i', $now).'</strong></p>';
$headers = 'From: '.$from_name.'<'.$from_email.'>';

//echo '<pre>';print_r($message);echo '</pre>';

function wps_set_content_type(){return "text/html";}

add_filter( 'wp_mail_content_type','wps_set_content_type' );

if ($_SERVER['REMOTE_ADDR'] != '127.0.0.1') {

$email_sent = wp_mail( $to_email, $subject, $message, $headers );		

} else {
$email_sent = wp_mail( "kevwaddell@icloud.com", $subject, $message, $headers );
}

/*
echo '<pre>';
print_r($email_sent);
echo '<br>';
echo '<br>';
echo '<br>';
print_r($to_email);
echo '<br>';
print_r($from_email);
echo ' | ';
print_r($from_name);
echo '<br>';
print_r($email_subject);
echo '<br>';
print_r($email_content);
echo '</pre>';
*/

remove_filter( 'wp_mail_content_type', 'set_html_content_type' );

date_default_timezone_set($default_tz); 
?>