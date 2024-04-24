<?php

namespace App;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require '../vendor/autoload.php';

class MailService {

    /**
     * @throws Exception
     */
    public function contact(array $user = [], string $objet, string $message) : void {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->Username = "staki.contact.assistance@gmail.com";
        $mail->Password = "itve slxp geke cqgl";
        $mail->SMTPSecure = 'tls';
        $mail->setFrom("staki.contact.assistance@gmail.com",  "id :  " . $user['id']);
        $mail->addAddress("staki.contact.assistance@gmail.com");
        $mail->isHTML();
        $mail->Subject = $objet ;
        $mail->Body =  "Utilisateurs : " . $user['username'] . "<br>" .
            "Id : " . $user['id'] . "<br>" .
            "Email : " . $user['email'] . "<br><br>" .
            "Message : " . "<br>" . "<br>". $message;

        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        if(!$mail->send()){
            $_SESSION['mailError'] = "Le message n'a pas pu parvenir au destinataire.";
        } else {
            $_SESSION['mailSuccess'] = "Message envoyé avec succès";
        }
    }
}