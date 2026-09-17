<?php

declare(strict_types=1);

require dirname(__DIR__) . '/src/bootstrap.php';
require $basePath . '/src/contact.php';

$currentPath = current_path();
$formData = [];
$formErrors = [];

if ($currentPath === '/robots.txt') {
    header('Content-Type: text/plain; charset=UTF-8');
    echo "User-agent: *\nAllow: /\nDisallow: /.env\n\nSitemap: " . absolute_url('/sitemap.xml', $portfolio) . "\n";
    exit;
}

if ($currentPath === '/sitemap.xml') {
    header('Content-Type: application/xml; charset=UTF-8');
    $pages = ['/', '/projects', '/about', '/contact', '/privacy', '/terms'];
    foreach ($portfolio['projects'] as $project) {
        $pages[] = '/projects/' . $project['slug'];
    }
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    foreach ($pages as $page) {
        echo '<url><loc>' . e(absolute_url($page, $portfolio)) . '</loc></url>';
    }
    echo '</urlset>';
    exit;
}

if ($currentPath === '/contact' && is_post()) {
    start_session();
    if (!csrf_valid($_POST['csrf_token'] ?? null)) {
        $formErrors['form'] = 'Your session has expired. Please reload the page and try again.';
    } elseif (!can_submit_contact()) {
        $formErrors['form'] = 'Please wait a few seconds before sending another message.';
    } else {
        [$formData, $formErrors] = validate_contact($_POST);
        if ($formErrors === []) {
            if (send_contact_message($formData, $portfolio)) {
                $_SESSION['last_contact_submit'] = time();
                flash_set('success', 'Thanks. Your message has been sent. I will get back to you using the contact details you provided.');
                redirect('/contact#form');
            }
            $formErrors['form'] = 'I could not send your message right now. Please email me directly instead.';
        }
    }
}

$projectSlug = null;
if (str_starts_with($currentPath, '/projects/')) {
    $projectSlug = trim(substr($currentPath, strlen('/projects/')), '/');
}

switch ($currentPath) {
    case '/':
        $pageTitle = $portfolio['name'] . ' | ' . $portfolio['title'];
        $pageDescription = $portfolio['description'];
        $template = '/templates/home.php';
        break;
    case '/projects':
        $pageTitle = 'Projects | ' . $portfolio['name'];
        $pageDescription = 'Selected software, web development and digital projects by ' . $portfolio['name'] . '.';
        $template = '/templates/projects.php';
        break;
    case '/about':
        $pageTitle = 'About | ' . $portfolio['name'];
        $pageDescription = 'About ' . $portfolio['name'] . ', including skills, experience and working approach.';
        $template = '/templates/about.php';
        break;
    case '/contact':
        $pageTitle = 'Contact | ' . $portfolio['name'];
        $pageDescription = 'Contact ' . $portfolio['name'] . ' about software engineering and web development work.';
        $template = '/templates/contact.php';
        break;
    case '/privacy':
        $pageTitle = 'Privacy notice | ' . $portfolio['name'];
        $pageDescription = 'Privacy information for the portfolio website.';
        $template = '/templates/privacy.php';
        break;
    case '/terms':
        $pageTitle = 'Terms of service | ' . $portfolio['name'];
        $pageDescription = 'Terms of service for the portfolio website.';
        $template = '/templates/terms.php';
        break;
    default:
        if ($projectSlug !== null) {
            $project = null;
            foreach ($portfolio['projects'] as $item) {
                if ($item['slug'] === $projectSlug) {
                    $project = $item;
                    break;
                }
            }
            if ($project !== null) {
                $pageTitle = $project['title'] . ' | Projects | ' . $portfolio['name'];
                $pageDescription = $project['summary'];
                $template = '/templates/project.php';
                break;
            }
        }
        http_response_code(404);
        $pageTitle = 'Page not found | ' . $portfolio['name'];
        $pageDescription = 'The requested page could not be found.';
        $template = '/templates/404.php';
        break;
}

$flash = flash_get();
ob_start();
require $basePath . $template;
$content = ob_get_clean();
require $basePath . '/templates/layout.php';
