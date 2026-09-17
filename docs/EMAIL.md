# Email configuration

The contact form sends through PHPMailer and SMTP. PHP's `mail()` function is not used.

## Environment variables

```text
CONTACT_EMAIL=hello@example.com
MAIL_MAILER=smtp
MAIL_HOST=smtp.example.com
MAIL_PORT=587
MAIL_USERNAME=hello@example.com
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_AUTH=1
MAIL_FROM_ADDRESS=hello@example.com
MAIL_FROM_NAME="Portfolio Site"
MAIL_TIMEOUT=15
```

`MAIL_ENCRYPTION` supports `tls`, `ssl`, or `none`. `MAIL_AUTH=0` disables SMTP authentication when the server permits unauthenticated delivery.

## Reply behaviour

The configured `MAIL_FROM_ADDRESS` remains the sender. The visitor's validated email address is set as Reply-To so replying from a mail client reaches the visitor without spoofing the authenticated sender.

## Local testing

Install Composer dependencies and configure `.env` before testing a real submission:

```bash
composer install
cp .env.example .env
composer serve
```

Open `/contact` and submit a test message.

## Troubleshooting

Check that the SMTP host, port, credentials, encryption mode and from address match the mail provider. Server logs receive the underlying PHPMailer error while the visitor sees a generic failure message.

For Gmail SMTP, use an appropriate authenticated mailbox and app-specific credential where required by the account provider. Do not commit credentials.
