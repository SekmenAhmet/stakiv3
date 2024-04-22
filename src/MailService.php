<?php

namespace App;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';

class MailService {
    private PHPMailer $mail;

    public function contact(array $user = [],string $objet, string $message) : void {
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->SMTPAuth = true;
        $this->mail->Host = "smtp.gmail.com";
        $this->mail->Port = 587;
        $this->mail->Username = "staki.contact.assistance@gmail.com";
        $this->mail->Password = "itve slxp geke cqgl";
        $this->mail->SMTPSecure = 'tls';
        $this->mail->setFrom("staki.contact.assistance@gmail.com",  "id :  " . $user['id']);
        $this->mail->addAddress("staki.contact.assistance@gmail.com");
        $this->mail->isHTML(true);
        $this->mail->Subject = $objet ;
        $this->mail->Body =  "Utilisateurs : " . $user['username'] . "<br>" .
            "Id : " . $user['id'] . "<br>" .
            "Email : " . $user['email'] . "<br><br>" .
            "Message : " . "<br>" . "<br>". $message;

        $this->mail->CharSet = 'UTF-8';
        $this->mail->Encoding = 'base64';
        if(!$this->mail->send()){
            $_SESSION['mailError'] = "Le message n'a pas pu parvenir au destinataire.";
        } else {
            $_SESSION['mailSuccess'] = "Message envoyé avec succès";
        }
    }
    public function confirmMail($email) : void {
        $this->mail->isSMTP();
        $this->mail->SMTPAuth = true;
        $this->mail->Host = "smtp.gmail.com";
        $this->mail->Port = 475;
        $this->mail->Username = "sekmenahmet04@gmail.com";
        $this->mail->Password = "caan xnsr xfrv rpby";
        $this->mail->SMTPSecure = 'tls' ;
        $this->mail->setFrom('sekmenahmet04@gmail.com', 'Ahmet');
        $this->mail->addAddress($email);
        $this->mail->isHTML(true);
        $this->mail->Subject = 'Vérification Staki';
        $url = $this->getUrl();
        $this->mail->Body = 'Cliquez sur ce lien pour valider la création de votre compte : <br><a href="' . $url . '"><button>Cliquez ici !</button></a>';
        $this->mail->CharSet = 'UTF-8';
        $this->mail->Encoding = 'base64';
        $this->mail->Sender = 'sekmenahmet04@gmail.com';
        $this->mail->send();
    }
}