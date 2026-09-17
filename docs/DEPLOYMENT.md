# Deployment

1. Use PHP 8.2+ and point the web server document root at `public/`.
2. Install production dependencies:

```bash
composer install --no-dev --optimize-autoloader
```

3. Create `.env` from `.env.example` and provide the real site URL, contact address and SMTP settings.
4. Keep `.env` outside version control and restrict filesystem permissions appropriately.
5. Serve over HTTPS.
6. Confirm Apache rewrite rules or equivalent routing are enabled.
7. Test `/`, `/projects`, a project-detail route, `/about`, `/contact`, `/privacy`, `/terms`, `/robots.txt` and `/sitemap.xml`.
8. Submit a real contact message and confirm SMTP delivery.
9. Verify the deployed canonical URL, Open Graph metadata and social links.

The application is deliberately simple enough to run on conventional PHP hosting without a database or frontend build process.
