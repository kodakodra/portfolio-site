# Portfolio Site

Reusable PHP portfolio-site foundation for developers, designers and digital professionals.

## Purpose

This project is a production-minded portfolio starter for presenting projects, case studies, technical skills, experience and contact information. It is deliberately configuration-driven so the same foundation can be adapted without rewriting the application structure.

It is designed for software engineers, web developers, designers, consultants and other digital professionals who need a focused portfolio rather than a full CMS.

## Included

- Responsive home, projects, project-detail, about and contact pages
- Configuration-driven projects, skills, experience, branding and social links
- Secure server-side contact validation
- CSRF protection, honeypot anti-spam and submission throttling
- PHPMailer over SMTP
- Canonical URLs, Open Graph metadata and Person JSON-LD
- Dynamic `robots.txt` and `sitemap.xml`
- Custom 404 and production-friendly 500 handling
- Accessible navigation, labels, focus states and reduced-motion support
- Apache `.htaccess` and PHP built-in development router
- Smoke tests and GitHub Actions checks for PHP 8.2 and 8.3
- Privacy and terms starter pages
- MIT licence

## Requirements

- PHP 8.2+
- Composer
- Git

## Setup

```bash
composer install
cp .env.example .env
```

Edit `.env` with the real site URL and SMTP settings. Never commit `.env` or mail credentials.

Run locally:

```bash
composer serve
```

Open `http://localhost:8000`.

Run tests:

```bash
composer test
```

## Configuration

Main portfolio content lives in `config/portfolio.php`, including:

- name, title, tagline and description
- contact email and availability
- CV link
- navigation and theme colours
- hero and introduction copy
- projects and project detail content
- skills and experience
- process/working approach
- social profiles
- legal contact details

Project entries are exposed as `/projects/{slug}` automatically.

## Email

Contact submissions use PHPMailer with SMTP. Configure the following variables in `.env`:

```text
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

Supported encryption values are `tls`, `ssl`, or `none`. The visitor's address is used as Reply-To rather than replacing the authenticated sender.

See `docs/EMAIL.md` for configuration and troubleshooting.

## Structure

```text
config/          Portfolio configuration
public/          Web root, routing, assets
src/             Bootstrap, helpers and contact handling
templates/       Page templates and shared layout
tests/            Smoke tests
docs/             Customisation, email, deployment and roadmap guidance
```

## Production

Set the server document root to `public/`, install production Composer dependencies, provide a real `.env`, configure SMTP, enable HTTPS, and test the contact form from the deployed environment.

```bash
composer install --no-dev --optimize-autoloader
```

## Scope

The starter intentionally does not include a CMS, database, authentication, ecommerce, payment processing or portfolio-admin backend. Those concerns belong in separate projects where they are actually required.

## Status

The foundation is feature-complete as a reusable starter and can be adapted to a specific personal portfolio by replacing the example configuration/content and adding project-specific assets.

## Licence and support

Released under the MIT licence. The software is free to use and adapt. If this project is useful to you, voluntary support is appreciated.
