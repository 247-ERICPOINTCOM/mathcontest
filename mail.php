<?php
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$email_body = "User Name: $name. \n". "User Email: $email. \n". "User Message: $message. \n";
$to = "registrations@mathemacontest.com";
$headers = "From: $email \r\n";
$headers .= "Reply-To: $email \r\n";
mail($to, $subject, $message, $headers);
header("Location: contact.html");
$formcontent=" From: $name \n Email: $email \n Subject: $subject \n Message: $message";
$recipient = "registrations@mathemacontest.com";
$subject = "Registrations";
$mailheader = "From: $email \r\n";
mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
echo "Thank You!" . " -" . "<a href='form.html' style='text-decoration:none;color:#ff0099;'> Return Home</a>";
?>