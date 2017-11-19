<?php
ob_start();
session_start();
include('PHPMailerAutoload.php');



$mail= new PHPMailer();//creating instance of php mailer class 


//$mail->IsSMTP();

$mail->Mailer = "smtp";
$mail->Host = "primecomponents.net";
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';

// optional
// used only when SMTP requires authentication  
$mail->SMTPAuth = true;
$mail->Username = 'info@primecomponents.net';
$mail->Password = 'Hx3AD^0sC7Lu';
 

//Set who the message is to be sent from

$mail->setFrom('info@primecomponents.net', 'Administrator');

//Set an alternative reply-to address

$mail->addReplyTo('mukeshtilokani@gmail.com', 'Administrator');

//Set who the message is to be sent to

$mail->addAddress('mukeshtilokani@gmail.com', 'Administrator');

//Set the subject line

$mail->Subject = 'Website Inquiry'; 
        

        $body='

            <div style="color:#fff; background-color:#F9F9F9; font-family:Century Gothic,sans-serif; max-height:60px;  ">

             <img  src="http://prime.demowebsite.in/images/logo.jpg" alt="Prime Components" border="0" style="padding:0              !important;margin:0 !important;height:60px;" title="Prime Components"/></div>



<div style=" clear:both; color:#004895;border:solid 1px #ccc; background-color:#ffffff; font-family:Century Gothic,sans-serif; font-size:14px; ">

  <div style="  padding:10px 20px 20px 20px; color:#424242; ">Hi Rajan Shah ,<br /><br />

  Following website visitor wants to get in touch with you<br />

  Visitor details are as follows :<br><br>

  

   <div style="padding:10px 20px 20px 20px; color:#424242; ">

        <div style="display:table-row"> 

          <div style="display:table-cell"><strong>Name</strong> </div>

          <div style="display:table-cell"> <strong>:</strong> </div>

          <div style="display:table-cell">&nbsp;&nbsp;'.$_POST['name'].'</div>

        </div>

      <div style="display:table-row"> 

          <div style="display:table-cell"><strong>Company</strong> </div>

          <div style="display:table-cell"> <strong>:</strong> </div>

          <div style="display:table-cell">&nbsp;&nbsp;'.$_POST['company'].'</div>

        </div>

		  <div style="display:table-row"> 

          <div style="display:table-cell"><strong>Email</strong> </div>

          <div style="display:table-cell"> <strong>:</strong> </div>

          <div style="display:table-cell">&nbsp;&nbsp;'.$_POST['email'].'</div>

        </div>

      <div style="display:table-row"> 

          <div style="display:table-cell"><strong>Phone</strong> </div>

          <div style="display:table-cell"> <strong>:</strong> </div>

          <div style="display:table-cell">&nbsp;&nbsp;'.$_POST['phone'].'</div>

        </div>

        <div style="display:table-row"> 

          <div style="display:table-cell"><strong>Address</strong> </div>

          <div style="display:table-cell"> <strong>:</strong> </div>

          <div style="display:table-cell">&nbsp;&nbsp;'.$_POST['address'].'</div>

        </div>

        <div style="display:table-row"> 

          <div style="display:table-cell"><strong>Message</strong> </div>

          <div style="display:table-cell"> <strong>:</strong> </div>

          <div style="display:table-cell">&nbsp;&nbsp;'.$_POST['comments'].'</div>

        </div>

    </div>

  <br /><br />

    With Warm Regards,<br /><br />

    <strong>Rajan Shah</strong>

    <br />

	

	Prime Components<br>	​

	830 GIDC Estate, Makarpura,<br>	​​

	Baroda, Gujarat 390010, India<br>

    

  

  

   

  <div style="border-bottom: 4px solid #ccc;color: #444444;font-size: 11px;font-weight: bold;line-height: 0;padding: 2px 20px 15px;text-align: right;"> Lead Capture Powered by 

  

  <a href="http://www.shivamnetwork.com" target="_blank" style="color:#444"><img  src="http://prime.demowebsite.in/images/shivamnetwork_logo.png" alt="Shivam Network" border="0" style="padding:0 !important;margin:0 !important;height:30px;" title="Shivam Network"/></a> 

              

  </div>';    

  

  //Read an HTML message body from an external file, convert referenced images to embedded,

//convert HTML into a basic plain-text alternative body

$mail->msgHTML($body);

//Replace the plain text body with one created manually

  

        

       if (!$mail->send()) {

    echo "Mailer Error: " . $mail->ErrorInfo;

} else {

    echo "Message sent to administrator!  ";

} 


$mail= new PHPMailer();//creating instance of php mailer class 


//$mail->IsSMTP();

$mail->Mailer = "smtp";
$mail->Host = "primecomponents.net";
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';

// optional
// used only when SMTP requires authentication  
$mail->SMTPAuth = true;
$mail->Username = 'info@primecomponents.net';
$mail->Password = 'Hx3AD^0sC7Lu';

//Set who the message is to be sent from

$mail->setFrom('info@primecomponents.net', 'Prime Components');

//Set an alternative reply-to address

$mail->addReplyTo($_POST['email'], $_POST['name']);

//Set who the message is to be sent to

$mail->addAddress($_POST['email'], $_POST['name']);

//Set the subject line

$mail->Subject = 'Thank you for contacting Prime Components'; 

 $body='

             <div style="color:#fff; background-color:#F9F9F9; font-family:Century Gothic,sans-serif; max-height:60px;  ">

             <img  src="http://prime.demowebsite.in/images/logo.jpg" alt="Prime Components" border="0" style="padding:0              !important;margin:0 !important;height:60px" title="Prime Components"/></div>



              <div style=" clear:both; color:#004895;border:solid 1px #ccc; background-color:#ffffff; font-family:Century Gothic,sans-serif;              font-size:14px; ">

              <div style="padding:10px 20px 20px 20px; color:#424242; ">Hi '.$_POST['name'].',<br /><br />

              Thank you for your interest in Prime Components.<br /><br/>  

              



              

              We will be in touch with you shortly.<br>

              

              

               With Warm Regards,<br /><br />

				<strong>Rajan Shah</strong>

    <br />

	

	Prime Components<br>	​

	830/2 GIDC Estate, Makarpura,<br>	​​

	Baroda, Gujarat 390010, India<br>

	 

   

   <div style="border-bottom: 4px solid #ccc;color: #444444;font-size: 11px;font-weight: bold;line-height: 0;padding: 2px 20px 15px;text-align: right;"> Lead Capture Powered by 

  

  <a href="http://www.shivamnetwork.com" target="_blank" style="color:#444"><img  src="http://prime.demowebsite.in/images/shivamnetwork_logo.png" alt="Shivam Network" border="0" style="padding:0 !important;margin:0 !important;height:30px;" title="Shivam Network"/></a> 

              

  </div>';

$mail->msgHTML($body);

//Replace the plain text body with one created manually

  

        

       if (!$mail->send()) {

    echo "Mailer Error: " . $mail->ErrorInfo;

} else {

    echo "  Message sent to visitor!";

} 

?>

