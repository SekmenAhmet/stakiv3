<?php

namespace App;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';

class MailService
{
    private PHPMailer $mail;
    public function confirmMail($email) : void {
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->SMTPAuth = true;
        $this->mail->Host = "smtp.gmail.com";
        $this->mail->Port = 587;
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