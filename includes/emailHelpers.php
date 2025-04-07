<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * Send an email using SendGrid.
 *
 * @param string $toEmail Email for To address.
 * @param string $subject Subject line.
 * @param string $htmlBody HTML body content.
 * @param string $altBody Plain text body content (alternate to HTML).
 * @return boolean True if email sends successfully.
 */
function sendEmail(string $toEmail, string $subject, string $htmlBody, string $altBody = ""): bool {


  //Create an instance; passing `true` enables exceptions
  $mail = new PHPMailer(true);

  try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.sendgrid.net';                    //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'apikey';                               //SMTP username
    $mail->Password   = SENDGRID_API_KEY;                       //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    // Email sender (don't change)
    $mail->setFrom('website@hornsbytafe.com', 'Hornsby TAFE Website');

    // Email recipients
    $mail->addAddress($toEmail);
    // $mail->addAddress('joe@example.net', 'Joe User');     // Recipient with a name
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    // Content (HTML email)
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $htmlBody;
    $mail->AltBody = $altBody;

    // Try sending the email
    $mail->send();
    
    // Email successfully sent
    // echo 'Message has been sent';
    return true;

  } catch (Exception $e) {
      
    // Email failed to send
    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    return false;

  }

}