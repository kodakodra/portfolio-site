<?php

declare(strict_types=1);

$title = $pageTitle ?? $portfolio['name'];
$description = $pageDescription ?? $portfolio['description'];
$path = $currentPath ?? current_path();
$theme = $portfolio['theme'];
?>
<!doctype html>
<html lang="en-GB">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= e($description) ?>">
    <meta name="theme-color" content="<?= e($theme['brand']) ?>">
    <link rel="canonical" href="<?= e(absolute_url($path, $portfolio)) ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= e($title) ?>">
    <meta property="og:description" content="<?= e($description) ?>">
    <meta property="og:url" content="<?= e(absolute_url($path, $portfolio)) ?>">
    <meta property="og:site_name" content="<?= e($portfolio['name']) ?>">
    <title><?= e($title) ?></title>
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="/css/app.css">
    <script type="application/ld+json"><?= json_ld($portfolio) ?></script>
</head>
<body style="--brand:<?= e($theme['brand']) ?>;--brand-dark:<?= e($theme['brand_dark']) ?>;--accent:<?= e($theme['accent']) ?>;--surface:<?= e($theme['surface']) ?>;--surface-alt:<?= e($theme['surface_alt']) ?>;--text:<?= e($theme['text']) ?>;--muted:<?= e($theme['muted']) ?>;">
<a class="skip-link" href="#main">Skip to content</a>
<header class="site-header">
    <div class="container header-inner">
        <a class="brand" href="/" aria-label="<?= e($portfolio['name']) ?> home">
            <span class="brand-mark" aria-hidden="true">K</span>
            <span><?= e($portfolio['name']) ?></span>
        </a>
        <nav aria-label="Primary navigation">
            <ul class="nav-list">
                <?php foreach ($portfolio['navigation'] as $item): ?>
                    <li><a class="<?= $path === $item['href'] || ($item['href'] === '/projects' && str_starts_with($path, '/projects/')) ? 'active' : '' ?>" href="<?= e($item['href']) ?>"><?= e($item['label']) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <a class="header-cta" href="<?= e($portfolio['secondary_action']['href']) ?>"><?= e($portfolio['secondary_action']['label']) ?></a>
    </div>
</header>
<?php if (!empty($flash)): ?>
    <div class="flash <?= e((string) ($flash['type'] ?? 'info')) ?>" role="status">
        <div class="container"><?= e((string) ($flash['message'] ?? '')) ?></div>
    </div>
<?php endif; ?>
<main id="main">
    <?= $content ?>
</main>
<footer class="site-footer">
    <div class="container footer-grid">
        <div>
            <a class="brand footer-brand" href="/"><span class="brand-mark" aria-hidden="true">K</span><span><?= e($portfolio['name']) ?></span></a>
            <p><?= e($portfolio['tagline']) ?></p>
            <p class="muted"><?= e($portfolio['location']) ?></p>
        </div>
        <div>
            <h2 class="footer-heading">Contact</h2>
            <p><a href="mailto:<?= e($portfolio['email']) ?>"><?= e($portfolio['email']) ?></a></p>
            <p><?= e($portfolio['availability']) ?></p>
        </div>
        <div>
            <h2 class="footer-heading">Explore</h2>
            <p><a href="/projects">Projects</a><br><a href="/about">About</a><br><a href="/contact">Contact</a></p>
        </div>
        <div>
            <h2 class="footer-heading">Elsewhere</h2>
            <p class="social-links">
                <?php foreach ($portfolio['social'] as $social): ?>
                    <a href="<?= e($social['href']) ?>" target="_blank" rel="noopener noreferrer"><?= e($social['label']) ?></a><br>
                <?php endforeach; ?>
            </p>
            <?php if ($portfolio['cv_url'] !== ''): ?><p><a href="<?= e($portfolio['cv_url']) ?>">Download CV</a></p><?php endif; ?>
        </div>
    </div>
    <div class="container footer-bottom">
        <p>&copy; <?= date('Y') ?> <?= e($portfolio['name']) ?>. All rights reserved.</p>
        <p><a href="/privacy">Privacy</a> · <a href="/terms">Terms</a> · <?= e($portfolio['legal']['owner_notice']) ?></p>
    </div>
</footer>
</body>
</html>
