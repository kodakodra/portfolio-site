<?php

declare(strict_types=1);

use PHPMailer\PHPMailer\PHPMailer;

function validate_contact(array $input): array
{
    $data = [
        'name' => trim((string) ($input['name'] ?? '')),
        'email' => trim((string) ($input['email'] ?? '')),
        'message' => trim((string) ($input['message'] ?? '')),
        'website' => trim((string) ($input['website'] ?? '')),
    ];

    $errors = [];
    if ($data['website'] !== '') {
        return [$data, ['form' => 'Your message could not be submitted.']];
    }
    if ($data['name'] === '' || strlen($data['name']) < 2 || strlen($data['name']) > 100 || preg_match('/[\r\n]/', $data['name'])) {
        $errors['name'] = 'Please enter your name.';
    }
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL) || strlen($data['email']) > 254) {
        $errors['email'] = 'Please enter a valid email address.';
    }
    if ($data['message'] === '' || strlen($data['message']) < 20 || strlen($data['message']) > 3000) {
        $errors['message'] = 'Please tell me a little more about your enquiry (20-3000 characters).';
    }
    return [$data, $errors];
}

function can_submit_contact(): bool
{
    start_session();
    $last = (int) ($_SESSION['last_contact_submit'] ?? 0);
    return time() - $last >= 15;
}

function send_contact_message(array $data, array $portfolio): bool
{
    $basePath = dirname(__DIR__);
    $autoload = $basePath . '/vendor/autoload.php';
    if (!is_file($autoload)) {
        error_log('Contact email unavailable: Composer dependencies are not installed.');
        return false;
    }
    require_once $autoload;

    $to = (string) env('CONTACT_EMAIL', $portfolio['email']);
    $from = (string) env('MAIL_FROM_ADDRESS', $portfolio['email']);
    $fromName = (string) env('MAIL_FROM_NAME', $portfolio['name']);
    $mailer = strtolower(trim((string) env('MAIL_MAILER', 'smtp')));
    $host = trim((string) env('MAIL_HOST', ''));
    $port = (int) env('MAIL_PORT', '587');
    $username = (string) env('MAIL_USERNAME', '');
    $password = (string) env('MAIL_PASSWORD', '');
    $encryption = strtolower(trim((string) env('MAIL_ENCRYPTION', 'tls')));
    $auth = env('MAIL_AUTH', '1') !== '0';
    $timeout = max(5, (int) env('MAIL_TIMEOUT', '15'));

    if ($mailer !== 'smtp') {
        error_log('Contact email unavailable: MAIL_MAILER must be smtp.');
        return false;
    }
    if (!filter_var($to, FILTER_VALIDATE_EMAIL) || !filter_var($from, FILTER_VALIDATE_EMAIL) || $host === '') {
        error_log('Contact email unavailable: SMTP settings are incomplete.');
        return false;
    }

    $safeName = preg_replace('/[\r\n]+/', ' ', $data['name']) ?: 'Website visitor';
    $subject = 'Portfolio enquiry from ' . $safeName;
    $body = implode(PHP_EOL, [
        'New portfolio enquiry', '=======================', '',
        'Name: ' . $data['name'], 'Email: ' . $data['email'], '',
        'Message:', $data['message'], '',
        'Sent from ' . site_origin($portfolio),
    ]);

    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = $host;
        $mail->Port = $port;
        $mail->SMTPAuth = $auth;
        $mail->Timeout = $timeout;
        $mail->CharSet = 'UTF-8';

        if ($auth) {
            $mail->Username = $username;
            $mail->Password = $password;
        }

        switch ($encryption) {
            case 'tls':
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                break;
            case 'ssl':
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                break;
            case 'none':
            case '':
                $mail->SMTPSecure = '';
                break;
            default:
                error_log('Contact email unavailable: unsupported MAIL_ENCRYPTION value.');
                return false;
        }

        $mail->setFrom($from, $fromName);
        $mail->addAddress($to);
        $mail->addReplyTo($data['email'], $safeName);
        $mail->Subject = $subject;
        $mail->isHTML(false);
        $mail->Body = $body;
        $mail->AltBody = $body;
        $mail->send();

        return true;
    } catch (\Throwable $exception) {
        error_log('Contact email failed: ' . $exception->getMessage());
        return false;
    }
}
