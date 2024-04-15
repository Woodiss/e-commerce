<?php

namespace App\Services;

use Symfony\Component\Mailer\MailerInterface;
Use Symfony\Component\Mime\Email;

class MailerService
{
    public function __construct (private MailerInterface $mailer) {

    }

    public function sendEmail(
        $to = 'stephane.descarpentries@hotmail.fr',
        $subject = 'empty',
        $content = '',
        $text = ''
    ): void{
        $email = (new Email())
            ->from('stephane.descarpentries@hotmail.fr')
            ->to($to)
            ->subject($subject)
            ->text($text)
            ->html($content);
        $this->mailer->send($email);
    }
}