<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'library/PHPMailer/src/Exception.php';
require 'library/PHPMailer/src/PHPMailer.php';
require 'library/PHPMailer/src/SMTP.php';

$coe = $_POST['coe'];
$nof = $_POST['nof'];
$hpd = $_POST['hpd'];
$dpm = $_POST['dpm'];
$cw = $_POST['cw'];
$lw = $_POST['lw'];

$led_month = $_POST['led_month'];
$led_year = $_POST['led_year'];
$led_2years = $_POST['led_2years'];
$led_10years = $_POST['led_10years'];

$standard_month = $_POST['standard_month'];
$standard_year = $_POST['standard_year'];
$standard_2years = $_POST['standard_2years'];
$standard_10years = $_POST['standard_10years'];

$savings_month = $_POST['savings_month'];
$savings_year = $_POST['savings_year'];
$savings_2years = $_POST['savings_2years'];
$savings_10years = $_POST['savings_10years'];

$csb = $_POST['csb'];
$lrb = $_POST['lrb'];
$hol = $_POST['hol'];
$smc = $_POST['smc'];
$lfc = $_POST['lfc'];

$mc_led1year = $_POST['mc_led1year'];
$mc_led2year = $_POST['mc_led2year'];
$mc_led5year = $_POST['mc_led5year'];
$mc_led10year = $_POST['mc_led10year'];

$mc_standard1year = $_POST['mc_standard1year'];
$mc_standard2year = $_POST['mc_standard2year'];
$mc_standard5year = $_POST['mc_standard5year'];
$mc_standard10year = $_POST['mc_standard10year'];

$mc_savings1year = $_POST['mc_savings1year'];
$mc_savings2year = $_POST['mc_savings2year'];
$mc_savings5year = $_POST['mc_savings5year'];
$mc_savings10year = $_POST['mc_savings10year'];

require('fpdf/fpdf.php');
require('WriteHTML.php');

$pdf=new PDF_HTML();

$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(true, 15);

$pdf->AddPage();

$pdf->SetFont('Arial','B',14);

$pdf->Image('images/header.png',5,0,200);

$pdf->Ln(35);
$pdf->WriteHTML('<h2>LED ROI Report</h2>');

$pdf->SetFont('Arial','',11); 
$form1 = "Cost of Energy per KWH: $coe<br>No of fixtures you have: $nof<br>Hours per day lights are on: $hpd<br>Days a month lights are on: $dpm<br>Current wattage: $cw<br>LED wattage: $lw";
$pdf->WriteHTML2("<br><br>$form1");

$pdf->SetFont('Arial','',11); 

$htmlTable1='<div>CALCULATED ENERGY COSTS OF LED VS STANDARD LIGHTING<br></div>
<TABLE>
<TR>
<TD></TD>
<TD>Month</TD>
<TD>Year</TD>
<TD>2 Years</TD>
<TD>10 Years</TD>
</TR>
<TR>
<TD>Arkis LED</TD>
<TD>'.$led_month.'</TD>
<TD>'.$led_year.'</TD>
<TD>'.$led_2years.'</TD>
<TD>'.$led_10years.'</TD>
</TR>
<TR>
<TD>Standard Fixture</TD>
<TD>'.$standard_month.'</TD>
<TD>'.$standard_year.'</TD>
<TD>'.$standard_2years.'</TD>
<TD>'.$standard_10years.'</TD>
</TR>
<TR>
<TD>Energy Savings</TD>
<TD>'.$savings_month.'</TD>
<TD>'.$savings_year.'</TD>
<TD>'.$savings_2years.'</TD>
<TD>'.$savings_10years.'</TD>
</TR>
</TABLE>';
$pdf->WriteHTML2("<br><br>$htmlTable1");

$pdf->SetFont('Arial','',11); 
$form2 = "Cost of standard bulb: $csb<br>Labor to replace bulb: $lrb<br>Typical hours of life for standard bulb: $hol<br>Est. Years maintenance cost of standard lighting: $smc<br>Initial LED fixture cost: $lfc";
$pdf->WriteHTML2("<br>$form2");

$pdf->SetFont('Arial','',11); 
$htmlTable2='<div>CALCULATED MAINTENANCE COSTS OF LED VS STANDARD LIGHTING<br></div>
<TABLE>
<TR>
<TD></TD>
<TD>Year</TD>
<TD>2 Years</TD>
<TD>5 Years</TD>
<TD>10 Years</TD>
</TR>
<TR>
<TD>Arkis LED</TD>
<TD>'.$mc_led1year.'</TD>
<TD>'.$mc_led2year.'</TD>
<TD>'.$mc_led5year.'</TD>
<TD>'.$mc_led10year.'</TD>
</TR>
<TR>
<TD>Standard Bulb Maintenance</TD>
<TD>'.$mc_standard1year.'</TD>
<TD>'.$mc_standard2year.'</TD>
<TD>'.$mc_standard5year.'</TD>
<TD>'.$mc_standard10year.'</TD>
</TR>
<TR>
<TD>Maintenance Savings</TD>
<TD>'.$mc_savings1year.'</TD>
<TD>'.$mc_savings2year.'</TD>
<TD>'.$mc_savings5year.'</TD>
<TD>'.$mc_savings10year.'</TD>
</TR>
</TABLE>';

$pdf->WriteHTML2("<br><br>$htmlTable2");

//$pdf->Output(); 

// email stuff (change data below)
$to = $_POST['email']; 
$from = "noreply@arkisglobal.com"; 
$subject = "LED ROI Report"; 
$message = "<p>Please see the attachment.</p>";

// attachment name
$filename = "report.pdf";
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
	echo "success";
}
else{
	echo "failed";
}

?>