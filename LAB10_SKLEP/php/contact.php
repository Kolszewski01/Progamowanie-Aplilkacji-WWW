<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor\phpmailer\phpmailer\src\Exception.php';
require 'vendor\phpmailer\phpmailer\src\PHPMailer.php';
require 'vendor\phpmailer\phpmailer\src\SMTP.php';

$mail = new PHPMailer();


if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $message = $_POST['content'];
    $name = $_POST['firstname'];

    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $message = "Wrong E-mail";
    }
    else
    {
            $final_message = "Dziękuje za kontakt, $name";
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.gmail.com;';                    
            $mail->SMTPAuth   = true;                             
            $mail->Username   = 'popocompany473@gmail.com';                 
            $mail->Password   = 'ixgv obpk rpbl imik';                        
            $mail->SMTPSecure = 'tls';                              
            $mail->Port       = 587;  
            $mail->CharSet = "UTF-8";
            $mail->setFrom('popocompany473@gmail.com');           
            $mail->addAddress($email, $name);
               
            $mail->IsHTML(true);
            $mail->SetFrom("popocompany473@gmail.com", "no-reply");
            $mail->Subject = "Dziękuje za kontakt!";
            $mail->MsgHTML($final_message);
            if(!$mail->Send()) {
              echo "Error while sending Email.";
              var_dump($mail);
            } else {
              echo "Email sent successfully";
            }
            $mail->ClearAllRecipients();

            $final_message = "<p>E-Mail: $email</p><p>Imię: $name</p><p>Treść: $message";
            $mail->setFrom('popocompany473@gmail.com');           
            $mail->addAddress('popocompany473@gmail.com');
            $mail->IsHTML(true);
            $mail->SetFrom("popocompany473@gmail.com", "no-reply");
            $mail->Subject = "Wiadomość od: $email";
            $mail->MsgHTML($final_message);
            if(!$mail->Send()) {
              echo "Error ";
              var_dump($mail);
            } else {
              echo "Email sent successfully";
            }
            header('Location: index.php');
        }

        
    }
?>
