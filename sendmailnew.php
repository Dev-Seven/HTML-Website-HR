
<?php
    require('phpmailer/PHPMailerAutoload.php');

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $cdp = trim($_POST['cdp']);
    //$interest = $_POST['interest'];
    $message = trim($_POST['message']);

    if($name && $email && $message && $cdp){
  		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  		{
        $isSuccess = false;
        $msg = 'Invalid email. Please check';
      }
      else{
          // Format the checkbox values
          // $interest_message = '';
          // for ($i = 0; $i < count($interest); $i++) {
          //   if ($i === count($interest) - 1) {
          //     $interest_message .= $interest[$i];
          //   } else {
          //     $interest_message .= $interest[$i] . ', ';
          //   }
          // }

		  
		  
		 $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->Username = '*'; // YOUR gmail email  
   $mail->Password = '*';

  
		
    $mail->setFrom('*', '');
    $mail->addAddress('*', '');

          $mail->addReplyTo($email, $name);
       //   $mail->addBcc($email);
          $mail->isHTML(true);                                  // Set email format to HTML

          $mail->Subject = 'New Contact Inquiry from Nightingale HR Solutions';
          $mail->Body    = 'Name: ' . $name . ' <br />Message: ' . $message . ' <br />Email: ' . $email . ' <br />Interested: ' . $cdp;

          if(!$mail->send()) {
              echo 'Message could not be sent.';
              echo 'Mailer Error: ' . $mail->ErrorInfo;
          } else {
              $isSuccess = true;
              $msg = 'Form submitted';
          }
      }
    }
    else{
        $isSuccess = false;
        $msg = 'Please fill in all the fields.';
    }
    $data = array(
        'isSuccess' => $isSuccess,
        'msg' => $msg
    );

    echo json_encode($data);
?>