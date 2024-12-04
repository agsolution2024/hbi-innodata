<?php
//   $contact->smtp = array(
//     'host' => 'mail5016.site4now.net',
//     'username' => 'mailer@ourladyofguadalupeschool.online',
//     'password' => '!@Passw0rd',
//     'port' => '8889'
//   );
use src\PHPMailer;
use src\SMTP;
use src\Exception;

//Load Composer's autoloader
// require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail5016.site4now.net';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'mailer@ourladyofguadalupeschool.online';                     //SMTP username
    $mail->Password   = '!@Passw0rd';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 8889;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('test@example.com', 'Mailer');
    $mail->addAddress('systemdeveloper.paul@gmail.com', 'Joe User');     //Add a recipient



    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
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
