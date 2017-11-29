<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'library/PHPMailer/src/Exception.php';
require 'library/PHPMailer/src/PHPMailer.php';
require 'library/PHPMailer/src/SMTP.php';

$name = $_REQUEST['name'];
$phone = $_REQUEST['phone'];
$email = $_REQUEST['email'];
$address = $_REQUEST['address'];
$message= $_REQUEST['message'];

$body = "
<html>
<head>
</head>
<body>
<p>The details of user are as follows:</p>
<p>Name: $name</p>
<p>Phone: $phone</p>
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
$mail->setFrom('arkislightings@gmail.com', 'Arkis');
$mail->AddAddress('info@arkisglobal.com');
$mail->Subject = 'Arkis - Contact form submission';
$mail->MsgHTML($body);

if ($mail->send()) {
    echo "Message sent!";
}

?>