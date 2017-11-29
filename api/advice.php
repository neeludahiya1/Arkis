<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../library/PHPMailer/src/Exception.php';
require '../library/PHPMailer/src/PHPMailer.php';
require '../library/PHPMailer/src/SMTP.php';

$name = $_POST['name'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$address = $_POST['address'];
$message= $_POST['message'];

$to = "info@arkisglobal.com";
$from = "noreply@arkisglobal.com";
$subject = "Arkis - Advice";
$message = "
<html>
<head>
</head>
<body>
<p>The details of user are as follows:</p>
<p>Name: $name</p>
<p>Mobile: $mobile</p>
<p>Email: $email</p>
<p>Address: $address</p>
<p>Message: $message</p>
</body>
</html>
";

$mail = new PHPMailer;
$mail->IsSMTP(); 
$mail->Host = 'smtp.gmail.com';
$mail->SMTPSecure = 'tls';         
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'arkislightings@gmail.com'; 
$mail->Password = 'skc123!@#';
$mail->setFrom($from, 'Arkis');
$mail->AddAddress($to);
$mail->Subject = $subject;
$mail->MsgHTML($message);

// send message
if($mail->send()){
	echo(json_encode(Array('resCode'=>'100','resMsg'=>'success')));
}
else{
	echo(json_encode(Array('resCode'=>'-100','resMsg'=>'failed')));
}

?>