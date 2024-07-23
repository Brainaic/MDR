<?php
//date_default_timezone_set('Etc/UTC');
require 'PHPMailer/PHPMailerAutoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pdf = $_FILES['pdf']['tmp_name'];

    $mail = new PHPMailer;

    // Tell PHPMailer to use SMTP
    $mail->isSMTP();

    // Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 0;

    // Ask for HTML-friendly debug output
    $mail->Debugoutput = 'html';

    // Set the hostname of the mail server
    $mail->Host = 'server232.web-hosting.com';

    // Set the SMTP port number - likely to be 25, 465, or 587
    $mail->Port = 465;

    // Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'ssl';

    // Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    // Username to use for SMTP authentication
    $mail->Username = 'priemployment@polarviewresources.xyz';

    // Password to use for SMTP authentication
    $mail->Password = 'Polarview2024!';

    // Set who the message is to be sent from
    $mail->setFrom('priemployment@polarviewresources.xyz', 'Polarview Resources');

    // Set an alternative reply-to address
    $mail->addReplyTo('Polarviewresources@gmail.com', 'Polarview Resources');

    // Set who the message is to be sent to
    $mail->addAddress('lola@polarviewresources.com', 'HR');

    // Set the subject line
    $mail->Subject = "PRI employment Results for $name";

    // Read the PDF file into a string
    $pdf_content = file_get_contents($pdf);

    // Attach the uploaded file
    $mail->addStringAttachment($pdf_content, 'assessment_results.pdf', 'base64', 'application/pdf');

    // Message body
    $mail->Body = "Dear HR,\n\nPlease find attached the assessment results for $name ($email).\n\nBest regards,\nPolarview Resources";
    $mail->AltBody = 'This is a plain-text message body';

    // Send the message, check for errors
    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'success';
    }
}
?>