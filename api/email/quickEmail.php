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
        

$body = '<div class="mj-container" style="background-color:#eee;"><!--[if mso | IE]>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">
        <tr>
          <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
      <![endif]--><div style="margin:0px auto;max-width:600px;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" align="center" border="0"><tbody><tr><td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:20px;"><!--[if mso | IE]>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td style="vertical-align:top;width:600px;">
      <![endif]--><div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;"><table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0"><tbody></tbody></table></div><!--[if mso | IE]>
      </td></tr></table>
      <![endif]--></td></tr></tbody></table></div><!--[if mso | IE]>
      </td></tr></table>
      <![endif]-->
      <!--[if mso | IE]>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">
        <tr>
          <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
      <![endif]--><div style="margin:0px auto;max-width:600px;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" align="center" border="0"><tbody><tr><td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:10px;"><!--[if mso | IE]>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td style="width:600px;">
      <![endif]--><div style="margin:0px auto;border-radius:5px;max-width:600px;background:#fff;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;border-radius:5px;background:#fff;" align="center" border="0"><tbody><tr><td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:20px 0px;padding-bottom:0px;"><!--[if mso | IE]>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td style="vertical-align:top;width:600px;">
      <![endif]--><div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;"><table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-wrap:break-word;font-size:0px;padding:10px 25px;" align="center"><table role="presentation" cellpadding="0" cellspacing="0" style="border-collapse:collapse;border-spacing:0px;" align="center" border="0"><tbody><tr><td style="width:250px;"><a href="http://primecomponents.net/" target="_blank"><img alt="" title="" height="auto" src="http://primecomponents.net/images/logo.png" style="border:none;border-radius:0px;display:block;font-size:13px;outline:none;text-decoration:none;width:100%;height:auto;" width="250"></a></td></tr></tbody></table></td></tr></tbody></table></div><!--[if mso | IE]>
      </td></tr></table>
      <![endif]--></td></tr></tbody></table></div><!--[if mso | IE]>
        </td>
      </tr>
      <tr>
        <td style="width:600px;">
      <![endif]--><div style="margin:0px auto;border-radius:5px;max-width:600px;background:#fff;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;border-radius:5px;background:#fff;" align="center" border="0"><tbody><tr><td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:20px 0px;"><!--[if mso | IE]>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td style="vertical-align:middle;width:600px;">
      <![endif]--><div class="mj-column-per-100 outlook-group-fix" style="vertical-align:middle;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;"><table role="presentation" cellpadding="0" cellspacing="0" style="vertical-align:middle;" width="100%" border="0"><tbody><tr><td style="word-wrap:break-word;font-size:0px;padding:10px 25px;" align="left"><div style="cursor:auto;color:#555;font-family:\'Droid Sans\', sans-serif;font-size:16px;font-weight:300;line-height:24px;text-align:left;"><p>Hello Mr. Rajan,<br>Following website visitor wants to get in touch with you. Visitor details are as follows :<br><br>
                <span><b>Name :</b></span> '.$_POST['name'].'<br>
                <span><b>Company  :</b></span> '.$_POST['company'].'<br>
                <span><b>Email  :</b></span> '.$_POST['email'].'<br>
                <span><b>Phone  :</b></span> '.$_POST['phone'].'<br>
                <span><b>Message  :</b></span> '.$_POST['comments'].'<br>
              </p></div></td></tr></tbody></table></div><!--[if mso | IE]>
      </td></tr></table>
      <![endif]--></td></tr></tbody></table></div><!--[if mso | IE]>
        </td>
      </tr>
      <tr>
        <td style="width:600px;">
      <![endif]--><div style="margin:0px auto;max-width:600px;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" align="center" border="0"><tbody><tr><td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:20px 0px;"><!--[if mso | IE]>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td style="vertical-align:top;width:600px;">
      <![endif]--><div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;"><table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-wrap:break-word;font-size:0px;padding:10px 25px;" align="center"><div style="cursor:auto;color:#555;font-family:\'Droid Sans\', sans-serif;font-size:16px;font-weight:300;line-height:24px;text-align:center;"><p style="line-height:14px">
        <small>© 2017 Prime Components, All rights reserved.
        </small>
      </p></div></td></tr></tbody></table></div><!--[if mso | IE]>
      </td></tr></table>
      <![endif]--></td></tr></tbody></table></div><!--[if mso | IE]>
          </td>
        </tr>
      </table>
      <![endif]--></td></tr></tbody></table></div><!--[if mso | IE]>
      </td></tr></table>
      <![endif]--></div>';
  

  //Read an HTML message body from an external file, convert referenced images to embedded,

