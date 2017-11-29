<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'library/PHPMailer/src/Exception.php';
require 'library/PHPMailer/src/PHPMailer.php';
require 'library/PHPMailer/src/SMTP.php';

$name = $_POST['name'];
$qty = $_POST['qty'];
$watt = $_POST['watt'];
$mrp = $_POST['mrp'];
$cost = $_POST['cost'];

require('fpdf/fpdf.php');
require('WriteHTML.php');

$pdf=new PDF_HTML();

$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(true, 15);

$pdf->AddPage();

$pdf->SetFont('Arial','B',14);

$pdf->Image('images/header.png',5,0,200);

$pdf->Ln(35);

$pdf->SetFont('Arial','',12); 
$pdf->WriteHTML('<p>To: Mr./Ms. '.$name.'</p>');
$pdf->Ln(8);
$pdf->WriteHTML('<p>Subject: Quotation for LED '.$watt.'W'.'</p>');

$pdf->SetFont('Arial','',11); 
$htmlTable1='
<TABLE>
<TR>
<TD>Particular</TD>
<TD>Quantity</TD>
<TD>MRP</TD>
<TD>Rate</TD>
<TD>Total</TD>
</TR>
<TR>
<TD>LED '.$watt.'W</TD>
<TD>'.$qty.'</TD>
<TD>'.$mrp.'</TD>
<TD>'.$cost.'</TD>
<TD>'.$cost*$qty.'</TD>
</TR>
</TABLE>';

$pdf->WriteHTML2("<br><br>$htmlTable1");

// email stuff (change data below)
$to = $_POST['email']; 
$from = "noreply@arkisglobal.com"; 
$subject = "Arkis - Quotation"; 
$message = "<p>Please see the attachment.</p>";

// a random hash will be necessary to send mixed content
$separator = md5(time());

// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;

// attachment name
$filename = "quotation.pdf";
$attachment = $pdf->Output($filename, 'S');

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
$mail->AddStringAttachment($attachment, $filename);

// send message
if($mail->send()){
	echo(json_encode(Array('resCode'=>'100','resMsg'=>'success')));
}
else{
	echo(json_encode(Array('resCode'=>'-100','resMsg'=>'failed')));
}

?>