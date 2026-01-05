<?php
// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

// Load PHPMailer classes
require_once __DIR__ . '/src/PHPMailer.php';
require_once __DIR__ . '/src/SMTP.php';
require_once __DIR__ . '/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// SMTP Configuration - Hostinger
define('SMTP_HOST', 'smtp.hostinger.com');
define('SMTP_PORT', 465);
define('SMTP_USERNAME', 'inquire@innodatasolutions.net'); // Replace with your email
define('SMTP_PASSWORD', 'P@$$w0rd122028'); // Replace with your password
define('SMTP_FROM_EMAIL', 'inquire@innodatasolutions.net'); // Replace with your email
define('SMTP_FROM_NAME', 'Innodata Contact Form');
define('RECIPIENT_EMAIL', 'inquire@innodatasolutions.net'); // Where to receive emails

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Sanitize and validate input
    $fname = htmlspecialchars(trim($_POST['fname'] ?? ''));
    $lname = htmlspecialchars(trim($_POST['lname'] ?? ''));
    $number = htmlspecialchars(trim($_POST['number'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST['subject'] ?? 'New Contact Form Submission'));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));

    // Validate required fields
    if (empty($fname) || empty($lname) || empty($email) || empty($message)) {
        echo 'Please fill in all required fields.';
        exit;
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Invalid email address.';
        exit;
    }

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                                       // Disable debug output (set to 2 for testing)
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = SMTP_HOST;                              // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = SMTP_USERNAME;                          // SMTP username
        $mail->Password   = SMTP_PASSWORD;                          // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable SSL encryption
        $mail->Port       = SMTP_PORT;                              // TCP port to connect to

        //Recipients
        $mail->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
        $mail->addAddress(RECIPIENT_EMAIL);                         // Add a recipient
        $mail->addReplyTo($email, "$fname $lname");                // Reply to customer

        //Content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = $subject;
        
        // Create HTML email body
        $mail->Body = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background-color: #007cff; color: white; padding: 20px; text-align: center; }
                .content { background-color: #f9f9f9; padding: 20px; }
                .field { margin-bottom: 15px; }
                .label { font-weight: bold; color: #007cff; }
                .footer { text-align: center; padding: 20px; font-size: 12px; color: #666; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>New Contact Form Submission</h2>
                </div>
                <div class='content'>
                    <div class='field'>
                        <span class='label'>Name:</span> $fname $lname
                    </div>
                    <div class='field'>
                        <span class='label'>Email:</span> $email
                    </div>
                    <div class='field'>
                        <span class='label'>Contact Number:</span> $number
                    </div>
                    <div class='field'>
                        <span class='label'>Subject:</span> $subject
                    </div>
                    <div class='field'>
                        <span class='label'>Message:</span><br>
                        " . nl2br($message) . "
                    </div>
                </div>
                <div class='footer'>
                    This email was sent from the Innodata contact form.
                </div>
            </div>
        </body>
        </html>
        ";
        
        // Plain text version
        $mail->AltBody = "New Contact Form Submission\n\n" .
                        "Name: $fname $lname\n" .
                        "Email: $email\n" .
                        "Contact Number: $number\n" .
                        "Subject: $subject\n\n" .
                        "Message:\n$message\n\n" .
                        "This email was sent from the Innodata contact form.";

        $mail->send();
        echo 'OK';
        
    } catch (Exception $e) {
        echo "Message could not be sent. Error: {$mail->ErrorInfo}";
    }
    
} else {
    echo 'Invalid request method.';
}





// <?php
//   /**
//   * Requires the "PHP Email Form" library
//   * The "PHP Email Form" library is available only in the pro version of the template
//   * The library should be uploaded to: vendor/php-email-form/php-email-form.php
//   * For more info and help: https://bootstrapmade.com/php-email-form/
//   */

//   // Replace contact@example.com with your real receiving email address
//   $receiving_email_address = 'systemdeveloper.paul@gmail.com';

//   // if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
//     // include( $php_email_form );
//   // } else {
//     // die( 'Unable to load the "PHP Email Form" Library!');
//   // }

//   $contact = new PHP_Email_Form;
//   $contact->ajax = true;
  
//   $contact->to = $receiving_email_address;
//   $contact->from_name = $_POST['name'];
//   $contact->from_email = $_POST['email'];
//   $contact->subject = $_POST['subject'];

//   // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
//   // smtp.Port = 8889;
//   // smtp.Host = "mail5016.site4now.net"; //for gmail host  
//   // smtp.EnableSsl = false;
//   // // smtp.UseDefaultCredentials = false;
//   // smtp.Credentials = new NetworkCredential("mailer@ourladyofguadalupeschool.online", "!@Passw0rd");


//   $contact->smtp = array(
//     'host' => 'mail5016.site4now.net',
//     'username' => 'mailer@ourladyofguadalupeschool.online',
//     'password' => '!@Passw0rd',
//     'port' => '8889'
//   );
 

//   $contact->add_message( $_POST['name'], 'From');
//   $contact->add_message( $_POST['email'], 'Email');
//   $contact->add_message( $_POST['message'], 'Message', 10);

//   echo $contact->send();
?>
