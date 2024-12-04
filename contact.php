<?php
  $receiving_email_address = 'your-email@example.com'; // Set the receiving email address

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  // Set up email data
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['fname'] . ' ' . $_POST['lname']; // Concatenate first and last name
  $contact->from_number = $_POST['number'];  // Optional: store the contact number separately
  $contact->from_email = $_POST['email'];
  $contact->subject = $_POST['subject'];

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  $contact->smtp = array(
    'host' => 'smtp.gmail.com',
    'username' => '', // Enter your SMTP username (email)
    'password' => '', // Enter your SMTP password
    'port' => '465'
  );

  // Add messages
  $contact->add_message( $_POST['fname'] . ' ' . $_POST['lname'], 'From');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $_POST['message'], 'Message', 10);

  echo $contact->send();
?>
