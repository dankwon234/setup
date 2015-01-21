<?php

require_once('phpmailer/class.phpmailer.php');

$mail = new PHPMailer();

if( isset( $_POST['widget-subscribe-form-email'] ) ) {
    if( $_POST['widget-subscribe-form-email'] != '' ) {

        $email = $_POST['widget-subscribe-form-email'];

        $subject = 'Subscribe me to the List';

        $toemail = ''; // Your Email Address
        $toname = ''; // Your Name

        $mail->SetFrom( $email , 'New Subscriber' );
        $mail->AddReplyTo( $email );
        $mail->AddAddress( $toemail , $toname );
        $mail->Subject = $subject;

        $email = isset($email) ? "Email: $email<br><br>" : '';

        $referrer = $_SERVER['HTTP_REFERER'] ? '<br><br><br>This Form was submitted from: ' . $_SERVER['HTTP_REFERER'] : '';

        $body = "$email $referrer";

        $mail->MsgHTML( $body );
        $sendEmail = $mail->Send();

        if( $sendEmail == true ):
            echo 'We have <strong>successfully</strong> subscribed you to our Mailing List.';
        else:
            echo 'Email <strong>could not</strong> be sent due to some Unexpected Error. Please Try Again later.<br /><br /><strong>Reason:</strong><br />' . $mail->ErrorInfo . '';
        endif;
    } else {
        echo 'Please <strong>Fill up</strong> all the Fields and Try Again.';
    }
} else {
    echo 'An <strong>unexpected error</strong> occured. Please Try Again later.';
}

?>