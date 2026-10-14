<?php

namespace AnotherStep\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SecureMailer
{
    public static function send(
        string $smtpUser,
        string $smtpPassword,
        string $to,
        string $subject,
        string $html
    ): bool
    {
        try {
            $mail = new PHPMailer(true);

            $mail->isSMTP();

            $mail->Host = 'smtp.office365.com';
            $mail->Port = 587;

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            $mail->SMTPAuth = true;

            $mail->Username = $smtpUser;
            $mail->Password = $smtpPassword;

            $mail-setForm(
                $smtpUser,
                'Another Step Reporting'
            );

            $mail->addAddress($to);

            $mail->isHTML(true);

            $mail->Subject = $subject;
            $mail->Body = $html;

            return $mail->send();
        } catch (Exception $e) {
            error_log(
                'SecureMailer Error: ' .
                $e->getMessage()
            );

            return false;
        }
    }
}