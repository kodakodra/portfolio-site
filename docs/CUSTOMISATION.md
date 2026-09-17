# Customisation

## Main configuration

Edit `config/portfolio.php`. It contains the site identity, navigation, theme, hero copy, projects, skills, experience, process, social profiles and legal contact details.

## Projects

Each project has a unique `slug`, title, category, summary, detailed description, technology stack, highlights, URL and status. Project routes are generated automatically at `/projects/{slug}`.

For a richer case study, expand the project data model and template rather than hard-coding content into the router.

## Branding

Theme colours are set in the `theme` array. The templates consume these as CSS custom properties so colour changes remain centralised.

The favicon is `public/favicon.svg`.

## CV and profiles

Set `cv_url` to the deployed CV path or external document URL. Replace the example social links with real profiles.

## Contact

The contact form is intentionally server-rendered. Validation and security checks live in `src/contact.php`; SMTP delivery uses PHPMailer.

## Secrets

Copy `.env.example` to `.env`. Keep `.env` out of source control. Never place SMTP passwords or other secrets in `config/portfolio.php` or committed files.