//convert HTML into a basic plain-text alternative body

$mail->msgHTML($body);

//Replace the plain text body with one created manually

$mail->send();


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


$body = '<div class="mj-container" style="background-color:#eee;"><!--[if mso | IE]>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">
        <tr>
          <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
      <![endif]--><div style="margin:0px auto;max-width:600px;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" align="center" border="0"><tbody><tr><td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:20px;"><!--[if mso | IE]>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td style="vertical-align:top;width:600px;">
      <![endif]--><div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;"><table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0"><tbody></tbody></table></div><!--[if mso | IE]>
      </td></tr></table>
      <![endif]--></td></tr></tbody></table></div><!--[if mso | IE]>
      </td></tr></table>
      <![endif]-->
      <!--[if mso | IE]>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">
        <tr>
          <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
      <![endif]--><div style="margin:0px auto;max-width:600px;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" align="center" border="0"><tbody><tr><td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:10px;"><!--[if mso | IE]>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td style="width:600px;">
      <![endif]--><div style="margin:0px auto;border-radius:5px;max-width:600px;background:#fff;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;border-radius:5px;background:#fff;" align="center" border="0"><tbody><tr><td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:20px 0px;padding-bottom:0px;"><!--[if mso | IE]>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td style="vertical-align:top;width:600px;">
      <![endif]--><div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;"><table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-wrap:break-word;font-size:0px;padding:10px 25px;" align="center"><table role="presentation" cellpadding="0" cellspacing="0" style="border-collapse:collapse;border-spacing:0px;" align="center" border="0"><tbody><tr><td style="width:250px;"><a href="http://primecomponents.net/" target="_blank"><img alt="" title="" height="auto" src="http://primecomponents.net/images/logo.png" style="border:none;border-radius:0px;display:block;font-size:13px;outline:none;text-decoration:none;width:100%;height:auto;" width="250"></a></td></tr></tbody></table></td></tr></tbody></table></div><!--[if mso | IE]>
      </td></tr></table>
      <![endif]--></td></tr></tbody></table></div><!--[if mso | IE]>
        </td>
      </tr>
      <tr>
        <td style="width:600px;">
      <![endif]--><div style="margin:0px auto;border-radius:5px;max-width:600px;background:#fff;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;border-radius:5px;background:#fff;" align="center" border="0"><tbody><tr><td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:20px 0px;"><!--[if mso | IE]>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td style="vertical-align:middle;width:600px;">
      <![endif]--><div class="mj-column-per-100 outlook-group-fix" style="vertical-align:middle;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;"><table role="presentation" cellpadding="0" cellspacing="0" style="vertical-align:middle;" width="100%" border="0"><tbody><tr><td style="word-wrap:break-word;font-size:0px;padding:10px 25px;" align="left"><div style="cursor:auto;color:#555;font-family:\'Droid Sans\', sans-serif;font-size:16px;font-weight:300;line-height:24px;text-align:left;"><p>Hi '.$_POST['name'].',<br>
              Thank you for your interest in Prime Components.<br>We will be in touch with you shortly.<br><br>With Warm Regards,<br>
                <strong>Rajan Shah</strong>
    <br>
  Prime Components<br>
  830/2 GIDC Estate, Makarpura,<br>
  Baroda, Gujarat 390010, India<br>
              </p></div></td></tr></tbody></table></div><!--[if mso | IE]>
      </td></tr></table>
      <![endif]--></td></tr></tbody></table></div><!--[if mso | IE]>
        </td>
      </tr>
      <tr>
        <td style="width:600px;">
      <![endif]--><div style="margin:0px auto;max-width:600px;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" align="center" border="0"><tbody><tr><td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:20px 0px;"><!--[if mso | IE]>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td style="vertical-align:top;width:600px;">
      <![endif]--><div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;"><table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-wrap:break-word;font-size:0px;padding:10px 25px;" align="center"><div style="cursor:auto;color:#555;font-family:\'Droid Sans\', sans-serif;font-size:16px;font-weight:300;line-height:24px;text-align:center;"><p style="line-height:14px">
        <small>© 2017 Prime Components, All rights reserved.
        </small>
      </p></div></td></tr></tbody></table></div><!--[if mso | IE]>
      </td></tr></table>
      <![endif]--></td></tr></tbody></table></div><!--[if mso | IE]>
          </td>
        </tr>
      </table>
      <![endif]--></td></tr></tbody></table></div><!--[if mso | IE]>
      </td></tr></table>
      <![endif]--></div>';

$mail->msgHTML($body);

//Replace the plain text body with one created manually      

$mail->send();


return json_encode(array('status' => 'success'));


?>

