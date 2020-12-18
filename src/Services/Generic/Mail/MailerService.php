<?php


namespace App\Services\Generic\Mail;


use Html2Text\Html2Text; //composer require html2text/html2text
use PHPMailer\PHPMailer\PHPMailer; //composer require phpmailer/phpmailer
use PHPMailer\PHPMailer\Exception;
use Swift_Mailer; //composer require symfony/swiftmailer-bundle
use Swift_Message;


class MailerService
{
    private $lastError;

    /**
     * @var Swift_Mailer
     */
    private $mailer;
    /**
     * @var PHPMailer
     */
    private $phpMailer;

    /**
     * Mailer constructor.
     * @param Swift_Mailer $mailer
     */
    public function __construct(Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
        // Instantiation and passing `true` enables exceptions
        $this->phpMailer = new PHPMailer(true);
    }

    public function sendEmailPhp(
        $subject,
        $toEmail,
        $fromEmail,
        $fromName,
        $htmlPart = null,
        $txtPart = null,
        $autoAddTxtPart = true
    ) {
        if ($htmlPart === null && $txtPart === null) {
            $this->lastError = 'HTML and text part empty.';
            return false;
        }

        try {
            //Server settings
            //$this->phpMailer->SMTPDebug = 2;                                       // Enable verbose debug output
            //$this->phpMailer->isSMTP();                                            // Set mailer to use SMTP
            //$this->phpMailer->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
            //$this->phpMailer->SMTPAuth = true;                                   // Enable SMTP authentication
            //$this->phpMailer->Username = 'user@example.com';                     // SMTP username
            //$this->phpMailer->Password = 'secret';                               // SMTP password
            //$this->phpMailer->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
            //$this->phpMailer->Port = 587;                                    // TCP port to connect to

            //Recipients
            $this->phpMailer->setFrom($fromEmail, $fromName);
            //$this->phpMailer->addAddress('joe@example.net', 'Joe User');     // Add a recipient
            $this->phpMailer->addAddress($toEmail);               // Name is optional
            //$this->phpMailer->addReplyTo('info@example.com', 'Information');
            //$this->phpMailer->addCC('cc@example.com');
            //$this->phpMailer->addBCC('bcc@example.com');

            // Attachments
            //$this->phpMailer->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$this->phpMailer->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $this->phpMailer->CharSet = PHPMailer::CHARSET_UTF8;
            $this->phpMailer->isHTML(true);                                  // Set email format to HTML
            $this->phpMailer->Subject = $subject;
            $this->phpMailer->Body = $htmlPart;
            if ($txtPart !== null || $autoAddTxtPart) {
                if ($txtPart === null) {
                    $html2Text = new Html2Text($htmlPart, array('do_links' => 'inline'));
                    $txtPart = $html2Text->getText();
                }
                $this->phpMailer->AltBody = $txtPart;
            }

            return $this->phpMailer->send();
        } catch (Exception $e) {
            $this->lastError = $e->getMessage();
            return false;
            //echo "Message could not be sent. Mailer Error: {$this->phpMailer->ErrorInfo}";
        }
    }

    public function sendEmailSwift($subject, $to, $from, $htmlPart = null, $txtPart = null, $autoAddTxtPart = true)
    {
        if ($htmlPart === null && $txtPart === null) {
            return false;
        }
        $message = (new Swift_Message($subject))
            ->setFrom($from)
            ->setTo($to);
        if ($htmlPart !== null) {
            $message->setBody($htmlPart, 'text/html');
        }
        if ($txtPart !== null || $autoAddTxtPart) {
            if ($txtPart === null) {
                $html2Text = new Html2Text($htmlPart, array('do_links' => 'inline'));
                $txtPart = $html2Text->getText();
            }
            $message->addPart($txtPart, 'text/plain');
        }

        return ($this->mailer->send($message) > 0);
    }

    public function getPhpMailerError()
    {
        return $this->phpMailer->ErrorInfo;
    }

    /**
     * @return mixed
     */
    public function getLastError()
    {
        return $this->lastError;
    }
}